@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
<style>
    #default_address_id {
            margin-top: 5px;
            margin-left: 10px;
            height: 20px;
            width: 20px;
            position: absolute;
            background-color: #fff4e7;
            border-radius: 50%;
        }

        .order-list-main .default-address-header {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .default-address-header {
            font-size: 16px;
        }

        .default-address-header {
            background-color: #cd4040;
            color: #fff;
            font-size: 14px;
            font-weight: 400;
        }

        .order-sublist button {
            border: 1px solid #cd4040;
            border-radius: 8px;
            width: 100%;
            background-color: #ffffff;
            padding: 3px;
            font-size: 13px;
            margin: 5px;
        }

        img {
            max-width: 100%;
            height: auto
        }

        .order-list .d-flex {
            justify-content: space-between;
            margin: 10px;
        }

        .login-form-wrap {
            padding: 30px;
            background-color: #f9f9f9;
            margin-bottom: 25px
        }

        .order-detail-head .side-line {
            border-right: 1px solid #666;
        }

        ul.timeline {
            list-style-type: none;
            position: relative;
            text-align: center;
            justify-content: space-around;
        }

        ul.timeline:before {
            content: " ";
            background: #cd4040;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 90%;
            height: 2px;
            z-index: 400;
        }

        ul.timeline>li {
            margin: 20px 0;
        }

        ul.timeline>li:before {
            content: "";
            background: #fff;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            left: 36%;
            top: -10%;
            width: 25px;
            height: 25px;
            z-index: 400;
            border: 1px solid #cd4040;
        }

        ul.timeline>li.order:before {
            left: 10%;
        }

        ul.timeline>li.shiping:before {
            left: 33%;
        }

        ul.timeline>li.out-delivery:before {
            left: 60%;
        }

        ul.timeline>li.delivery:before {
            left: 86%;
        }

        ul.timeline>li.active:before {
            content: "";
            background: #cd4040;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 0;
            left: 10%;
            width: 25px;
            height: 25px;
            z-index: 400;
            border: 1px solid #cd4040;
        }

        ul.timeline>li.order.active:before {
            left: 10%;
        }

        ul.timeline>li.shiping.active:before {
            left: 33%;
        }

        ul.timeline>li.out-delivery.active:before {
            left: 60%;
        }

        ul.timeline>li.delivery.active:before {
            left: 86%;
        }

/* review css */

h1 {
  font-family: 'Fjalla One', sans-serif;
  margin-bottom: 0.15rem;
}

h2 {
  font-family: 'Cutive Mono', 'Courier New';
  font-size: 1rem;
  letter-spacing: 1px;
  margin-bottom: 4rem;
}

label {
  cursor: pointer;
}

svg {
  width: 3rem;
  height: 3rem;
  padding: 0.15rem;
}


/* hide radio buttons */

input[name="star"] {
  display: inline-block;
  width: 0;
  opacity: 0;
  margin-left: -2px;
}

/* hide source svg */

.star-source {
  width: 0;
  height: 0;
  visibility: hidden;
}


/* set initial color to transparent so fill is empty*/

.star {
  color: transparent;
  transition: color 0.2s ease-in-out;
}


/* set direction to row-reverse so 5th star is at the end and ~ can be used to fill all sibling stars that precede last starred element*/

.star-container {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
}

label:hover ~ label .star,
svg.star:hover,
input[name="star"]:focus ~ label .star,
input[name="star"]:checked ~ label .star {
  color: #ffa500;
}

input[name="star"]:checked + label .star {
  animation: starred 0.5s;
}

input[name="star"]:checked + label {
  animation: scaleup 1s;
}

@keyframes scaleup {
  from {
    transform: scale(1.2);
  }
  to {
    transform: scale(1);
  }
}

@keyframes starred {
  from {
    color: #cfb002;
  }
  to {
    color: #ffa500;
  }
}
.error {
    color: #ea5455;
}
</style>
<style>
    #img-preview {
  display: none;
  width: 155px;
  border: 2px dashed #333;
  margin-bottom: 20px;
}
#img-preview img {
  width: 100%;
  height: auto;
  display: block;
}
[type="file"] {
  height: 0;
  width: 0;
  overflow: hidden;
}
[type="file"] + label {
  font-family: sans-serif;
  background: #f44336;
  padding: 10px 30px;
  border: 2px solid #f44336;
  border-radius: 3px;
  color: #fff;
  cursor: pointer;
  transition: all 0.2s;
}
[type="file"] + label:hover {
  background-color: #fff;
  color: #b13c44;
}

