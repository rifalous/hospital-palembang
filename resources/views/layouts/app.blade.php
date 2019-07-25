<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- page-login.html 13:25:28 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login form">
    <meta name="author" content="Arkamaya">

    <!-- App favicon -->
    <link rel="icon" href="{{ url('assets/images/logo_sm.png') }}" type="image/x-icon">
    <!-- App title -->
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- App css -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{ url('assets/js/modernizr.min.js') }}"></script>
    </head>
    <body class="bg-transparent">
        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    @yield('content')
                </div>
            </div>
          </section>
          <!-- END HOME -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('assets/js/detect.js') }}"></script>
        <script src="{{ url('assets/js/fastclick.js') }}"></script>
        <script src="{{ url('assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ url('assets/js/waves.js') }}"></script>
        <script src="{{ url('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ url('assets/js/jquery.scrollTo.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ url('assets/js/jquery.core.js') }}"></script>
        <script src="{{ url('assets/js/jquery.app.js') }}"></script>

    </body>

<!-- page-login.html 13:25:29 GMT -->
</html>