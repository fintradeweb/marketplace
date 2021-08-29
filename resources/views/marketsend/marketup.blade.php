<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    <p>Este es un ejemplo 2 de envío de mail  {{ $usuarioCall->created_at }}.</p>
    <p>Estos son los datos del usuario para acceder en la plataforma:</p>
    <ul>
        <li>Prueba Email: {{ $usuarioCall->email }}</li>
        <li>Prueba Password: {{ $usuarioCall->password }}</li>
      </ul>
     <ul>
        <li>
            <a href="http://protomarket.fintrade-acf.com/">
                Ingresa a nuestra plataforma
            </a>
        </li>
    </ul>
</body>
</html>
