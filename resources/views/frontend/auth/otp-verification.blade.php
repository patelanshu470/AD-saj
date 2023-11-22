@extends('frontend.layouts.fullLayoutMaster')

@section('content')
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
        }

        .title {
            max-width: 400px;
            margin: auto;
            text-align: center;
            font-family: "Poppins", sans-serif;

            h3 {
                font-weight: bold;
            }

            p {
                font-size: 12px;
                color: #f7dcc8;

                &.msg {}

                color: initial;
                text-align: initial;
                font-weight: bold;
            }
        }

        .otp-input-fields {
            margin: auto;
            /* background-color: white; */
            /* box-shadow: 0px 0px 8px 0px #02025044; */
            max-width: 400px;
            width: auto;
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 40px;
            background: transparent;
            padding-top: 20px;
            padding-bottom: 0;
        }

        input {
            height: 40px;
            width: 40px;
            background-color: transparent;
            border-radius: 4px;
            border: 1px solid #f7dcc8;
            text-align: center;
            outline: none;
            font-size: 16px;

            &::-webkit-outer-spin-button,
            &::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            &[type=number] {
                -moz-appearance: textfield;
            }

            &:focus {
                border-width: 2px;
                border-color: darken(#f7dcc8, 10%);
                font-size: 20px;
            }

        }

        input:focus {
            border: 2px solid #f7b787;
        }

        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .result {
            max-width: 400px;
            margin: auto;
            padding: 24px;
            text-align: center;

            p {
                font-size: 24px;
                font-family: 'Antonio', sans-serif;
                opacity: 1;
                transition: color 0.5s ease;

                &._ok {
                    color: #f7dcc8;
                }

                &._notok {
                    color: red;
                    border-radius: 3px;
                }
            }
        }

        #otp {
            padding-left: 2px;
            padding-right: 2px;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #751d1c;
            border-color: #751d1c;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span> Pages
                    <span></span> OTP Login
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
                                <div
                                    class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        @php
                                            $aa = App\Models\VerificationCode::latest()->first();
                                            $timee = $aa->expire_at;
                                            $create = $aa->created_at;
                                            $forma = date('M d Y H:i:s', strtotime($timee));
                                            $create_at = date('M d Y H:i:s', strtotime($create));
                                            $mobile = App\Models\User::where([['id', '=', $user_id]])->first();
                                            $para_no = $mobile->id;
                                            $value = $mobile->id;
                                        @endphp
                                        <div class="heading_s1">
                                            <h3 class="mb-30">OTP Login</h3>
                                        </div>
                                        <p class="mb-20 font-sm">
                                            A 6-digit OTP has been sent to your Email. OTP will expire in 10 mins.
                                        <form method="POST" action="{{ route('otp.getlogin') }}" class="otp-form"
                                            name="otp-form" id="validation">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-0">
                                                        <input type="hidden" name="user_id" value="{{ $user_id }}" />
                                                        <div class="otp-input-fields justify-content-center">
                                                            <input type="number" name="otps"
                                                                class="otp__digit otp__field__1" id="otp">
                                                            <input type="number" name="otps"
                                                                class="otp__digit otp__field__2" id="otp">
                                                            <input type="number" name="otps"
                                                                class="otp__digit otp__field__3" id="otp">
                                                            <input type="number" name="otps"
                                                                class="otp__digit otp__field__4" id="otp">
                                                            <input type="number" name="otps"
                                                                class="otp__digit otp__field__5" id="otp">
                                                            <input type="number" name="otps"
                                                                class="otp__digit otp__field__6" id="otp">
                                                            @error('otp')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        @error('phone_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="result">
                                                            <textarea name="otp" hidden id="_otp" class="_notok  @error('otp') is-invalid @enderror" cols="10"
                                                                rows="02"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 d-flex justify-content-between">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                            <div class="d-flex justify-content-center mt-3">
                                                <span id="resend_otp_in">Resend OTP In &nbsp;</span>
                                                <p id="demo" class="d-flex justify-content-center"></p>
                                            </div>
                                            <p class="mt-3 text-center" style="display: none;" id="display_block_id">
                                                Didn't recieve an OTP?<a class=""
                                                    href="{{ route('otp.resend', $para_no) }}"
                                                    style="pointer-events: none; margin-left:5px;" id="resend">Resend
                                                    OTP</a>
                                            </p>
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

    <script async>
        var countDownDate = new Date('{{ $forma }}').getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get today's date and time
            var now = new Date();
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
            if (distance < 0) {
                element = document.getElementById('resend');
                element.style = "";

                clearInterval(x);
                document.getElementById("demo").innerHTML = ' ';
                document.getElementById("resend_otp_in").style.display = "none";
                document.getElementById("display_block_id").style.display = "block";
            }
        }, 1000);
    </script>


    <script async>
        var otp_inputs = document.querySelectorAll(".otp__digit")
        var mykey = "0123456789".split("")
        otp_inputs.forEach((_) => {
            _.addEventListener("keyup", handle_next_input)
        })

        function handle_next_input(event) {
            let current = event.target
            let index = parseInt(current.classList[1].split("__")[2])
            current.value = event.key

            if (event.keyCode == 8 && index > 1) {
                current.previousElementSibling.focus()
            }
            if (index < 6 && mykey.indexOf("" + event.key + "") != -1) {
                var next = current.nextElementSibling;
                next.focus()
            }
            var _finalKey = ""
            for (let {
                    value
                }
                of otp_inputs) {
                _finalKey += value
            }
            if (_finalKey.length == 6) {
                document.querySelector("#_otp").classList.replace("_notok", "_ok")
                document.querySelector("#_otp").innerText = _finalKey
            } else {
                document.querySelector("#_otp").classList.replace("_ok", "_notok")
                document.querySelector("#_otp").innerText = _finalKey
            }
        }
    </script>
@endsection
