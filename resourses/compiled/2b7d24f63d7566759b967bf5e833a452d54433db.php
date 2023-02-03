<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo e(APP_NAME); ?> - Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="<?php echo e(asset('assets/img/favicon.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('assets/img/apple-touch-icon.png')); ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/boxicons/css/boxicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/quill/quill.snow.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/quill/quill.bubble.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/remixicon/remixicon.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/simple-datatables/style.css')); ?>" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
</head>
<body>
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="">
                                    <span class="d-none d-lg-block"><?php echo e(APP_NAME); ?></span>
                                </a>
                            </div><!-- End Logo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Inicie sesión en su cuenta</h5>
                                        <p class="text-center small">Ingrese su nombre de usuario y contraseña para iniciar sesión</p>
                                    </div>
                                    <form class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Usuario</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Por favor ingrese su usuario</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Contraseña</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">¡Por favor ingrese su contraseña!</div>
                                        </div>

                                    
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Iniciar sesión</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0"><a href="pages-register.html">¿Has olvidado tu contraseña?</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="<?php echo e(asset('assets/vendor/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/chart.js/chart.umd.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/echarts/echarts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/quill/quill.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/simple-datatables/simple-datatables.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/tinymce/tinymce.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/php-email-form/validate.js')); ?>"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
</body>

</html>