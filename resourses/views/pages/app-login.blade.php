<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ APP_NAME }} - Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css?')}}v={{ uniqid() }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/intl-tel-input/build/css/intlTelInput.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body style="background-image: url(https://img.freepik.com/vector-gratis/fondo-abstracto-morado-poligonal_1035-9882.jpg?w=2000);">
    <main id="app">
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div v-if="login" class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center py-2">
                                        <a  class="logo d-flex align-items-center w-auto">
                                            <img  style="max-height:60px;" src="{{ asset('assets/img/apple-touch-icon.png') }}" alt="">
                                            <span class="d-none d-lg-block">{{ APP_NAME }}</span>
                                        </a>
                                    </div><!-- End Logo -->
                                    <div v-if="loginView">
                                        <div class="pt-2 pb-2">
                                            <h5  v-if="showFormLogin" class="card-title text-center pb-0 fs-4">Inicie sesión en su cuenta</h5>
                                            <p  v-if="showFormLogin" class="text-center small">Ingrese su nombre de usuario y contraseña para iniciar sesión</p>
                                            <h5  v-if="showFormRecovery" class="card-title text-center pb-0 fs-4">Recuperar contraseña</h5>
                                            <p  v-if="showFormRecovery" class="text-center small">Ingrese su correo electrónico para recuperar su contraseña</p>
                                        </div>
                                        <form v-if="showFormLogin" class="row g-3 needs-validation" @submit.prevent="login" novalidate>
                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Usuario</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    <input placeholder="user@tuescrito.com" require v-model="email" type="text" name="username" class="form-control" id="yourUsername" required>
                                                    <div class="invalid-feedback">Por favor ingrese su usuario</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="yourPassword" class="form-label">Contraseña</label>
                                                <input placeholder="Tu contraseña" require v-model="password" type="password" name="password" class="form-control" id="yourPassword" required>
                                                <div class="invalid-feedback">¡Por favor ingrese su contraseña!</div>
                                            </div>
                                            <div class="col-12">
                                                <button :disabled="loadingIndicator" class="btn btn-primary w-100" type="submit">Iniciar sesión</button>
                                            </div>
                                            <div class="col-12">
                                                <p @click="toogleForm" style="cursor:pointer; color:cadetblue;" class="small mb-0">¿Has olvidado tu contraseña?</p>
                                                @if ($LOGIN=='user') 
                                                <p @click="activeUserCreate" style="cursor:pointer; color:cadetblue;" class="small mb-0">¿Deseas crear un usuario?</p>
                                                @endif
                                            </div>
                                        </form>
                                        <form v-if="showFormRecovery" class="row g-3 needs-validation" @submit.prevent="recovery" novalidate>
                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Usuario</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    <input placeholder="user@tuescrito.com" require v-model="email" type="text" name="username" class="form-control" id="yourUsername" required>
                                                    <div class="invalid-feedback">Por favor ingrese su usuario</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button :disabled="loadingIndicator" class="btn btn-primary w-100" type="submit">Recuperar usuario</button>
                                            </div>
                                            <div class="col-12">
                                                <p @click="toogleForm" style="cursor:pointer; color:cadetblue;" class="small mb-0">Iniciar sesión</p>
                                            </div>
                                        </form>
                                    </div>
                                    @if ($LOGIN=='user') 
                                    <!--regitros clientes-->
                                    <div v-show="!loginView">
                                        <div class="d-flex justify-content-center py-2">
                                            <p class="text-center small">¡Regístrate en nuestra línea de servicios hoy mismo!</p>
                                        </div>
                                        <form  class="row g-3 needs-validation" @submit.prevent="register" novalidate>
                                            <div class="col-12">
                                                <span class="form-label" >Nombres</span>
                                                <input placeholder="Ingresa tus nombres" required v-model="name" type="text" name="name" class="form-control" id="name">
                                            </div>
                                            <div class="col-12">
                                                <span class="form-label" >Apellidos</span>
                                                <input placeholder="Ingresa tus apellidos" required v-model="last_name" type="text" name="last_name" class="form-control" id="last_name">
                                            </div>
                                            <div class="col-12">
                                                <label for="email" class="form-label">Correo electrónico</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text">@</span>
                                                    <input placeholder="user@tuescrito.com" required v-model="email" type="text" name="email" class="form-control" id="username">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="phone" class="form-label">Teléfono</label>
                                                <div class="form-control border-0 p-0">
                                                    <input placeholder="Tu teléfono" required  type="number" name="phone" class="form-control" id="phone">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Contraseña</label>
                                                <input placeholder="Tu contraseña" required v-model="password" type="password" name="password" class="form-control" id="password">
                                            </div>
                                            <div class="col-12">
                                                <button :disabled="loadingIndicator" class="btn btn-primary w-100" type="submit">Registrarse</button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- var session -->
    <script>
        var PATH_SESSION = "{{ $PATH_SESSION }}";
        var PATH_HOME = "{{ $PATH_HOME }}";
        var PATH_RECOVER = "{{ $PATH_RECOVER }}";
        var PATH_APP = "<?= $_ENV['APP_URL']. $_ENV['APP_LOCATION']."/api/v1" ?>";
        
    </script>
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/vue/vue.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/axios/axios.js') }}"></script>
    <script src="{{ asset('assets/vendor/intl-tel-input/build/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/helpers.js') }}?v={{ uniqid() }}"></script>
    <!-- Template Main JS File -->
    @if ($LOGIN=='user') 
    <script src="{{ asset('assets/js/app.login.user.js') }}?v={{ uniqid() }}"></script>
    @else
    <script src="{{ asset('assets/js/app.login.admin.js') }}?v={{ uniqid() }}"></script>
    @endif
</body>
</html>