/* -------------------------------------*/
/* body {padding: 15px;} */
/* p { bottom:0; font-family: monospace; font-weight: bold; font-size:12px;}
p a {color:#000;} */

.form-group input[type=file] {
  background: transparent;
  border: 0px ;
  height: 45px;
  -webkit-box-shadow: none;
  box-shadow: none;
  padding-left: 0px;
  font-size: 0px;
  color: #1a1a1a;
  width: 0%;
}
</style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span>My Account
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-4 pb-10">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link " id="dashboard-tab" href="{{ route('user.profile') }}"><i
                                                    class="fi-rs-user mr-10"></i>Account Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                                role="tab" aria-controls="orders" aria-selected="false"><i
                                                    class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><i
                                                    class="fi-rs-sign-out mr-10"></i>Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane fade active show" id="orders" role="tabpanel"
                                        aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Product Review</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" name="ProductReview" id="ProductReview" action="{{ route('storeReview') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Rating <span class="required">*</span></label>
                                                            <div class="star-source">
                                                              <svg>
                                                                    <linearGradient x1="50%" y1="5.41294643%" x2="87.5527344%" y2="65.4921875%" id="grad">
                                                                        <stop stop-color="#ffa500" offset="0%"></stop>
                                                                        <stop stop-color="#ffa500" offset="60%"></stop>
                                                                        <stop stop-color="#ffa500" offset="100%"></stop>
                                                                    </linearGradient>
                                                                <symbol id="star" viewBox="153 89 106 108">
                                                                  <polygon id="star-shape" stroke="url(#grad)" stroke-width="5" fill="currentColor" points="206 162.5 176.610737 185.45085 189.356511 150.407797 158.447174 129.54915 195.713758 130.842203 206 95 216.286242 130.842203 253.552826 129.54915 222.643489 150.407797 235.389263 185.45085"></polygon>
                                                                </symbol>
                                                            </svg>

                                                            </div>
                                                            <div class="star-container">
                                                              <input type="radio" name="star" id="five" value="5">
                                                              <label for="five">
                                                                <svg class="star">
                                                                  <use xlink:href="#star"/>
                                                                </svg>
                                                              </label>
                                                              <input type="radio" name="star" id="four" value="4">
                                                              <label for="four">
                                                                <svg class="star">
                                                                  <use xlink:href="#star"/>
                                                                </svg>
                                                              </label>
                                                              <input type="radio" name="star" id="three" value="3">
                                                              <label for="three">
                                                                <svg class="star">
                                                                  <use xlink:href="#star"/>
                                                                </svg>
                                                              </label>
                                                              <input type="radio" name="star" id="two" value="2">
                                                              <label for="two">
                                                                <svg class="star">
                                                                  <use xlink:href="#star" />
                                                                </svg>
                                                              </label>
                                                              <input type="radio" name="star" id="one" value="1">
                                                              <label for="one">
                                                              <svg class="star">
                                                                <use xlink:href="#star" />
                                                              </svg>
                                                              </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label style="width: 100%;">Image</label>
                                                            <div id="img-preview"></div>
                                                            <input type="file" id="choose-file" name="choose_file" accept="image/*" />
                                                            <label for="choose-file">Choose File</label>
                                                          </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Description <span class="required">*</span></label>
                                                            <textarea name="description" id="" cols="20" rows="10" class=""></textarea>
                                                        </div>
                                                        <input type="text" value="{{ $product->id }}" name="product_id" hidden>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                                name="submit" value="Submit">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
<script src="{{ asset('public/frontend/validation/profile.js') }}"></script>
<script  async>
    const chooseFile = document.getElementById("choose-file");
const imgPreview = document.getElementById("img-preview");
chooseFile.addEventListener("change", function () {
  getImgData();
});
function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });
  }
}
</script>
<script  async>
    $(document).ready(function() {
    $('input[type="file"]').change(function(e) {
        var file = e.target.files[0];
        var fileName = file.name;
        var fileType = fileName.split('.').pop().toLowerCase();
        var allowedTypes = ['jpeg', 'jpg', 'png'];
        var maxSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($.inArray(fileType, allowedTypes) === -1) {
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $(this).val('');
            // $('.js--image-preview.js--no-default').removeAttr('style');
        } else if (file.size > maxSize) {
            alert('Please select an image file smaller than 10MB.');
            $(this).val('');
            setTimeout( function(){
                $('#img-preview').css('display','none');
            },2000);
        }
    });
});
</script>
@endsection
