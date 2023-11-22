@extends('frontend.layouts.fullLayoutMaster')

@section('content')
<style>
.password-wrapper {
    position: relative;
}

.show-password {
    position: absolute;
    top: 16%;
    right: 10px;
    /* transform: translateY(-50%); */
    background-color: transparent;
    border: none;
    cursor: pointer;
}

.show-password:focus {
    outline: none;
}

.show-password i {
    font-size: 15px;
}

#password {
    width: 100%;
    padding-right: 40px;
}
#confirm_password {
    width: 100%;
    padding-right: 40px;
}
</style>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                <span></span> Pages
                <span></span> Login
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-5">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Reset Password</h3>
                                    </div>
                                    <form method="POST" action="{{ route('reset.password.post') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="@error('email') is-invalid @enderror" readonly name="email" value="{{ $email ?? old('email') }}" autocomplete="email" placeholder="Your Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="password-wrapper">
                                                <input required="" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="password" id="password">
                                                <button type="button" class="show-password" id="show-password" aria-label="Show password">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="password-wrapper">
                                            <input required="" type="password" name="confirm_password" placeholder="Confirm password" id="confirm_password">
                                            <button type="button" class="show-password" id="show-confirmpassword" aria-label="Show password">
                                                <i class="far fa-eye"></i>
                                              </button>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up" >Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('page-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script  async>
    $('#validation').validate({
     rules: {
        password: {
            required: true,
        },
        confirm_password: {
            required: true,
            equalTo: '#password',
        },

     },
     messages: {
       confirm_password: {
         required: "This confirm password field is required",
         equalTo: "Your password and confirm password do not match"
       },

     }
 })

 </script>
  <script  async>
    const passwordInput = document.getElementById('password');
const showPasswordButton = document.getElementById('show-password');

showPasswordButton.addEventListener('click', function() {
  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordInput.setAttribute('type', type);
  showPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
  showPasswordButton.querySelector('i').classList.toggle('fa-eye');
  showPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
});
</script>
<script  async>
    const confirmpasswordInput = document.getElementById('confirm_password');
const showconfirmPasswordButton = document.getElementById('show-confirmpassword');

showconfirmPasswordButton.addEventListener('click', function() {
  const type = confirmpasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  confirmpasswordInput.setAttribute('type', type);
  showconfirmPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
  showconfirmPasswordButton.querySelector('i').classList.toggle('fa-eye');
  showconfirmPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
});
</script>
@endsection
