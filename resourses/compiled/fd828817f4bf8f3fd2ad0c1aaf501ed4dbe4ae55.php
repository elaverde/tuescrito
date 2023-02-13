<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido a mi sitio web</title>
</head>
<body>
    <h1>Hola, <?php echo e($name); ?></h1>
    <p>Gracias por registrarse en mi sitio web con el correo electrónico <?php echo e($email); ?>.</p>
    <p>Para completar su registro, por favor haga clic en el siguiente enlace:</p>
    <a href="<?php echo e($activationLink); ?>"><?php echo e($activationLink); ?></a>
    <p>Atentamente,</p>
    <p>El equipo de mi sitio web</p>
</body>
</html>