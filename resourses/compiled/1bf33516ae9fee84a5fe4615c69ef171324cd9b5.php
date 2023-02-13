<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido a mi sitio web</title>
</head>
<body>
    <h1>Hola, <?php echo e($name); ?></h1>
    <p>Gracias por registrarse en mi sitio web con el correo electrónico <?php echo e($email); ?>.</p>
    <p>Puedes iniciar sesión con la siguiente contraseña: <?php echo e($password); ?></p>
    <p>En el siguiente enlace <a>aquí</a></p>
</body>
</html>