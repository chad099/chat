<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <link rel="shortcut icon" src="/assets/images/fav-icon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title>Video Tutorials</title>
  <!-- CSS  -->
  <link href="/assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/assets/css/custom.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="/assets/js/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/jquery.autocomplete.js"></script>
  <!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBX3ITMuqhf7qySqQ96BUCben3hqRekIgk&libraries=places"></script>
</head>
<body>

<nav role="navigation">

@include('includes.navigation')
</nav>
<main>
  @include('errors.message')
	@yield('content')
</main>

@if(!Auth::check() || Auth::check() && Auth::user()->type !='admin')
<footer class="page-footer teal">
  @include('includes.footer')
</footer>
@endif

@if(Auth::check() && Auth::user()->type == 'admin')
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a href="/addtutorial/create" class="btn-floating btn-large red">
      <i class="large material-icons">mode_edit</i>
    </a>
</div>
@endif
</main>
  <!--  Scripts-->
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>
  <script src="/assets/niceScroll/jquery.nicescroll.js"></script>
  <script src="/assets/js/tutorial.js"></script>

  </body>
<script>
$('body').niceScroll({
					cursorcolor:"#ee6e73",
					cursorwidth:"10px",
					cursorborderradius: '0px',
					autohidemode : false,
					background : '#DDDDDD',
					cursorborder : 'none',

					});

          $(document).ready(function() {
              $('select').material_select();
            });

</script>
</html>
