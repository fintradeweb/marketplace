<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MarketPlace</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet"> <!--Añadimos el css generado con webpack-->
  </head>
  <body>
    <div id="app" class="content">
      <br>
      @if ($error)
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-8 col-sm-12">
            <div class="alert alert-danger" role="alert">
              {{ $error }}
            </div>
          </div>
        </div>
      @endif

      <!--La equita id debe ser app, como hemos visto en app.js-->
      <!--<example-component></example-component>--><!--Añadimos nuestro componente vuejs-->
    </div>
    <script src="{{asset('js/app.js')}}"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->
    <script src="{{ asset('js/information.js') }}" defer=""></script>

</script>
  </body>
</html>
