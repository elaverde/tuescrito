var app = new Vue({
    el: '#app',
    data: {
        id:'',
        name:'',
        last_name:'',
        email:'',
        password:'',
        admins:[],
        pagination:{},
        isEditing: false,
        loadingIndicator: false,
        loadingSpinner: false

    },
    created: function () {
        this.getAdmins();
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
            this.getAdmins();
            this.isEditing = false;
            if (document.getElementById('photo')) {
                document.getElementById('photo').value = '';
            }
        },
        editAdmin: function (data) {
            this.isEditing = true;
            this.id = data.id;
            this.name = data.name;
            this.last_name = data.last_name;
            this.email = data.email;
            this.password = data.password;
        },
        submitForm: function () {
            this.isEditing ? this.updateAdmin() : this.storeAdmin();
        },
        storeAdmin: function () {
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
            
            axios.post('./admin', data)
            .then(response => {
                this.loadingIndicator = false;
                this.clearInputs();
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                this.loadingIndicator = false;
                this.clearInputs();
                helperResponseMessage(error.response);
            });
        },
        updateAdmin: function () {
            this.loadingIndicator = true;
            axios.put(`./admin/${this.id}`, {
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
                this.loadingIndicator = false;
                helperResponseMessage(error.response);
            });
        },
        deleteAdmin: function (id) {
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
                    axios.delete(`./admin/${id}`)
                    .then(response => {
                        this.getAdmins();
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
        getAdmins: function () {
            this.loadingSpinner = true;
            axios.get('./admins')
            .then(response => {
                let {data, ...pagination} = response.data.admins;
                this.admins = data;
                this.pagination = pagination;
                this.loadingSpinner = false;
            })
            .catch(function (error)  {
                this.loadingSpinner = false;
            });
        }
    }
});