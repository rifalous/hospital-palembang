<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- index.html 13:15:13 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cubic Pro | @yield('title')</title>
    
    @stack('style')
    

    <style>
        .form-control:focus {
            outline: none !important;
            border-color: none;
            box-shadow: none;
        }
        .img-slick {
            width: 100%;
            height: 150px;
            padding: 0px 30px;
            object-fit: cover;
        }
        .new_arrivals {
            padding-bottom: 0px !important;
            padding-top: 0px !important;
        }
        .custom_list li {
            white-space: nowrap;
        }
        .custom_dropdown_placeholder {
            white-space: nowrap;
            width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .custom_dropdown i {
            position: absolute;
            top: 40%;
            right: 5%;
        }
        .page_prev i, .page_next i {
            color: rgba(0,0,0,0.7) !important;
        }
        .page_nav li.active {
            background-color: rgba(0,0,0,0.7);
            cursor: not-allowed;
        }
        .page_nav li.active a {
            color: #fff;
        }
        .shop_page_nav .disabled {
            opacity: .5;
            cursor: not-allowed;
        }
        .page_nav > li > a {
            width: 100% !important;
        }
        .page_nav > li {
            text-align: center;
        }
    </style>

</head>

<body>
    <script>
        var SITE_URL = "{{ url('/') }}";
    </script>
    @yield('content')

    <!-- Copyright -->
	<div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col">
                    <footer class="footer text-center">
                        &copy; 2019 PT. Aisin Indonesia Automotive
                    </footer>
                </div>
            </div>
        </div>
    </div>

    @stack('js')
</body>