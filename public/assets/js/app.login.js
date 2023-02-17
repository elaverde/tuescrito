
var app = new Vue({
    el: '#app',
    data: {
        email:'',
        password:'',
    },
   
    created: function () {
    },
    methods: {
        login: function () {
            axios.post(PATH_SESSION, {
                email: this.email,
                password: this.password,

            })
            .then(function (response) {
                if (response.status == 200) {
                    window.location.href = PATH_HOME;
                }
                console.log(response);
            })
            .catch(function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '¡El usuario o contraseña parecen estar mal!',
                });
                console.log(error);
            });
        }
    }
});