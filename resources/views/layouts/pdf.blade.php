<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- index.html 13:15:13 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="@yield('description')">
        <meta name="author" content="Arkamaya">

        <!-- App favicon -->
        <link rel="icon" href="{{ url('assets/images/logo_sm.png') }}" type="image/x-icon">
        <!-- App title -->
        <title>{{ config('app.name') }} | @yield('title')</title>

        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
        <style>
            @import url(https://fonts.googleapis.com/css?family=Varela+Round);
            @import 'https://fonts.googleapis.com/css?family=Hind+Madurai:600,700';
            body{
                font-family:'Varela Round',sans-serif;
            }
            .font-secondary,.h1,.h2,.h3,.h4,.h5,.h6,.label,b,h1,h2,h3,h4,h5,h6,strong{font-family:'Hind Madurai',sans-serif}
            .form-control {
                border: 1px solid #e3e3e3;
                border-radius: 4px;
                padding: 7px 12px;
                height: 38px;
                max-width: 100%;
                -webkit-box-shadow: none;
                box-shadow: none;
                -webkit-transition: all 300ms linear;
                -moz-transition: all 300ms linear;
                -o-transition: all 300ms linear;
                -ms-transition: all 300ms linear;
                transition: all 300ms linear;
                display: block;
                width: 100%;
                font-size: 14px;
                line-height: 1.42857143;
                color: #555;
                background-color: #fff;
                background-image: none;
            }
            .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
                background-color: #eee;
                opacity: 1;
            }
        </style>

    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page" style="margin-left: auto; margin-right: auto;">
                <!-- Start content -->
                <div class="content">
                    @yield('content')
                </div> <!-- content -->
            </div>

        </div>

    </body>

<!-- index.html 13:20:01 GMT -->
</html>
