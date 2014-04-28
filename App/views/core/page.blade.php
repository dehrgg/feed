<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{{ $title or 'Dylan Gibbs - Demos @ Dehrg.com'}}} </title>
    
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>

  @include('core.navigation', array('active' => 'portfolio'))
  @include('core.demonav')
  
  <div class="modal fade" id ="ajax-modal" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog ajax-dialog">
      <div class="modal-content ajax-content">
        <div class="modal-body">
          <img src="{{ asset('img/ajax.gif') }}"> <span class="ajax-message"> </span>
        </div>
      </div>
    </div>
  </div>
  @yield('outer-content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-4 col-md-3 sidebar">
        @include('core.sidemenu')
      </div>
      <div class="col-sm-8 col-md-8 page-content">
	      @yield('content')
      </div>
    </div>
  </div>

    <!-- Include scripts for all pages -->
    @include('core.scripts', $scripts)

    <!-- Include scripts for inheriting pages -->
    @yield('scripts')

  </body>
</html>