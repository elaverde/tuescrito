var app = new Vue({
    el: '#app',
    data: {
        loginView: true,
        showFormRecovery: false,
        showFormLogin: true,
        name:'',
        last_name:'',
        email:'',
        password:'',
        loadingIndicator: false
    },
    created: function () {
    },
    methods: {
        toogleForm: function () {
            this.showFormRecovery = !this.showFormRecovery;
            this.showFormLogin = !this.showFormLogin;
        },
        clearInputs: function () {
            this.name = '';
            this.last_name = '';
            this.email = '';
            this.password = '';
        },
        login: function () {
            let _this = this;
            _this.loadingIndicator = true;
            axios.post(PATH_SESSION, {
                email: this.email,
                password: this.password,

            })
            .then(function (response) {
                if (response.status == 200) {
                    window.location.href = PATH_HOME;
                }
                _this.loadingIndicator = false;
            })
            .catch(function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '¡El usuario o contraseña parecen estar mal!',
                });
                _this.loadingIndicator = false;
            });
        },
        recovery: function () {
            let _this = this;
            _this.loadingIndicator = true;
            axios.post(PATH_RECOVER, {
                email: this.email,
            })
            .then(function (response) {
                if (response.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Listo!',
                        text: '¡Se ha enviado un correo a tu cuenta de correo!',
                    });
                    _this.toogleForm();
                }
                _this.loadingIndicator = false;
            })
            .catch(function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '¡El usuario parece estar mal!',
                });
                _this.loadingIndicator = false;
            });
        },
        activeUserCreate: function () {
            this.loginView = false;
        },
        register: function () {
            let _this = this;
            _this.loadingIndicator = true;
            axios.post(`${PATH_APP}/user`, {
                name: this.name,
                last_name: this.last_name,
                email: this.email,
                password: this.password
            })
            .then(response => {
                _this.loadingIndicator = false;
                helperResponseMessage(response);
                _this.clearInputs();
                _this.loginView = true;
            })
            .catch(function (error)  {
                _this.loadingIndicator = false;
                _this.clearInputs();
                helperResponseMessage(error.response);
                
            });
        },

    }
});