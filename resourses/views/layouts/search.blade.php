<html lang="es">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ APP_NAME }} - @yield('module-name')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}?v={{ uniqid() }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css?') }}v={{ uniqid() }}" rel="stylesheet">
  <link href="{{ asset('assets/css/app.css?') }}v={{ uniqid() }}" rel="stylesheet">
</head>
<body>
    @yield('module-form')
    @include('componets.footer2')
    <!-- Vendor JS Files -->
    <script>
        var PATH_APP = "<?= $_ENV['APP_URL']. $_ENV['APP_LOCATION']."/api/v1" ?>";
    </script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/vue/vue.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/axios/axios.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/helpers.js') }}?v={{ uniqid() }}"></script>
    <script src="{{ asset('assets/js/main.js') }}?v={{ uniqid() }}"></script>
    
    @yield('scripts')
</body>
</html>