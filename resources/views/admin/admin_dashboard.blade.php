<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('admin_backend/assets/images/favicon-32x32.png') }}" type="image/png" />
    <link href="{{ asset('admin_backend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <!--plugins-->
    <link href="{{ asset('admin_backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('admin_backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('admin_backend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('admin_backend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin_backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_backend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_backend/assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_backend/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}"
        rel="stylesheet" />
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('admin_backend/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_backend/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_backend/assets/css/header-colors.css') }}" />
    <link href="{{ asset('admin_backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Dashboard</title>
</head>


<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('admin.body.sidebar')
        <!--end sidebar wrapper -->

        <!--start header -->
        @include('admin.body.header')
        <!--end header -->

        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('admin')
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        @include('admin.body.footer')
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    <div class="switcher-wrapper">
        <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        <div class="switcher-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
            </div>
            <hr />
            <h6 class="mb-0">Theme Styles</h6>
            <hr />
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                    <label class="form-check-label" for="lightmode">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                    <label class="form-check-label" for="darkmode">Dark</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                    <label class="form-check-label" for="semidark">Semi Dark</label>
                </div>
            </div>
            <hr />
            <div class="form-check">
                <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
                <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
            </div>
            <hr />
            <h6 class="mb-0">Header Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator headercolor1" id="headercolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor2" id="headercolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor3" id="headercolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor4" id="headercolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor5" id="headercolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor6" id="headercolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor7" id="headercolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor8" id="headercolor8"></div>
                    </div>
                </div>
            </div>

            <hr />
            <h6 class="mb-0">Sidebar Backgrounds</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('admin_backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('admin_backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/jquery-knob/excanvas.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
    <script>
        $(function() {
            $(".knob").knob();
        });
    </script>
    <script src="{{ asset('admin_backend/assets/js/index.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/js/validate.min.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('admin_backend/assets/js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            let type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('admin_backend/assets/js/code.js') }}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script src="{{ asset('admin_backend/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
</body>

</html>
