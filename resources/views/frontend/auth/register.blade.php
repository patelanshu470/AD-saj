@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
    <style>
        .error{
            color: #ea5455;
        }
.password-wrapper {
  position: relative;
}

.show-password {
  position: absolute;
  top: 16%;
  right: 10px;
  /* transform: translateY(12%); */
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
@endsection

@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                <span></span> Pages
                <span></span> Register
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row" style="display: flex; justify-content: center;">
                        <div class="col-lg-6">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Create an Account</h3>
                                    </div>
                                    <p class="mb-50 font-sm">
                                        Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy
                                    </p>
                                    <form method="POST" action="{{ route('register') }}" id="validation">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="@error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" name="first_name" placeholder="First Name">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="@error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" name="last_name" placeholder="Last Name">
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="@error('phone_number') is-invalid @enderror" {{ old('phone_number') }} name="phone_number" id="phone_number" maxlength="10"  placeholder="Phone Number">
                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="password-wrapper">
                                                <input type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Password" id="password">
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
                                                <input type="password" class="@error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm_password" placeholder="Confirm password">
                                                <button type="button" class="show-password" id="show-confirmpassword" aria-label="Show password">
                                                    <i class="far fa-eye"></i>
                                                  </button>
                                            </div>
                                            @error('confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="login_footer form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input"  type="checkbox" name="term_conditions" id="exampleCheckbox12" required>
                                                    <label class="form-check-label" for="exampleCheckbox12"><span>I agree to <a href="{{ route('user.termCondition') }}">Terms &amp; Condition.</a> </span></label>
                                                    <p id="chekcbox_error" class="error" for="" style="font-size: 0.9rem;display: none">This terms and condition field is required.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up" >Submit &amp; Register</button>
                                        </div>
                                    </form>
                                    <div class="divider-text-center mt-15 mb-15">
                                        <span> </span>
                                    </div>
                                    <div class="text-muted text-center">Already have an account? <a href="{{ route('user.login') }}">Sign in now</a></div>
                                </div>
                            </div>
                        </div>
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
    $(document).ready(function(){
    // add custom validation to required checkbox
    $('#validation').on('submit', function(event){
        // check if checkbox is checked
        if(!$('[name="term_conditions"]').is(':checked')){
            // show error message
            $('#chekcbox_error').show();
            // prevent form submission
            event.preventDefault();
        }
    });
});
</script>
<script  async>
    $('#phone_number').on('input', function (event) {
        this.value = this.value.replace(/[^0-9,+]/g, '');
    });
</script>
<script  async>
    jQuery.validator.addMethod("email", function(value, element) {
        if (/^([a-zA-Z0-9_\.\-])+\@(gmail\.com)$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid Email.");
    jQuery.validator.addMethod("password", function(value, element) {
        if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()+=-\?;,./{}|\":<>\[\]\\\' ~_]).{8,}/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Use at least 8 characters. Use a mix of letters (uppercase and lowercase), numbers, and symbols.");
</script>
<script  async>
    $('#validation').validate({
     rules: {
        first_name: {
        required: true,
      },
      last_name: {
        required: true,
      },
      email: {
        required: true,
        email : true
      },
      password: {
        required: true,
        password: true,
      },
      confirm_password: {
        required: true,
         equalTo: '#password',
      },
      phone_number: {
        minlength: 10,
        required: true,

      },
      term_conditions: {
        required: true,
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
