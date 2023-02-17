
var app = new Vue({
    el: '#app',
    data: {
        id:'',
        name:'',
        last_name:'',
        email:'',
        password:'',
        clients:[],
        pagination:{},
        isEditing: false,
        loadingIndicator: false,
        loadingSpinner: false,
        
    },
   
    created: function () {
        this.getClients();
    },
    components: {
       paginator
    },
    methods: {
        clearInputs: function () {
            this.name = '';
            this.last_name = '';
            this.email = '';
            this.password = '';
            this.getClients();
            this.isEditing = false;
            //validamos el input photo que exista si existe lo limpiamos
            if (document.getElementById('photo')) {
                document.getElementById('photo').value = '';
            }
        },
        editClient: function (data) {
            this.isEditing = true;
            this.id = data.id;
            this.name = data.name;
            this.last_name = data.last_name;
            this.email = data.email;
            this.password = data.password;
        },
        submitForm: function () {
            this.isEditing ? this.updateClient() : this.storeClient();
        },
        storeClient: function () {
            this.loadingIndicator = true;

            //creamos data para adjuntar la imagen
            var data = new FormData();
            data.append('name', this.name);
            data.append('last_name', this.last_name);
            data.append('email', this.email);
            data.append('password', this.password);

            const photoInput = document.querySelector('input[name="photo"]');

            if (photoInput.files.length > 0) {
                data.append('photo', photoInput.files[0]);
            }else{
                data.append('photo', 'no-photo.jpg');
            }
            let _this = this;
            axios.post(`${PATH_APP}/user`, data)
            .then(response => {
                this.loadingIndicator = false;
                this.clearInputs();
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                _this.loadingIndicator = false;
                _this.clearInputs();
                helperResponseMessage(error.response);
                
            });
        },
        updateClient: function () {
            this.loadingIndicator = true;
            let _this = this;
            axios.put(`${PATH_APP}/user/${this.id}`, {
                name: this.name,
                last_name: this.last_name,
                email: this.email
            })
            .then(response => {
                this.loadingIndicator = false;
                this.clearInputs();
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                _this.loadingIndicator = false;
                _this.clearInputs();
                helperResponseMessage(error.response);
            });
        },
        deleteClient: function (id) {
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
                    axios.delete(`${PATH_APP}/user/${id}`)
                    .then(response => {
                        this.getClients();
                        console.log(response);
                        helperResponseMessage(response);
                        this.loadingSpinner = false;
                    })
                    .catch(function (error)  {
                        
                        helperResponseMessage(error);
                        this.loadingSpinner = false;
                    });
                }
            });
        },
        getClients: function (page=1) {
            _this = this;
            this.loadingSpinner = true;
            axios.get(`${PATH_APP}/users?page=${page}`)
            .then(response => {
                let { data, ...pagination } = response.data.users;
                this.clients = data;
                this.pagination = pagination;
                this.loadingSpinner = false;
            })
            .catch(function (error)  {
                this.loadingSpinner = false;
            });
        }
    }
});