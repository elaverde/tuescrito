var app = new Vue({
    el: '#app',
    data: {
        name:document.getElementById('name').value,
        last_name:document.getElementById('last_name').value,
        email:document.getElementById('email').value,
        old_password:'',
        new1_password:'',
        new2_password:'',
        loadingIndicator: false,
        loadingSpinner: false,
        isEditing: false

    },
    created: function () {
    },
    methods: {
        updateAdmin: function () {
            this.loadingIndicator = true;
            axios.put(`${PATH_APP}/profile/admin/info`, {
                name: this.name,
                last_name: this.last_name,
                email: this.email
            })
            .then(response => {
                this.loadingIndicator = false;
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                this.loadingIndicator = false;
                helperResponseMessage(error.response);
            });
        }, updatePassword: function () {
            this.loadingIndicator = true;
            if (this.new1_password != this.new2_password) {
                this.loadingIndicator = false;
                //las contraseñas no coinciden
                Swal.fire({
                    text:'Las contraseñas no coinciden',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                return false;
            }
            axios.put(`${PATH_APP}/profile/admin/password`, {
                old_password: this.old_password,
                new1_password: this.new1_password,
                new2_password: this.new2_password
            })
            .then(response => {
                this.loadingIndicator = false;
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                this.loadingIndicator = false;
                console.log(error);
                if (error.status != 400){
                    //la contraseña antigua no corresponde
                    Swal.fire({
                        text:'La contraseña antigua no corresponde',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }else{
                    helperResponseMessage(response);

                }
            });
        },
        updatePhoto: function () {
            this.loadingIndicator = true;
            var data = new FormData();
            const photoInput = document.querySelector('input[name="photo"]');

            if (photoInput.files.length > 0) {
                data.append('photo', photoInput.files[0]);
            }else{
                data.append('photo', 'no-photo.jpg');
            }
            
            axios.post(PATH_APP+'/profile/admin/photo', data)
            .then(response => {
                this.loadingIndicator = false;
                helperResponseMessage(response);
            })
            .catch(function (error)  {
                this.loadingIndicator = false;
                
                helperResponseMessage(error.response);
            });
        }
    }
});