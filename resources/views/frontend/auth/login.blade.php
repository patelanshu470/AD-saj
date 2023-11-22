@extends('frontend.layouts.fullLayoutMaster')

@section('content')
<style>
.password-wrapper {
  position: relative;
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
                    <div class="row" style="display: flex;
                    justify-content: center;">
                        <div class="col-lg-5">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Sign in/ Sign up</h3>
                                    </div>
                                    @if ($countryPrice == "IN")
                                        <form method="POST" action="{{ route('check.user.mobile') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" value="{{ old('phone_number') }}" class="@error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Your Phone Number" id="phone_number">
                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login" style="width: 100%;">Continue</button>
                                            </div>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('check.user') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" name="email" placeholder="Your Email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login" style="width: 100%;">Continue</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('#phone_number').on('input', function (event) {
            this.value = this.value.replace(/[^0-9,+]/g, '');
    });
</script>
@endsection
