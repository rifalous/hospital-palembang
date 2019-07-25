<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- index.html 13:15:13 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="@yield('description')">
        <meta name="author" content="Arkamaya">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="icon" href="{{ url('assets/images/logo_sm.png') }}" type="image/x-icon">
        <!-- App title -->
        <title>{{ config('app.name') }} | @yield('title')</title>

        <!-- Datepicker -->
        <link href="{{ url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- timepicker -->
        <link href="{{ url('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
        <!-- datetimepicker -->
        <link href="{{ url('assets/plugins/datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
        <link href="{{ url('assets/plugins/datetimepicker/css/bootstrap-datetimepicker-standalone.css') }}" rel="stylesheet">

         <!-- Modal -->
        <link href="{{ url('assets/plugins/custombox/css/custombox.min.css') }}" rel="stylesheet">

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="{{ url('assets/plugins/morris/morris.css') }}">

        <!-- Sweet Alert -->
        <link href="{{ url('assets/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="{{ url('assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('assets/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('assets/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('assets/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('assets/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('assets/plugins/datatables/dataTables.colVis.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('assets/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('assets/plugins/datatables/fixedColumns.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>

        <!-- TOast -->
        <link href="{{ url('assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet" type="text/css" />

        <!-- dropzone -->
        <link href="{{ url('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Select2 -->
        <link href="{{ url('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- fullcalendar -->
        <link href="{{ url('assets/plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" />
        <!-- App css -->
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ url('assets/css/core.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ url('assets/css/components.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ url('assets/css/icons.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ url('assets/css/pages.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ url('assets/css/menu.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ url('assets/plugins/switchery/switchery.min.css') }}">
        
        <!-- custom css -->

        <link rel="stylesheet" href="{{ url('assets/css/custom.css') }}">

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- <script src="{{ url('assets/js/modernizr.min.js') }}"></script> -->
        <script>
            var SITE_URL = "{{ url('/') }}";
        </script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">
                @include('layouts.topbar')
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    @include('layouts.sidebar')
                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    @yield('content')



                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    &copy; 2019 PT. Aisin Indonesia Automotive
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <div class="side-bar right-bar">
            @include('layouts.rightbar')
            </div>
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ url('assets/plugins/jquery-sortable/jquery.mjs.nestedSortable.js') }}"></script>

        <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('assets/js/detect.js') }}"></script>
        <script src="{{ url('assets/js/fastclick.js') }}"></script>
        <script src="{{ url('assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ url('assets/js/waves.js') }}"></script>
        <script src="{{ url('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ url('assets/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ url('assets/plugins/switchery/switchery.min.js') }}"></script>

        <!-- Counter js  -->
        <script src="{{ url('assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
        <script src="{{ url('assets/plugins/counterup/jquery.counterup.min.js') }}"></script>

        <!--Morris Chart-->
		<script src="{{ url('assets/plugins/morris/morris.min.js') }}"></script>
		<script src="{{ url('assets/plugins/raphael/raphael-min.js') }}"></script>

        <!-- DataTable -->
        <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>

        <script src="{{ url('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
        <!-- <script src="{{ url('assets/plugins/datatables/jszip.min.js') }}"></script> -->
        <script src="{{ url('assets/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/dataTables.scroller.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/dataTables.colVis.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/dataTables.fixedColumns.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/dataTables.rowsGroup.js') }}"></script>

        <!-- Jquery Validator -->
        <script src="{{ url('assets/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>

        <!-- Toast -->
        <script src="{{ url('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>

        <!-- App js -->
        <script src="{{ url('assets/js/jquery.core.js') }}"></script>
        <script src="{{ url('assets/js/jquery.app.js') }}"></script>

        <!-- Dropzone -->
        <script src="{{ url('assets/plugins/dropzone/dropzone.min.js') }}"></script>

        <!-- Select2 -->
        <script src="{{ url('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>

        <!-- fullcalendar -->
        <script src="{{ url('assets/plugins/moment/moment.js') }}"></script>
        <script src="{{ url('assets/plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>

        <!-- Datepicker -->
        <script src="{{ url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <!-- timepicker -->
        <script src="{{ url('assets/plugins/timepicker/bootstrap-timepicker.js') }}"></script>
        <!-- datetinepicker -->
        <script src="{{ url('assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ url('assets/plugins/datetimepicker/js/id.js') }}"></script>

        <!-- sweet alert -->
        <script src="{{ url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>

        <!-- autoNumeric -->
        <script src="{{ url('assets/plugins/autoNumeric/autoNumeric.js') }}"></script>

        <!-- flotchart -->
        <script src="{{ url('assets/plugins/flot-chart/jquery.flot.min.js') }}"></script>
        <script src="{{ url('assets/plugins/flot-chart/jquery.flot.time.js') }}"></script>
        <script src="{{ url('assets/plugins/flot-chart/jquery.flot.tooltip.min.js') }}"></script>
        <script src="{{ url('assets/plugins/flot-chart/jquery.flot.resize.js') }}"></script>
        <script src="{{ url('assets/plugins/flot-chart/jquery.flot.pie.js') }}"></script>
        <script src="{{ url('assets/plugins/flot-chart/jquery.flot.selection.js') }}"></script>
        <script src="{{ url('assets/plugins/flot-chart/jquery.flot.stack.js') }}"></script>
        <script src="{{ url('assets/plugins/flot-chart/jquery.flot.orderBars.min.js') }}"></script>
        <script src="{{ url('assets/plugins/flot-chart/jquery.flot.crosshair.js') }}"></script>

        <!-- Modal-Effect -->
        <script src="{{ url('assets/plugins/custombox/js/custombox.min.js') }}"></script>
        <script src="{{ url('assets/plugins/custombox/js/legacy.min.js') }}"></script>

        <!-- bootstrap editable -->
        <script src="{{ url('assets/js/bootstrap-editable.min.js') }}"></script>

        <!-- general js -->
        <script src="{{ url('assets/js/general.js') }}"></script>

        @stack('js')

    </body>

<!-- index.html 13:20:01 GMT -->
</html>
