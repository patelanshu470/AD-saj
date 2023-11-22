@extends('backend.admin.admin_master')
@section('content')
    <style>
        @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
        @import url("https://fonts.googleapis.com/css?family=Raleway");

        .error {
            color: #ea5455;
        }

        .wrapper {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .box {
            display: block;
            min-width: 300px;
            height: 300px;
            /* margin: 10px; */
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
        }

        .upload-options {
            position: relative;
            height: 75px;
            background-color: rgb(18, 44, 242);
            cursor: pointer;
            overflow: hidden;
            text-align: center;
            transition: background-color ease-in-out 150ms;
        }

        .upload-options:hover {
            background-color: #4557b0;
        }

        .upload-options input {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload-options label {
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            font-weight: 400;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            overflow: hidden;
        }

        .upload-options label::after {
            content: "add";
            font-family: "Material Icons";
            position: absolute;
            font-size: 2.5rem;
            color: #e6e6e6;
            top: calc(50% - 2.5rem);
            left: calc(50% - 1.25rem);
            z-index: 0;
        }

        .upload-options label span {
            display: inline-block;
            width: 50%;
            height: 100%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            vertical-align: middle;
            text-align: center;
        }

        .upload-options label span:hover i.material-icons {
            color: lightgray;
        }

        .js--image-preview {
            height: 225px;
            width: 100%;
            position: relative;
            overflow: hidden;
            background-image: url("");
            background-color: white;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .js--no-default {
            background-size: contain;
        }

        .js--image-preview::after {
            content: "photo_size_select_actual";
            font-family: "Material Icons";
            position: relative;
            font-size: 4.5em;
            color: #e6e6e6;
            top: calc(50% - 3rem);
            left: calc(50% - 2.25rem);
            z-index: 0;
        }

        .js--image-preview.js--no-default::after {
            display: none;
        }

        /* multi img  */
        .img-div {
            position: relative;
            height: 200px;
            width: auto;
            float: left;
            margin-right: 5px;
            margin-left: 5px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .image {
            opacity: 1;
            display: block;
            height: 200px;
            width: 240px;
            object-fit: contain;
            /* width: 100%; */
            /* max-width: auto; */
            transition: 0.5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: 0.5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .img-div:hover .image {
            opacity: 0.3;
        }

        .img-div:hover .middle {
            opacity: 1;
        }

        #add_new_option_button:hover {
            color: #e6e6e6;
        }

        #new_data_row input[type="text"] {
            text-transform: lowercase;
        }

        video {
            border: 1px solid gainsboro;
            display: block;
            height: 250px;
        }

        .upload-options1 {
            position: relative;
            height: 75px;
            background-color: rgb(18, 44, 242);
            cursor: pointer;
            overflow: hidden;
            text-align: center;
            transition: background-color ease-in-out 150ms;
        }

        .upload-options1:hover {
            background-color: #4557b0;
        }

        .upload-options1 input {
            /* width: 0.1px;
                height: 0.1px; */
            opacity: 0;
            overflow: hidden;
            position: absolute;
            /* z-index: -1; */
        }

        .upload-options1 label {
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            font-weight: 400;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            overflow: hidden;
        }

        .upload-options1 label::after {
            content: "add";
            font-family: "Material Icons";
            position: absolute;
            font-size: 2.5rem;
            color: #e6e6e6;
            top: calc(50% - 2.5rem);
            left: calc(50% - 1.25rem);
            z-index: 0;
        }

        .upload-options1 label span {
            display: inline-block;
            width: 50%;
            height: 100%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            vertical-align: middle;
            text-align: center;
        }

        .upload-options1 label span:hover i.material-icons {
            color: lightgray;
        }
    </style>
    <div class="main-container" >
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="pd-20 card-box">
                            <h5 class="h4 text-blue mb-20">Banners</h5>
                            <div class="tab">
                                <div class="row clearfix">
                                    <div class="col-md-3 col-sm-12">
                                        <ul class="nav flex-column nav-pills vtabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"
                                                    aria-selected="true"><i class="fa fa-sliders"></i> Slider</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#mobileslider" role="tab"
                                                    aria-selected="true"><i class="fa fa-sliders"></i> Mobile Slider</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"
                                                    aria-selected="false"><i class="fa fa-percent"></i> Big Sale</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#contact7" role="tab"
                                                    aria-selected="false"><i class="fa fa-gift"></i> Special Offers</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#banner4" role="tab"
                                                    aria-selected="false"><i class="fa fa-medium"></i> Monthly sale</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#banner5" role="tab"
                                                    aria-selected="false"><i class="fa fa-instagram"></i> Insta Banner</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#shop" role="tab"
                                                    aria-selected="false"><i class="fa fa-shopping-bag"></i> Shop</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="home7" role="tabpanel">
                                                <div class="pd-20">
                                                    <div class="card-box">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="pd-20">
                                                                    <h4 class="text-blue h4">Sliders</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if (count($sliders) >0)
                                                        <form action="{{ route('sliderStore') }}" method="POST" id="sliderForm1" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 1</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                        style="background-image: url({{ asset('public/banner_images/slider/' . $sliders[0]->image) }});">
                                                                                    </div>

                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider1"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;">
                                                                                <input type="text" class="form-control" required value="{{ $sliders[0]->url }}" name="link1" id="" placeholder="Slider 1 Link">
                                                                                <input type="text" value="{{ $sliders[0]->id }}" name="slider1_id" hidden>
                                                                            </div>
                                                                            <span class="error"
                                                                                id="slider_image-1"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 2</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                    style="background-image: url({{ asset('public/banner_images/slider/' . $sliders[1]->image) }});">
                                                                                    </div>
                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider2"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;padding-right: 22px;">
                                                                                <input type="text" class="form-control" required value="{{ $sliders[1]->url }}" name="link2" id="" placeholder="Slider 2 Link">
                                                                                <input type="text" value="{{ $sliders[1]->id }}" name="slider2_id" hidden>
                                                                            </div>
                                                                            <span class="error"
                                                                                    id="slider_image-2"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12" style="align-content: center">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 3</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                        style="background-image: url({{ asset('public/banner_images/slider/' . $sliders[2]->image) }});">
                                                                                    </div>

                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider3"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;padding-right: 267px;padding-left: 278px;">
                                                                                <input type="text" class="form-control" name="link3" required id="" value="{{ $sliders[2]->url }}" placeholder="Slider 3 Link">
                                                                                <input type="text" value="{{ $sliders[2]->id }}" name="slider3_id" hidden>
                                                                                <span class="error"
                                                                                        id="slider_image-3"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class=""
                                                                            style="padding-bottom: 0;padding-left:45px;">
                                                                            <div class="form-group">
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('sliderStore') }}" method="POST" id="sliderForm" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 1</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview"
                                                                                        id="set_thumbnail"></div>

                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider1"
                                                                                                id="slider1"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;">
                                                                                <input type="text" class="form-control" name="link1" id="link1" placeholder="Slider 1 Link">
                                                                            </div>
                                                                            <span class="error"
                                                                                id="slider_image-1"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 2</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview"
                                                                                        id="set_thumbnail"></div>
                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider2"
                                                                                                id="slider2"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;padding-right: 22px;">
                                                                                <input type="text" class="form-control" name="link2" id="link2" placeholder="Slider 2 Link">
                                                                            </div>
                                                                            <span class="error"
                                                                                    id="slider_image-2"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12" style="align-content: center">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 3</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview"
                                                                                        id="set_thumbnail"></div>

                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider3"
                                                                                                id="slider3"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;padding-right: 267px;padding-left: 278px;">
                                                                                <input type="text" class="form-control" name="link3" id="link3" placeholder="Slider 3 Link">
                                                                                <span class="error"
                                                                                        id="slider_image-3"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class=""
                                                                            style="padding-bottom: 0;padding-left:45px;">
                                                                            <div class="form-group">
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade " id="mobileslider" role="tabpanel">
                                                <div class="pd-20">
                                                    <div class="card-box">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="pd-20">
                                                                    <h4 class="text-blue h4">Mobile Sliders</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if (count($mobile_sliders) >0)
                                                        <form action="{{ route('mobileSliderStore') }}" method="POST" id="mobilesliderForm1" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 1</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                        style="background-image: url({{ asset('public/banner_images/slider/' . $mobile_sliders[0]->image) }});">
                                                                                    </div>

                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider1"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;">
                                                                                <input type="text" class="form-control" required value="{{ $mobile_sliders[0]->url }}" name="link1" id="" placeholder="Slider 1 Link">
                                                                                <input type="text" value="{{ $mobile_sliders[0]->id }}" name="slider1_id" hidden>
                                                                            </div>
                                                                            <span class="error"
                                                                                id="slider_image-1"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 2</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                    style="background-image: url({{ asset('public/banner_images/slider/' . $mobile_sliders[1]->image) }});">
                                                                                    </div>
                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider2"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;padding-right: 22px;">
                                                                                <input type="text" class="form-control" required value="{{ $mobile_sliders[1]->url }}" name="link2" id="" placeholder="Slider 2 Link">
                                                                                <input type="text" value="{{ $mobile_sliders[1]->id }}" name="slider2_id" hidden>
                                                                            </div>
                                                                            <span class="error"
                                                                                    id="slider_image-2"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12" style="align-content: center">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 3</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                        style="background-image: url({{ asset('public/banner_images/slider/' . $mobile_sliders[2]->image) }});">
                                                                                    </div>

                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider3"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;padding-right: 267px;padding-left: 278px;">
                                                                                <input type="text" class="form-control" name="link3" required id="" value="{{ $mobile_sliders[2]->url }}" placeholder="Slider 3 Link">
                                                                                <input type="text" value="{{ $mobile_sliders[2]->id }}" name="slider3_id" hidden>
                                                                                <span class="error"
                                                                                        id="slider_image-3"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class=""
                                                                            style="padding-bottom: 0;padding-left:45px;">
                                                                            <div class="form-group">
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('mobileSliderStore') }}" method="POST" id="mobilesliderForm" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 1</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview"
                                                                                        id="set_thumbnail"></div>

                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider1"
                                                                                                id="mobile_slider1"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;">
                                                                                <input type="text" class="form-control" name="link1" id="mobile_link1" placeholder="Slider 1 Link">
                                                                            </div>
                                                                            <span class="error"
                                                                                id="mobile_slider_image-1"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 2</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview"
                                                                                        id="set_thumbnail"></div>
                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider2"
                                                                                                id="mobile_slider2"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;padding-right: 22px;">
                                                                                <input type="text" class="form-control" name="link2" id="mobile_link2" placeholder="Slider 2 Link">
                                                                            </div>
                                                                            <span class="error"
                                                                                    id="mobile_slider_image-2"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12" style="align-content: center">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Slider 3</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview"
                                                                                        id="set_thumbnail"></div>
                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="slider3"
                                                                                                id="mobile_slider3"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;padding-right: 267px;padding-left: 278px;">
                                                                                <input type="text" class="form-control" name="link3" id="mobile_link3" placeholder="Slider 3 Link">
                                                                                <span class="error"
                                                                                        id="mobile_slider_image-3"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class=""
                                                                            style="padding-bottom: 0;padding-left:45px;">
                                                                            <div class="form-group">
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="profile7" role="tabpanel">
                                                <div class="pd-20">
                                                    <div class="card-box">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="pd-20">
                                                                    <h4 class="text-blue h4">Banner 2</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if (isset($bigSell->id))
                                                            <form action="{{ route('bigsellStore') }}" method="POST" id="bigsellForm1" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Image</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                style="background-image: url({{ asset('public/banner_images/banner2/' . $bigSell->image) }});">
                                                                            </div>

                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="banner2"
                                                                                            id="banner2"
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div style="margin-top: 10px;padding-right: 35px;">
                                                                        <input type="text" class="form-control" required name="banner_link" value="{{ $bigSell->url }}" id="banner_link" placeholder="Link">
                                                                        <input type="text" value="{{ $bigSell->id }}" name="bigsell_id" hidden>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <span class="error"
                                                                    id="banner_link-1"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left:45px;">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('bigsellStore') }}" method="POST" id="bigsellForm" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Image</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview"
                                                                                    id="set_thumbnail"></div>

                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="banner2"
                                                                                            id="banner2"
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div style="margin-top: 10px;padding-right: 35px;">
                                                                        <input type="text" class="form-control" required name="banner_link" id="banner_link" placeholder="Link">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <span class="error"
                                                                    id="banner_link-1"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left:45px;">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="contact7" role="tabpanel">
                                                <div class="pd-20">
                                                    <div class="card-box mb-30">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="pd-20">
                                                                    <h4 class="text-blue h4">Banner 3</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if (count($special_offer)> 0)
                                                        <form action="{{ route('specialOfferStore') }}" method="POST"
                                                        id="specialOfferForm1" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Banner 1</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                        style="background-image: url({{ asset('public/banner_images/banner3/' . $special_offer[0]->image) }});">
                                                                                    </div>

                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="special_offer1"
                                                                                            id="special_offer1"
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin-top: 10px;">
                                                                            <input type="text" class="form-control" value="{{ $special_offer[0]->url }}" required name="special_link1" id="special_link1" placeholder="Banner 1 Link">
                                                                            <input type="text" value="{{ $special_offer[0]->id }}" name="specialoffer1_id" hidden>

                                                                        </div>
                                                                        <span class="error"
                                                                            id="special_link-1"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Banner 2</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                        style="background-image: url({{ asset('public/banner_images/banner3/' . $special_offer[1]->image) }});">
                                                                                    </div>
                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="special_offer2"
                                                                                            id="special_offer2"
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin-top: 10px;padding-right: 22px;">
                                                                            <input type="text" class="form-control" value="{{ $special_offer[1]->url }}"  required name="special_link2" id="special_link2" placeholder="Banner 2 Link">
                                                                            <input type="text" value="{{ $special_offer[1]->id }}" name="specialoffer2_id" hidden>

                                                                        </div>
                                                                        <span class="error"
                                                                                id="special_link-2"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12" style="align-content: center">
                                                                <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Banner 3</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                        style="background-image: url({{ asset('public/banner_images/banner3/' . $special_offer[2]->image) }});">
                                                                                    </div>

                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="special_offer3"
                                                                                            id="special_offer3"
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin-top: 10px;padding-right: 267px;padding-left: 278px;">
                                                                            <input type="text" class="form-control" value="{{ $special_offer[2]->url }}"  required name="special_link3" id="special_link3" placeholder="Banner 3 Link">
                                                                            <input type="text" value="{{ $special_offer[2]->id }}" name="specialoffer3_id" hidden>

                                                                            <span class="error"
                                                                                    id="special_link-3"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class=""
                                                                    style="padding-bottom: 0;padding-left:45px;">
                                                                    <div class="form-group">
                                                                        <button type="submit"
                                                                            class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                        @else
                                                        <form action="{{ route('specialOfferStore') }}" method="POST"
                                                            id="specialOfferForm" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Banner 1</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview"
                                                                                        id="set_thumbnail"></div>

                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="special_offer1"
                                                                                                id="special_offer1"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;">
                                                                                <input type="text" class="form-control" required name="special_link1" id="special_link1" placeholder="Banner 1 Link">
                                                                            </div>
                                                                            <span class="error"
                                                                                id="special_link-1"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Banner 2</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview"
                                                                                        id="set_thumbnail"></div>
                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="special_offer2"
                                                                                                id="special_offer2"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;padding-right: 22px;">
                                                                                <input type="text" class="form-control" required name="special_link2" id="special_link2" placeholder="Banner 2 Link">
                                                                            </div>
                                                                            <span class="error"
                                                                                    id="special_link-2"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12" style="align-content: center">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left: 20px;">
                                                                        <div class="form-group">
                                                                            <div class="wrapper " style="display:grid;">
                                                                                <label for="">Banner 3</label>
                                                                                <div class="box">
                                                                                    <div class="js--image-preview"
                                                                                        id="set_thumbnail"></div>

                                                                                    <div class="upload-options">
                                                                                        <label>
                                                                                            <input type="file"
                                                                                                class="image-upload"
                                                                                                name="special_offer3"
                                                                                                id="special_offer3"
                                                                                                accept="image/png,image/jpeg" />
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin-top: 10px;padding-right: 267px;padding-left: 278px;">
                                                                                <input type="text" class="form-control" required name="special_link3" id="special_link3" placeholder="Banner 3 Link">
                                                                                <span class="error"
                                                                                        id="special_link-3"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left:45px;">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="banner4" role="tabpanel">
                                                <div class="pd-20">
                                                    <div class="card-box">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="pd-20">
                                                                    <h4 class="text-blue h4">Banner 4</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <style>
                                                            /* .js--image-preview::after{
                                                                content: "photo_size_select_actual";
                                                                font-family: "Material Icons";
                                                                position: relative;
                                                                font-size: 4.5em;
                                                                color: #e6e6e6;
                                                                top: calc(50% - 3rem);
                                                                left: calc(50% - 2.25rem);
                                                                z-index: 0;
                                                                display: block;
                                                            } */
                                                        </style>
                                                        @if (isset($monthly_sell->id))
                                                            <form action="{{ route('monthlysellStore') }}" method="POST" id="monthlysellForm1" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Image</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                style="background-image: url({{ asset('public/banner_images/banner4/' . $monthly_sell->image) }});">
                                                                            </div>

                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="banner4"
                                                                                            id="banner4"
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div style="margin-top: 10px;padding-right: 35px;">
                                                                        <input type="text" class="form-control" required name="banner_link4" value="{{ $monthly_sell->url }}" id="banner_link4" placeholder="Link">
                                                                        <input type="text" value="{{ $monthly_sell->id }}" name="monthlysell_id" hidden>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <span class="error"
                                                                    id="banner_link4-1"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left:45px;">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('monthlysellStore') }}" method="POST" id="monthlysellForm" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Image</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview"
                                                                                    id="set_thumbnail"></div>

                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="banner4"
                                                                                            id="banner4"
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div style="margin-top: 10px;padding-right: 35px;">
                                                                        <input type="text" class="form-control" required name="banner_link4" id="banner_link4" placeholder="Link">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <span class="error"
                                                                    id="banner_link4-1"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left:45px;">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="banner5" role="tabpanel">
                                                <div class="pd-20">
                                                    <div class="card-box">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="pd-20">
                                                                    <h4 class="text-blue h4">Banner 4</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <style>
                                                            /* .js--image-preview::after{
                                                                content: "photo_size_select_actual";
                                                                font-family: "Material Icons";
                                                                position: relative;
                                                                font-size: 4.5em;
                                                                color: #e6e6e6;
                                                                top: calc(50% - 3rem);
                                                                left: calc(50% - 2.25rem);
                                                                z-index: 0;
                                                                display: block;
                                                            } */
                                                        </style>
                                                        @if (isset($instabanner->id))
                                                            <form action="{{ route('instabannerStore') }}" method="POST" id="instabannerForm1" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Image</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                style="background-image: url({{ asset('public/banner_images/banner5/' . $instabanner->image) }});">
                                                                            </div>

                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="banner5"
                                                                                            id="banner5"
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div style="margin-top: 10px;padding-right: 35px;">
                                                                        <input type="text" class="form-control" required name="banner_link5" value="{{ $instabanner->url }}" id="banner_link5" placeholder="Link">
                                                                        <input type="text" value="{{ $instabanner->id }}" name="instavisit_id" hidden>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <span class="error"
                                                                    id="banner_link5-1"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left:45px;">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('instabannerStore') }}" method="POST" id="instabannerForm" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Image</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview"
                                                                                    id="set_thumbnail"></div>

                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="banner5"
                                                                                            id="banner5"
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div style="margin-top: 10px;padding-right: 35px;">
                                                                        <input type="text" class="form-control" required name="banner_link5" id="banner_link5" placeholder="Link">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <span class="error"
                                                                    id="banner_link5-1"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left:45px;">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="shop" role="tabpanel">
                                                <div class="pd-20">
                                                    <div class="card-box">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="pd-20">
                                                                    <h4 class="text-blue h4">Shop</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <style>
                                                            /* .js--image-preview::after{
                                                                content: "photo_size_select_actual";
                                                                font-family: "Material Icons";
                                                                position: relative;
                                                                font-size: 4.5em;
                                                                color: #e6e6e6;
                                                                top: calc(50% - 3rem);
                                                                left: calc(50% - 2.25rem);
                                                                z-index: 0;
                                                                display: block;
                                                            } */
                                                        </style>
                                                        @if (isset($shopbanner->id))
                                                            <form action="{{ route('shopbannerStore') }}" method="POST" id="shopbannerForm1" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Image</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview js--no-default js--no-default" id="set_thumbnail"
                                                                                style="background-image: url({{ asset('public/banner_images/shop/' . $shopbanner->image) }});">
                                                                            </div>

                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="shop_image"
                                                                                            id="shop_image"
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div style="margin-top: 10px;padding-right: 35px;">
                                                                        <input type="text" class="form-control" required name="shop_link" value="{{ $shopbanner->url }}" id="banner_link5" placeholder="Link">
                                                                        <input type="text" value="{{ $shopbanner->id }}" name="shopedit_id" hidden>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <span class="error"
                                                                    id="shop_link-1"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left:45px;">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('shopbannerStore') }}" method="POST" id="shopbannerForm" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                    style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <div class="wrapper " style="display:grid;">
                                                                            <label for="">Image</label>
                                                                            <div class="box">
                                                                                <div class="js--image-preview"
                                                                                    id="set_thumbnail"></div>

                                                                                <div class="upload-options">
                                                                                    <label>
                                                                                        <input type="file"
                                                                                            class="image-upload"
                                                                                            name="shop_image"
                                                                                            id="shop_image"
                                                                                            required
                                                                                            accept="image/png,image/jpeg" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div style="margin-top: 10px;padding-right: 35px;">
                                                                        <input type="text" class="form-control" required name="shop_link" id="shop_link" placeholder="Link">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <span class="error"
                                                                    id="shop_link-1"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class=""
                                                                        style="padding-bottom: 0;padding-left:45px;">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/layout-settings.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('public/validation/banner/slider/slider.js') }}"></script>
    <script src="{{ asset('public/validation/banner/banner2/banner.js') }}"></script>
    <script src="{{ asset('public/validation/banner/banner3/banner.js') }}"></script>
@endsection
