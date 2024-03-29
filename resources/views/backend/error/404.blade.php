<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Error | </title>

    <!-- Bootstrap -->
    <link href="{{ url('/backend/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('/backend/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ url('/backend/vendors/nprogress/nprogress.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ url('/backend/build/css/custom.min.css') }}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number">404</h1>
              <h2>Sorry but we couldn't find this page</h2>
              <p>This page you are looking for does not exist <a href="#">Report this?</a>
              </p>
              <div class="mid_center">
                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ url('/backend/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ url('/backend/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ url('/backend/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ url('/backend/vendors/nprogress/nprogress.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ url('/backend/build/js/custom.min.js') }}"></script>
  </body>
</html>
