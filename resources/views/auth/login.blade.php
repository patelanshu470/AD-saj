{{-- custom login page  --}}
<!DOCTYPE html>
<html>


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Sajh Dhaj ke</title>

    <!-- Site favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/frontend/assets/imgs/theme/favicon.ico') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendors/styles/style.css') }}">
    <style>
        .password-wrapper {
          position: relative;
          width: 100%;
        }

        #show-password {
          position: absolute;
          top: 50%;
          right: 10px;
          transform: translateY(-50%);
          background-color: transparent;
          border: none;
          cursor: pointer;
        }

        #show-password:focus {
          outline: none;
        }

        #show-password i {
          font-size: 15px;
        }

        #password {
          width: 100%;
          padding-right: 40px;
        }
        </style>
</head>

<body class="login-page">
    <div class="" style="height: 140px;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo" style="border-bottom: 0">
                <a href="#">
                    <img src="{{asset('public/frontend/assets/imgs/theme/Invoice-logo.png')}}" alt="" style="width: 110px;
                    padding-top: 62px;">
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('public/vendors/images/login-page-img.png') }}" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Admin Login</h2>
                        </div>
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="input-group custom">
                                <input id="email" type="email" placeholder="Enter your email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <div class="input-group-append custom">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>


                            <div class="input-group custom">
                                <div class="password-wrapper">
                                <input id="password" type="password" placeholder="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">
                                    <button type="button" id="show-password" aria-label="Show password">
                                        <i class="icon-copy fa fa-eye"></i>
                                      </button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="input-group-append custom">
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">

                                        <input class="form-check-input custom-control-input" type="checkbox"
                                            name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">

                                        <button type="submit"class="btn btn-primary btn-lg btn-block">
                                            Sign In
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="{{ asset('public/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/layout-settings.js') }}"></script>
    <script >
        const passwordInput = document.getElementById('password');
        const showPasswordButton = document.getElementById('show-password');

    showPasswordButton.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      showPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
      showPasswordButton.querySelector('i').classList.toggle('icon-copy fa fa-eye');
      showPasswordButton.querySelector('i').classList.toggle('fa fa-eye-slash');
    });
    </script>
</body>

</html>
