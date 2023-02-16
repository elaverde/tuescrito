
var quill = null;
var timeoutId;
var app = new Vue({
    el: '#app',
    data: {
        id:'',
        title:'',
        product_id:'',
        products:[],
        description:'',
        inputs: [],
        values: {},
        errors: "",
        texts:[],
        product_id_filter:'',
        search: '',
        pagination:{},
        isEditing: false,
        loadingIndicator: false,
        loadingSpinner: false
    },
   
    created: function () {
        this.getProducts();
        this.getText();
    },
    components: {
        paginator
    },
    mounted() {
        var toolbarOptions = [
            ['bold', 'italic'],        // toggled buttons
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'align': [] }],   
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'align': [] }]
        ];
        quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow',
        });
        quill.on('text-change', this.handleTextChange);
    },
    methods: {
        
        handleTextChange(delta, oldDelta, source) {
            let text = quill.getText();
            let regex = /{{(.*?)}}/g;
            let matches = text.match(regex);
            if (matches) {
                this.inputs = [];
                this.values = {};
                this.errors = "";
                var height = 260;
                document.getElementById("editor").style.height = height + "px";
                for (let match of matches) {
                    let input = match.replace('{{', '').replace('}}', '');
                    if (!this.inputs.includes(input)) {
                        this.inputs.push(input);
                        this.$set(this.values, input, { key: '{{' + input + '}}', label: '', id:''});
                        height += 76;
                        document.getElementById("editor").style.height = height + "px";
                    }else{
                        this.errors = "LLaves duplicadas pof favor corregir {{"+input+"}}";
                    }
                }
            } else {
                this.inputs = [];
                this.values = {};
            }
            
        },
        getProducts: function () {
            axios.get('./products')
            .then(response => {
                this.products =response.data.products;
            })
            .catch(function (error)  {
            });
        },
        clearInputs: function () {
            this.title = '';
            this.product_id = '';
            this.description = '';
            this.values = {};
            this.inputs = [];
            this.isEditing = false;
            quill.setText('');
            var height = 260;
            document.getElementById("editor").style.height = height + "px";
        },
        submitForm: function  () {
            this.isEditing ? this.updateText() : this.storeText();
        },
        getHtmlQuill: function (){
            let html = quill.root.innerHTML;
            //clean code
            return html;
        },
        storeText: function () {
            this.loadingIndicator = true;
            axios.post('./texts', {
                title: this.title,
                product_id: this.product_id,
                description: this.description,
                template:  this.getHtmlQuill(),
                values: JSON.stringify(this.values) =="{}" ? "" : JSON.stringify(this.values)
            })
            .then(response => {
                this.loadingIndicator = false;
                this.clearInputs();
                this.getText();
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                this.loadingIndicator = false;
                helperResponseMessage(error.response);
            });
        },
        updateText: function () {
            this.loadingIndicator = true;
            axios.put(`./texts/${this.id}`, {
                title: this.title,
                product_id: this.product_id,
                description: this.description,
                template:  this.getHtmlQuill(),
                values: JSON.stringify(this.values) =="{}" ? "" : JSON.stringify(this.values)
            })
            .then(response => {
                this.loadingIndicator = false;
                this.clearInputs();
                this.getText();
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                this.loadingIndicator = false;
                helperResponseMessage(error.response);
            });
        },
        getText: function (page) {
            this.loadingSpinner = true;
            let url;
            if(this.product_id_filter == ""){
                url = `./texts?search=${this.search}&page=${page}`;
            }else{
                url = `./texts?search=${this.search}&product_id_filter=${this.product_id_filter}&page=${page}`;
            }
            axios.get(url)
            .then(response => {
                this.loadingSpinner = false;
                let {data, ...pagination} = response.data.texts;
                this.pagination = pagination;
                console.log(response.data);
                this.texts = data;
            })
            .catch(function (error)  {
            });
        },
        deleteText: function (id) {
            Swal.fire({
                title: "¿Esta seguro?",
                text: "¡No podras recuperar la información!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDeleted) => {
                if (willDeleted) {
                    this.loadingSpinner = true;
                    axios.delete(`./texts/${id}`)
                    .then(response => {
                        this.getText();
                        helperResponseMessage(response);
                        this.loadingSpinner = false;
                    })
                    .catch(function (error)  {
                        helperResponseMessage(error.response);
                        this.loadingSpinner = false;
                    });
                }
            });
        },
        editText: function (data) {
            quill.root.innerHTML = data.template;
            this.title           = data.title;
            this.product_id      = data.product_id;
            this.description     = data.description;
            this.values          = {};
            this.inputs          = [];
            this.isEditing       = true;
            this.id              = data.id;
            setTimeout(() => {
                if( data?.parameters ){
                    var height = 260;
                    this.inputs = [];
                    this.values = {};
                    this.errors = "";
                    document.getElementById("editor").style.height = height + "px";
                    for (let parameter of data.parameters) {
                        this.inputs.push(parameter.key);
                        this.$set(this.values, parameter.key, { key:parameter.key, label:parameter.label, id:parameter.id});
                        height += 76;
                        document.getElementById("editor").style.height = height + "px";
                    }
                }
            }, 200);
            
        }

    }
});