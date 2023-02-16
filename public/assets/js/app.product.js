app = new Vue({
    el: '#app',
    data: {
        id:'',
        name:'',
        description:'',
        id_category:'',
        products:[],
        categories:[],
        isEditing: false,
        loadingIndicator: false,
        loadingSpinner: false
    },
    created: function () {
        this.getCategories();
        this.getProducts();
    },
    methods: {
        clearInputs: function () {
            this.name = '';
            this.description = '';
            this.isEditing = false;
            this.getProducts();
        },
        editProduct: function (data) {
            this.isEditing = true;
            this.id = data.id;
            this.name = data.name;
            this.description = data.description;
            this.id_category = data.id_category;
        },
        submitForm: function () {
            this.isEditing ? this.updateProduct() : this.storeProduct();
        },
        storeProduct: function () {
            this.loadingIndicator = true;
            axios.post('./product', {
                name: this.name,
                description: this.description,
                id_category: this.id_category
            })
            .then(response => {
                this.loadingIndicator = false;
                this.clearInputs();
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                this.loadingIndicator = false;
                helperResponseMessage(error.response);
            });
        },
        updateProduct: function () {
            this.loadingIndicator = true;
            axios.put(`./product/${this.id}`, {
                name: this.name,
                description: this.description,
                id_category: this.id_category
            })
            .then(response => {
                this.loadingIndicator = false;
                this.clearInputs();
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                this.loadingIndicator = false;
                helperResponseMessage(error.response);
            });
        },
        deleteProduct: function (id) {
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
                    axios.delete(`./product/${id}`)
                    .then(response => {
                        this.getProducts();
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
        getProducts: function () {
            this.loadingSpinner = true;
            axios.get('./products')
            .then(response => {
                this.products = response.data.products;
                this.loadingSpinner = false;
            })
            .catch(function (error)  {
                this.loadingSpinner = false;
            });
        },
        getCategories: function () {
            axios.get('./categories')
            .then(response => {
                this.categories = response.data.categories;
                this.id_category = this.categories[0].id;
            })
            .catch(function (error)  {
            });
        }
    }
});