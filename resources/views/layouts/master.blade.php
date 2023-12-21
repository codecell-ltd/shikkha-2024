<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Codecell | Dashboard</title>

    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Toastr style -->
    <link href="{{ asset('assets/admin/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- Gritter -->
    <link href="{{ asset('assets/admin/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    {{-- summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    @stack('admincss')
    <style>
        .btn-primary {
            background-color: #0c00fa;
            border-color: #0c00fa;
        }

        .btn-primary:hover {
            background-color: #1207d8;
            border-color: #1005de;
        }

        .btn-success {
            background-color: #03990d;
            border-color: #03990d;
        }

        .btn-success:hover {
            background-color: #07bf14;
            border-color: #07c814;
        }
    </style>

</head>

<body>
    
    <div id="wrapper">

        @include('layouts.sidebar')

        <div id="page-wrapper" class="gray-bg dashbard-1">

            @include('layouts.topnav')

            @yield('content')

            <div class="footer">
                <div class="float-right">
                    Shikkha is the best for any School Management System.
                </div>
                <div>
                    <strong>Copyright</strong> Codecell Ltd. &copy; 2023
                </div>
            </div>

        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- summernote editor start --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $('#summernote').summernote({
            placeholder: 'write here',
            tabsize: 2,
            height: 300
        });
    </script>
    {{-- summernote editor end --}}
    <!-- Mainly scripts -->
    <script src="{{ asset('assets/admin/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script> --}}

    <!-- Flot -->
    <script src="{{ asset('assets/admin/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <!-- Peity -->
    <script src="{{ asset('assets/admin/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('assets/admin/js/inspinia.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/admin/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- GITTER -->
    <script src="{{ asset('assets/admin/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('assets/admin/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ asset('assets/admin/js/demo/sparkline-demo.js') }}"></script>

    <!-- datatable  -->
    <script src="{{ asset('assets/admin/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- ChartJS-->
    <script src="{{ asset('assets/admin/js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- ckeditor 4-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> --}}
    <!-- Toastr -->
    <script src="{{ asset('assets/admin/js/plugins/toastr/toastr.min.js') }}"></script>
    {{-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> --}}
    {!! Toastr::message() !!}

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [

                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });
    </script>


    @stack('js')

</body>

</html>
