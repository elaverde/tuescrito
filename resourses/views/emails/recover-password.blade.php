<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido a mi sitio web</title>
</head>
<body>
    <h1>Hola, {{ $name }}</h1>
    <p>Se ha generado una nueva clave para el usuario {{$name}} ({{$email}}).</p>
    <p>La clave generada automáticamente es: {{$password}}</p>
</body>
</html>
