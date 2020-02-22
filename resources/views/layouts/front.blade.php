<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/lightslider/css/lightslider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <a href="/" title="Home" rel="home" id="logo">
            <img src="images/logo.png" class="img-fluid" alt="Government Logo">
          </a>
        </div>

        <div class="col-md-8 slogan">
          <h1>Nepal Citizen Charter of Basbariya Muncipality</h1>
          <h2>
            बसबरीया गाउँपालिकाबाट प्रदान गरिने सेवाहरुको विवरण
          </h2>
        </div>

        <div class="col-md-1 nepal-flag">
            <img src="images/WavingFlag.gif" class="img-fluid" alt="Nepal Flag">
        </div>
        <div class="col-md-1 visit-nepal">
            <img src="images/visit-nepal-2020.png" class="img-fluid" alt="Visit Nepal 2020">
        </div>
      </div>
    </div>

      
  </header>
  <!-- <hr> -->
  <div class="row text-center header-info">
    <div class="col-md-12">
      <strong>अनुसूची फारम कालाे मसिले भर्नुहाेला ।</strong>
    </div>
  </div>
  @yield('content')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor/lightslider/js/lightslider.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
@yield('scripts')
</body>
</html>
