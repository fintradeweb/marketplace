<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <title>MarketPlace</title>
</head>
<body>
  <p>Welcome! Your user has been created in MarketPlace  <?php echo e($usuarioCall->name); ?>.</p>
  <p>These are the user's data to access the platform:</p>
  <ul>
    <li>Email: <?php echo e($usuarioCall->email); ?></li>
    <li>Password: <?php echo e($usuarioCall->password); ?></li>
  </ul>
  <ul>
    <li>
      <a href="http://protomarket.fintrade-acf.com/">Enter our platform</a>
    </li>
  </ul>
</body>
</html>
<?php /**PATH C:\Miguel\Ac\laravel\marketplace\resources\views/marketsend/marketsend.blade.php ENDPATH**/ ?>