<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
<meta charset="utf-8">
    <title>@yield('title') Sajh Dhaj ke - Clothing Brand</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='Discover an exquisite collection of dupattas that add a touch of elegance and grace to your ensemble. Our online store offers a wide range of
    beautifully crafted dupattas, perfect for adding a vibrant and stylish element to any outfit.' name='description'>
    <meta content='e-commerce, online shopping, products, buy, shop, online store,Fashion clothing,Trendy outfits,
        Womens fashion,designer clothing, dresses, trendy fashion, Wedding dupatta, Bridal dupatta, Designer dupatta,
        Embroidered dupatta, Silk dupatta, Net dupatta, Sequin dupatta, Zari dupatta, Phulkari dupatta, Heavy dupatta
        Dupatta with border, Dupatta with tassels, Dupatta with gota patti work, Dupatta with mirror work
        Dupatta with stone work, Nikah Dupatta, Qabool hai Dupatta, wedding saree, bridal saree, partywear lehengacholi, colloboration, support' name='keyword'>
    <meta content='en_US' property='og:locale'>
    <meta content='website' property='og:type'>
    <meta content='Sajh Dhaj ke - Clothing Brand' property='og:title'>
    <meta content='Sajh Dhaj ke - Clothing Brand' property='og:site_name'>
    <meta content='Discover an exquisite collection of dupattas that add a touch of elegance and grace to your ensemble. Our online store offers a wide range of
    beautifully crafted dupattas, perfect for adding a vibrant and stylish element to any outfit.' property='og:description'>
    <meta content='https://sajhdhajke.com' property='og:url'>
    <meta name="p:domain_verify" content="89b36b6a4f88a087dfe535cfb0e76109"/>
    <!-- Favicon -->
    <script  async>
        var config = {
                    data: {
                        csrf:"{{csrf_token()}}",
                        base_url:"{{  url('') }}"
                    }
                };
    </script>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/frontend/assets/imgs/theme/favicon.ico') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/maind134.css?v=3.4') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .whats-app {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            left: 15px;
            background-color: #ffc46e;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-float {
            margin-top: 16px;
        }
    </style>
    <style>
        .toast_container{
            /* font-family: 'Poppins', sans-serif; */
            padding:3rem;
            margin:0 auto;
            width:700px;
            height:500px;
            /*  border-radius:0.5rem;*/
            background-color:#eff2fb;
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0);
        }
        .btngp_container{
            margin-top:2rem;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        #btnSuccess{
            background-color:#1bc5bd;
            border-color:#1bc5bd;
        }
        #btnInfo{
            background-color:#187de4;
            border-color:#187de4;
        }
        #btnWarning{
            background-color:#ee9d01;
            border-color:#ee9d01
        }
        #btnError{
            background-color:#ee2d41;
            border-color:#ee2d41;
        }
        #btnSuccess,#btnInfo,#btnWarning,#btnError{
            color:#fff;
            /* border-radius:0.5rem; */
            font-weight:400 !important;
            font-size:0.765rem;
            width:90px;
            height:36px;
            margin:3px;
            cursor:pointer;
        }
        /*Change Font in Toast Message */
        .toast-success,.toast-info,.toast-warning,.toast-error{
            /* width:400px !important; */
            font-family: 'Poppins', sans-serif;
            font-size:0.75rem;
            font-weight: bold;
            /* border-radius:1rem !important; */
            background-color:#ffffff;
            color:#0f3354 !important;
            border-color:transparent !important;
        }
        /*change close button design customize*/
        .closebtn{
            width:25px;
            height:25px;
            border-radius:50%;
            background-color:#ccd7fc !important;
        }
        .closebtn>i{
            color:#000617;
            font-weight:500;
        }
        #toast-container>.toast-success {
            background-image:  url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAKLSURBVHgBzZZNbtpAFMffjMFRQY28hFKpzg1gGZFKWGkqdZX2BHVOUHIC4AQ0J6g5QZVVpDTUqC10V3GDelGqSF3UG1cqgZm+GYIVbPAHoCp/CWY89sxP78289wbgP4tAShW+XugwyeiiP6Xc/VV9PkwzPxao2e+1fHbXBEqOgfEyztDCq5AecN4ZVQ+tuPUigY8H9hvOWHMpZLkc/LWiwEuBwqqcqrUJMBPWk+WN6alrGG4sULpQfWjjqzJsJDL0xsQIQmnws7y6294cJsTLeZW1g6MLwFK/a2JjwvZkFgfd+kogqgFbFuXQ0GxbCwFvrdNhHXHew3+Lz05pUNqD7MQMAYGT17AebTg6eGZMx+PWqhijVDme9zP+KOE1SItCixhVXom+oqp4sld4iHP/EEoLS/3LcsSqrnQVtsFXaFHret9wHvXtBkRvh1b81n3iA6eMrM4kBNw/Y1qZKrSyuEf8TGSUwucPNUwQTYiR4rE9HxgjPb/DGsISytiJRCHYyynNgn2hK5S+gxSaATMZJ/IrDvXip6uXP54e9QjjZ4xSw60YLu5bnCt9/cXKIlr/YGFY/MYmKkm7eBIr18YLRzzIxM7ZW0godL9k3Q2LuLqmKTs70n3ClbKKJBWRcQqLQJiex07kvFYafLRlCCQvWcKYjs+ed3RMPzcq+w6QYqEkLDxgP6uHe/Nn30JHlBEOLdiyRKwGnhdV+nJl4ZVhzTQXkoWH5eTuQCgOszdKXRRP2Fh86OXoaXA0BBSuzWKlFpciWJvFO5gYZKwGX0VeokTJwk1vkKRlS+Zb1hodHK2Mz0T3UlkrRflaVlEkhOMWkHMvT61lVqUGLsIvy+Q22WcyE8fZn2Wee6t/lXrvcWjggekAAAAASUVORK5CYII=')!important;
        }
        #toast-container>.toast-info {
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAJaSURBVHgBvVZNbtNQEJ55idd4hSphKnOCkhM0PQHpCUhuADsWLTgkQuwQJyCcoOEEpSfAnKBW6cK0m6wb+U1nXu04bdLkTRT1kxLnOR5/b/7eNwge2Dn61ybEN4agbRFiBAjlPgFM+HfK1xSJfuXDl7/XvQtXEh1fdvnyiT8xeAEzgKKfD3ZHjz6xlOjDeYzN4IQQXsNGYOLpzUH+9VX28B+zQPbx8i0FwZ/NyQQUI7/j+dFFZ2Er8wt5wKA5gW0CoZt/jn7WyxISRvGsKojt8cGEptNWFd46pEFw6kfG+SE6KBrQ4kW27mmu4FDqoVo7wrIaY/AB2Z6U/3USpZbsey8Troed44vujBDuSt8LSDgrJs63IvwNx4HS1IB46msmObEAfUR8RkTvVDnnVDTZoEPgD5cTgG9svPrUWG7babLZntJowl8Ze5hKv/Gttr817htdg+MIucT/D6NWPnjR4/PzLyhg+Bw2ur6jLrfPj9lKH53QgBI07xVqwnkH43KiACKlcnXVrYRUuOHvTGNUFMYRsj6qD3fRTWMsnfkayA6vv0RpudoHJSQdEtKxtwHvsGZ3LaECb3hsyrEg8zGoCiZMzkMkrV5iJlxVlfa9TCym9W5xLB/wRuE4HGE+iEZ8AKRrbRpl3ibirf1OQJ5esnflnFMLcMICXGxfgN1k12ABTh4IsNxA8NM3FaHoZ1IPU/dOGnGbRfVQexgsJXLvsL2r4e69PC8fEzm8UASikTFsAK7glJrTw3nPVhLOiJ9qEF4gllGfxZPbYE/kbH7UF23kX2fS1D6j/i3BTfaqkKQ1ngAAAABJRU5ErkJggg==')!important;
        }
        #toast-container>.toast-warning {
            background-image:  url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAHbSURBVHgBxZZPTsJAFMa/NxDEjYJE1/UGcgOP4BEwARNXeAP0BMSVCzWNJxBPIDfQG8COhSSwJBH7fFNbaKV/ZsA/vwVppzPz5Zt58zHAH0OwZOCisjNHgxWmBYVe9RRTm/FWgiMXzpZHz/LoBE1DUly3EVWwoOSpTkRM43hzXMACY4eBu0HCp6m4PDR1aeywzOSmfKrYuDQSHN9LkTCOFw3Mr/I7DF9JUXt0E1vqzQQVqBN5ne41UdfFop+DtkqppDpmc+Wg3SFeKL5IsGeLfSNw4+02sgrrCn5zl0mhkN83U3DiqjZgtjc+ss95LlMF9TFgj63OmCbPZapgGZbuQsRlsO/mguu6W05KnYlkbvK3BIII24TUyFsR1O50iWNDdBgkuVwR/AF3IYmRFwtvXdIF5f/9ZOGH9UwmlDB/0RPn9Y0Ge8yhiLnIp8IiZCDm9/U81Y02LBzqUpbqMhG0Zv7B9YMz6MBfOrSJMDkyV8z8YNq/WKTuUgeJAZ2hxk+1Fi5rTTSIuWc2Zhl5Sh8DG3dQtLuYh+jIdFgYeTS+w4kieoQdQ3wVTF7RxNhmdopSNlaDAhyswexd8kDfLRG5LvwWUmTX1XO5VoYNemmJYbwnNnhAf7+FPv6DT2e/n0VFnPgUAAAAAElFTkSuQmCC')!important;
        }
        #toast-container>.toast-error {
            background-image:  url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAIlSURBVHgB3VbBbtNAEH2zTugFFIPgwAlzA4mK8AdrvgC+APiSKl/S9AvoH8SfEEQP3PCNAwjcA6IQeYcdYxtvbK/jNr30SVG86519npk3swvcdNCuC7880dF0Ck1QzxVMKHMGKmOYD5sNkoefknSXfQYJvz7TekJ0xIAe2CjJwSf3PybLgXXd+BzpcHZHHQP8CiPAoOWfjVn0edxJKOE7mNLKPka4HNLfG467SOkayGpSCvjF3XWSNSfV9qpbU3W0BzJBxLmkxIXj4bdD/VaBjrFH5Mzxg7MkqcaOhwHwBuOR+V4GVuHNcU0oubMK032GNh+P5Wdjsq4nGet6vh/619OXj1qEUtQeI/EiswJISXFckArZhGMRxcUFvPhJJm4REmPusQnZ0OrHXIdCIKQVmdTrwYTee2xBStV7T/7PIvQZWY/mJWlcSb1oDrdtCZH3Y6HIzOpnjIFxh2E4eofGcvarrZkz8awZXkdIXd/J6rxFyH6jzJK9rsgkjNs5hac8mMy6RRgESDyEECU6OStzKuVk30lwezXQ3NvpNN8Pte2h/bVYeuEX1zYYyb2zVbssBDljMWA+jszCEJ80xw7hv57Hp9gTCLzcPpBboqYA7+xfiqsjtc25FbEWYaG6oFBdiiuQyR7SCgcJS9LCgOHGfxfYMJ6WB2/a/X4AxRnJ9tgir3oLNdpL1KJ59l2KsIIt8ijP7TWRixqcldbn0jDGXBNvPv4C3QjuTqveJGAAAAAASUVORK5CYII=')!important;
        }
        .references{
            margin-top:2rem;
            font-size:0.75rem;
            display:flex;
            justify-content:flex-start;
            flex-direction:column;
            align-items:center;
        }
        .references a{
            text-decoration:none;
            text-align:left;
        }
        #toast-container>div{
            opacity: 1 !important;
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0);
        }
        .toast{
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0);
        }
        .error{
            color: #ea5455;
        }
        .toast-progress {
            background-color: #1bc5bd; /* Green color for success */
        }
        .toast-info .toast-progress {
            background-color: #187de4; /* Blue color for info */
        }
        .toast-warning .toast-progress {
            background-color: #ee9d01; /* Yellow color for warning */
        }
        .toast-error .toast-progress {
            background-color: #ee2d41; /* Red color for error */
        }
     </style>
    @yield('page-style')
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-DKDT4VHHY7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-DKDT4VHHY7');
</script>
<body>
    @include('frontend.panels.navbar')

    @yield('content')
    <a  class="whats-app" href="https://wa.me/8160055855" target="_blank">
        <img src="{{ asset('public/frontend/assets/imgs/theme/icons/1.png') }}" alt="">
    </a>
    @include('frontend.panels.footer')
    @yield('page-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- swall cdn.. --}}
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script  async>
        toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
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

    <!-- Vendor JS-->
    <script src="{{ asset('public/frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/jquery-ui.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('public/frontend/assets/js/maind134.js?v=3.4') }}"></script>
    <script src="https://kit.fontawesome.com/40ab2e945c.js" crossorigin="anonymous"></script>
    {{-- inspect elements... --}}

    <script type="text/javascript">
        $(document).ready(function () {
            //to disable the entire page
            $('body').bind('cut copy paste', function (e) {
                e.preventDefault();
            });
        });
        document.addEventListener('contextmenu', (e) => e.preventDefault());
            function ctrlShiftKey(e, keyCode) {
                return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
                }
                document.onkeydown = (e) => {
                if (
                    event.keyCode === 123 ||
                    ctrlShiftKey(e, 'I') ||
                    ctrlShiftKey(e, 'J') ||
                    ctrlShiftKey(e, 'C') ||
                    (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
                )
                return false;
            };
        </script>
        <script  async>
            $('.burger-icon').on('click', function(){
                $('body').css('overflow-y','hidden');
            });
            $('.mobile-menu-close').on('click', function(){
                $('body').css('overflow-y','');
            });
        </script>
</body>

</html>
