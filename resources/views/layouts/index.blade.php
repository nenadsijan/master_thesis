
<!DOCTYPE html>
<html lang="en">
  <head>
  
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Master thesis application</title>

   <!--     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --> 
   <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

 <!-- Jquery   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script type="text/javascript" src="{{asset('js/jquery.bootpag.js')}}"></script>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css"/>
  </head>

  <body>
@hasSection('content')   
  @include('inc.header')
  @include('inc.nav')
@endif  
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
    <div class="container">
     
       
@hasSection('content')
@include('inc._messages')
  @yield('content')

@endif
@hasSection('content2')
   @yield('content2')
@endif
    </div> <!-- /container -->


<!--<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
  <script src="https://code.highcharts.com/stock/highstock.js"></script>
  <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.15.0/lodash.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
  </body>
    @hasSection('content')
      @include('inc.footer')
  @endif  
</html>
