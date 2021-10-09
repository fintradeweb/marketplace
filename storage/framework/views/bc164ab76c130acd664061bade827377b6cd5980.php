<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title><?php echo e(config('app.name', 'MarketPlace')); ?></title>

  <!-- Scripts -->
  <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome/css/font-awesome.min.css')); ?>">
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
          <?php echo e(config('app.name', 'MarketPlace')); ?>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            
          </ul>

          <?php if(isset(Auth::user()->name)): ?>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a id="notificationDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <i class="fa fa-bell" aria-hidden="true" style="font-size:20px;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                  <a class="dropdown-item">
                    Not1                
                  </a>
                </div>  
              </li> 
            </ul>
          <?php endif; ?>     

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav">
            <!-- Authentication Links -->
            <?php if(auth()->guard()->guest()): ?>
              <?php if(Route::has('login')): ?>
                <!--<li class="nav-item">
                  <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                </li>-->
              <?php endif; ?>

              <?php if(Route::has('register')): ?>
                <!--<li class="nav-item">
                  <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                </li>-->
              <?php endif; ?>
            <?php else: ?>
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <?php echo e(Auth::user()->name); ?>

                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <?php echo e(__('Logout')); ?>

                  </a>

                  <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                  </form>
                </div>
              </li>
            <?php endif; ?>
          </ul>          
          &nbsp;
          
          
          
        </div>
      </div>
    </nav>

    <main class="py-4">
      <?php echo $__env->yieldContent('content'); ?>
    </main>
  </div>
</body>
</html>
<?php /**PATH C:\Miguel\Ac\laravel\marketplace\resources\views/layouts/app.blade.php ENDPATH**/ ?>