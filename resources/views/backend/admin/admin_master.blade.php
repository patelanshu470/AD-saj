<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />


<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Sajh Dhaj ke | Admin</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/frontend/assets/imgs/theme/favicon.ico') }}">


    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/src/plugins/switchery/switchery.min.css') }}">
    <!-- bootstrap-tagsinput css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <!-- bootstrap-touchspin css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendors/styles/style.css') }}">
    {{-- sweetalert2  --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('public/src/plugins/sweetalert2/sweetalert2.css') }}">
    <style>
        #swal2-title{
            padding-top: 10px;
        }

        .sidebar-menu .dropdown-toggle:after{
            position: absolute;
        }
    </style>
</head>

<body>
    {{-- Loader here  --}}
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="{{asset('public/images/logo/logo.png')}}" alt="" style="width: 90px"></div>
            <div class='loader-progress' id="progress_div">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text">
                Loading...
            </div>
        </div>
    </div>
    <style>
        .customscroll::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
        }
        ::-webkit-scrollbar {
        width: 8px;
        }
    </style>

    {{-- navbar here  --}}
    @include('backend.admin.body.navbar')
    @include('backend.admin.body.right_sidebar')
    @include('backend.admin.body.left_sidebar')

    @yield('content')

    @include('backend.admin.body.footer')






    {{-- Toster here  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('status'))
            toastr.success("{{ Session::get('status') }}");
        @endif
        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>


    <!-- js -->
    <script src="{{ asset('public/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/dashboard.js') }}"></script>
    <!-- switchery js -->
    <script src="{{ asset('public/src/plugins/switchery/switchery.min.js') }}"></script>
    <!-- bootstrap-tagsinput js -->
    <script src="{{ asset('public/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <!-- bootstrap-touchspin js -->
    <script src="{{ asset('public/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/advanced-components.js') }}"></script>
	<!-- add sweet alert js & css in footer -->
	<script src="{{asset('public/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
	<script src="{{asset('public/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

    <a href="javascript:void(0)" id="check" style="display: none;">click here</a>
    <a href="{{ route('orders') }}" id="index_page" style="display: none;">click here</a>
    <audio id="audio" src="{{ asset('public/audio/notification.mp3') }}" preload="auto">click me</audio>

    <audio id="audio1" src="{{ asset('public/audio/notification.mp3') }}" preload="auto">click me</audio>
    <a href="javascript:void(0)" id="check1" style="display: none;">click here</a>
    <a href="{{ route('product') }}" id="index_page1" style="display: none;">click here</a>

    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script>
        function getData() {
            $.ajax({
            url: "{{ route('CheckNewOrder') }}",
            type: "GET",
            success: function(data) {
                // update your page with the new data
                if (data) {
                    Swal.fire({
                title: "You have new order, check please.",
                icon: "non",
                showCancelButton: false,
                confirmButtonColor: "#1b00ff",
                confirmButtonText: "Ok, let me check",
                onOpen: function () {
                    var audplay = new Audio(assetBaseUrl)
                    audplay.play();
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('index_page').click();
                } else
                    return false;
            });
            document.getElementById('check').click();
            document.getElementById('audio').play();
                }
            }
            });
        }
        setInterval(getData, 5000); // 1000 milliseconds = 1 second

        //   new order update...
        $('#check').on('click',function() {
            var status = 1;
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('ReadNewOrder') }}",
                data: {'status': status},
                success: function(data){
                }
            });
        });
    </script>

{{-- minimux quantity code... --}}

<script type="text/javascript">
    $(document).ready(function(){
      //jquery for toggle sub menus
      $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).parent('li').addClass('show');
        if ($(this).data('option') === 'on') {
            $(this).data('option', 'off');
            $(this).parent('li').removeClass('show');
        } else {
            $(this).data('option', 'on');
            $(this).parent('li').addClass('show');
        // Do something when data-option is not 'on'
        }
        $(this).find('.dropdown').toggleClass('rotate');
      });

      //jquery for expand and collapse the sidebar
      $('.menu-btn').click(function(){
        $('.dropdown').addClass('show');
        $('.menu-btn').css("visibility", "visible");
      });

      $('.close-btn').click(function(){
        $('.dropdown').removeClass('show');
        $('.menu-btn').css("visibility", "visible");
      });
    });
    </script>
</body>
</html>
