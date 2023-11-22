@extends('backend.admin.admin_master')
@section('content')
<style>
.error{
  color: #ea5455;
}
.password-wrapper {
  position: relative;
}
.show-password {
  position: absolute;
  top: 18%;
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
#old_password {
  width: 100%;
  padding-right: 40px;
}
#new_password {
  width: 100%;
  padding-right: 40px;
}
#confirm_password {
  width: 100%;
  padding-right: 40px;
}
</style>
<div class="main-container" style="height: 90%">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                    <div class="pd-20 card-box">
                        <h5 class="h4 text-blue mb-20">Settings</h5>
                        <div class="tab">
                            <div class="row clearfix">
                                <div class="col-md-3 col-sm-12">
                                    <ul class="nav flex-column nav-pills vtabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home7" role="tab" aria-selected="true"><i class="fa fa-home"></i> Detail</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile7" role="tab" aria-selected="false"><i class="fa fa-users"> Social Link</i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#contact7" role="tab" aria-selected="false"><i class="icon-copy ion-locked"></i> Password Change</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-9 col-sm-12">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="home7" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="card">
                                                    <div class="card-header" style="display: flex;justify-content: space-between">
                                                        <div>
                                                            Detail
                                                        </div>
                                                        @if ($edit_detail == null)
                                                        <div>
                                                            <a class="nav-link" data-toggle="tab" href="#createaddress" role="tab" aria-selected="false"><i class="icon-copy fa fa-plus-circle" aria-hidden="true"></i> Add</a>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="card-body">
                                                        @if ($edit_detail != null)
                                                        <div class="table-responsive">
                                                            <table class="table wrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Street</th>
                                                                        <th>Landmark</th>
                                                                        <th>Area</th>
                                                                        <th>Pincode</th>
                                                                        <th>City</th>
                                                                        <th>State</th>
                                                                        <th>Country</th>
                                                                        <th>Phone Number</th>
                                                                        <th>Email</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $edit_detail->street }}</td>
                                                                        <td>{{ $edit_detail->landmark }}</td>
                                                                        <td>{{ $edit_detail->area }}</td>
                                                                        <td>{{ $edit_detail->pincode }}</td>
                                                                        <td>{{ $edit_detail->city }}</td>
                                                                        <td>{{ $edit_detail->state }}</td>
                                                                        <td>{{ $edit_detail->country }}</td>
                                                                        <td>{{ $edit_detail->phone_number }}</td>
                                                                        <td>{{ $edit_detail->email }}</td>
                                                                        <td><a class="nav-link" data-toggle="tab" href="#editaddress" role="tab" aria-selected="false"><i class="icon-copy fa fa-edit" aria-hidden="true"></i> Edit</a></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        @else
                                                        <div class="alert alert-danger" role="alert">
                                                            No Detail Added Yet.
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile7" role="tabpanel">
                                            <div class="pd-20">
                                                @if ($edit_detail != null)
                                                <div class="card-box mb-30">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="pd-20">
                                                                <h4 class="text-blue h4">Social Link</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('adminSocialCreate') }}" method="POST" id="adminLinkCreate">
                                                        @csrf
                                                        <div class="row">
                                                            @if ($edit_detail->facebook_url == null)
                                                            <div class="col-6">
                                                                <div class="" style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <label>Facebook</label>
                                                                        <input class="form-control" type="text" name="facebook" placeholder="Facebook">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="col-6">
                                                                <div class="" style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <label>Facebook</label>
                                                                        <input class="form-control" type="text" value="{{ $edit_detail->facebook_url }}" name="facebook" placeholder="Facebook">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if ($edit_detail->instagram_url == null)
                                                            <div class="col-6">
                                                                <div class="" style="padding-bottom: 0;padding-right: 20px;">
                                                                    <div class="form-group">
                                                                        <label>Instagram</label>
                                                                        <input class="form-control" type="text" name="instagram" placeholder="Instagram">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="col-6">
                                                                <div class="" style="padding-bottom: 0;padding-right: 20px;">
                                                                    <div class="form-group">
                                                                        <label>Instagram</label>
                                                                        <input class="form-control" type="text" value="{{ $edit_detail->instagram_url }}" name="instagram" placeholder="Instagram">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="row">
                                                            @if ($edit_detail->twitter_url == null)
                                                            <div class="col-6">
                                                                <div class="" style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <label>Twitter</label>
                                                                        <input class="form-control" type="text" name="twitter" placeholder="Twitter">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="col-6">
                                                                <div class="" style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <label>Twitter</label>
                                                                        <input class="form-control" value="{{ $edit_detail->twitter_url }}" type="text" name="twitter" placeholder="Twitter">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="col-6">
                                                                @if ($edit_detail->linkedin_url == null)
                                                                <div class="" style="padding-bottom: 0;padding-right: 20px;">
                                                                    <div class="form-group">
                                                                        <label>Linkedin</label>
                                                                        <input class="form-control" type="text" name="linkedin" placeholder="Linkedin">
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="" style="padding-bottom: 0;padding-right: 20px;">
                                                                    <div class="form-group">
                                                                        <label>Linkedin</label>
                                                                        <input class="form-control" value="{{ $edit_detail->linkedin_url }}" type="text" name="linkedin" placeholder="Linkedin">
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                @if ($edit_detail->youtube_url == null)
                                                                <div class="" style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <label>Youtube</label>
                                                                        <input class="form-control" type="text" name="youtube" placeholder="Youtube">
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="" style="padding-bottom: 0;padding-left: 20px;">
                                                                    <div class="form-group">
                                                                        <label>Youtube</label>
                                                                        <input class="form-control" value="{{ $edit_detail->youtube_url }}" type="text" name="youtube" placeholder="Youtube">
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="" style="padding-bottom: 0;padding-left:20px;">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                @else
                                                <div class="card">
                                                    <div class="card-header">
                                                        Social links
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="alert alert-danger" role="alert">
                                                            First Fill Detail Data.
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact7" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="card-box mb-30">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="pd-20">
                                                                <h4 class="text-blue h4">Password Change</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('adminChangePassword') }}" method="POST" id="ChangePassword">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="" style="padding-bottom: 0;padding-left:20px;">
                                                                <div class="form-group">
                                                                    <label>Old Password</label>
                                                                    <div class="password-wrapper">
                                                                        <button type="button" class="show-password" id="show-password" aria-label="Show password">
                                                                            <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                                                        </button>
                                                                        <input class="form-control" type="password" name="old_password" id="old_password" placeholder="Old Password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="" style="padding-bottom: 0">
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <div class="password-wrapper">
                                                                        <input class="form-control" type="password" name="new_password" id="new_password" placeholder="New Password">
                                                                        <button type="button" class="show-password" id="show-newpassword" aria-label="Show password">
                                                                            <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="" style="padding-bottom: 0;padding-right: 20px">
                                                                <div class="form-group">
                                                                    <label>Confirm Password</label>
                                                                    <div class="password-wrapper">
                                                                    <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                                                    <button type="button" class="show-password" id="show-confirmpassword" aria-label="Show password">
                                                                        <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="" style="padding-bottom: 0;padding-left:20px;">
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="createaddress" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="card-box mb-30">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="pd-20">
                                                                <h4 class="text-blue h4">Edit Address</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('adminDetailCreate') }}" method="POST" id="adminAddressCreate">
                                                        @csrf
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0">
                                                                <div class="form-group">
                                                                    <label>Street</label>
                                                                    <input class="form-control" type="text" name="street" placeholder="Street">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0">
                                                                <div class="form-group">
                                                                    <label>Landmark</label>
                                                                    <input class="form-control" type="text" name="landmark" placeholder="Landmark">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0">
                                                                <div class="form-group">
                                                                    <label>Area</label>
                                                                    <input class="form-control" type="text" name="area" placeholder="Area">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>Pincode</label>
                                                                    <input class="form-control" type="text" name="pincode" placeholder="Pincode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>City</label>
                                                                    <input class="form-control" type="text" name="city" placeholder="City">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <select class="selectpicker form-control" name="state" data-style="btn-outline-primary"
                                                                        data-size="5">
                                                                        <option value="gujrat">Gujrat</option>
                                                                        <option value="maharashtra">Maharashtra</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <select class="selectpicker form-control" name="country" data-style="btn-outline-primary"
                                                                        data-size="5">
                                                                        <option value="india">India</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>Mobile No.</label>
                                                                    <input class="form-control" type="number" name="mobile" placeholder="Mobile Number">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($edit_detail != null)
                                        <div class="tab-pane fade" id="editaddress" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="card-box mb-30">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="pd-20">
                                                                <h4 class="text-blue h4">Edit Detail</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('adminDetailEdit') }}" method="POST" id="adminAddressEdit">
                                                        @csrf
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0">
                                                                <div class="form-group">
                                                                    <label>Street</label>
                                                                    <input class="form-control" type="text" value="{{ $edit_detail->street }}" name="street" placeholder="Street">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0">
                                                                <div class="form-group">
                                                                    <label>Landmark</label>
                                                                    <input class="form-control" type="text" value="{{ $edit_detail->landmark }}" name="landmark" placeholder="Landmark">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0">
                                                                <div class="form-group">
                                                                    <label>Area</label>
                                                                    <input class="form-control" type="text" value="{{ $edit_detail->area }}" name="area" placeholder="Area">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>Pincode</label>
                                                                    <input class="form-control" type="text" value="{{ $edit_detail->pincode }}" name="pincode" placeholder="Pincode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>City</label>
                                                                    <input class="form-control" type="text" value="{{ $edit_detail->city }}" name="city" placeholder="City">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <select class="selectpicker form-control" name="state" data-style="btn-outline-primary"
                                                                        data-size="5">
                                                                        <option value="gujrat" @if ($edit_detail->state == 'gujrat') {{ "selected" }} @endif>Gujrat</option>
                                                                        <option value="maharashtra" @if ($edit_detail->state == 'maharashtra') {{ "selected" }} @endif>Maharashtra</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <select class="selectpicker form-control" name="country" data-style="btn-outline-primary"
                                                                        data-size="5">
                                                                        <option value="india">India</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>Mobile No.</label>
                                                                    <input class="form-control" type="number" value="{{ $edit_detail->phone_number }}" name="mobile" placeholder="Mobile Number">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input type="email" class="form-control" name="email" value="{{ $edit_detail->email }}" placeholder="Email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="pd-20" style="padding-bottom: 0;padding-top:0;">
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
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
<script src="{{ asset('public/vendors/scripts/core.js') }}"></script>
<script src="{{ asset('public/vendors/scripts/script.min.js') }}"></script>
<script src="{{ asset('public/vendors/scripts/process.js') }}"></script>
<script src="{{ asset('public/vendors/scripts/layout-settings.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script  async>
    $('#adminAddressCreate').validate({
        rules: {
            street: {
                required: true,
            },
            landmark: {
                required: true,
            },
            area: {
                required: true,
            },
            pincode: {
                required: true,
            },
            city: {
                required: true,
            },
            mobile: {
                required: true,
            },
            email: {
                required: true,
            },
        },
        messages: {
            street: {
                required: "This street field is required",
            },
            landmark: {
                required: "This landmark field is required",
            },
            area: {
                required: "This area field is required",
            },
            pincode: {
                required: "This pincode field is required",
            },
            city: {
                required: "This city field is required",
            },
        }
    });
</script>
<script  async>
    $('#adminAddressEdit').validate({
        rules: {
            street: {
                required: true,
            },
            landmark: {
                required: true,
            },
            area: {
                required: true,
            },
            pincode: {
                required: true,
            },
            city: {
                required: true,
            },
            mobile: {
                required: true,
            },
            email: {
                required: true,
            },
        },
        messages: {
            street: {
                required: "This street field is required",
            },
            landmark: {
                required: "This landmark field is required",
            },
            area: {
                required: "This area field is required",
            },
            pincode: {
                required: "This pincode field is required",
            },
            city: {
                required: "This city field is required",
            },
        }
    });
</script>
<script  async>
    $('#adminLinkCreate').validate({
        rules: {
            facebook: {
                required: true,
            },
            instagram: {
                required: true,
            },
            linkedin: {
                required: true,
            },
            twitter: {
                required: true,
            },
            youtube: {
                required: true,
            },
        },
        messages: {
            facebook: {
                required: "This facebook field is required",
            },
            instagram: {
                required: "This instagram field is required",
            },
            linkedin: {
                required: "This linkedin field is required",
            },
            twitter: {
                required: "This twitter field is required",
            },
            youtube: {
                required: "This youtube field is required",
            },
        }
    });
</script>
<script  async>
    $.validator.addMethod("notEqual", function(value, element, param) {
    return this.optional(element) || value !== $(param).val();
  }, "Old password and new password must be different");
  $.validator.addMethod("password", function(value, element) {
        if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()+=-\?;,./{}|\":<>\[\]\\\' ~_]).{8,}/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Use at least 8 characters. Use a mix of letters (uppercase and lowercase), numbers, and symbols.");

$('#ChangePassword').validate({
    rules: {
    old_password: {
        required: true,
    },
    new_password: {
        required: true,
        minlength: 8,
        notEqual: "#old_password"
    },
    confirm_password: {
        required: true,
        minlength: 8,
        equalTo: "#new_password",
    },
},
messages: {
    old_password: {
        required: "This old Password field is required",
    },
    new_password: {
        required: "This new password field is required",
        minlength: "Enter at least 8 characters",
    },
    confirm_password: {
        required: "This confirm password field is required",
        minlength: "Enter at least 8 characters",
        equalTo: "The password and its confirm are not the same",
    },
},
});
</script>
{{-- old password.. --}}
<script  async>
    const passwordInput = document.getElementById('old_password');
const showPasswordButton = document.getElementById('show-password');

showPasswordButton.addEventListener('click', function() {
  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordInput.setAttribute('type', type);
  showPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
  showPasswordButton.querySelector('i').classList.toggle('fa-eye');
  showPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
});
</script>
{{-- new password.. --}}
<script  async>
    const newpasswordInput = document.getElementById('new_password');
const showNewPasswordButton = document.getElementById('show-newpassword');

showNewPasswordButton.addEventListener('click', function() {
  const type = newpasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  newpasswordInput.setAttribute('type', type);
  showNewPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
  showNewPasswordButton.querySelector('i').classList.toggle('fa-eye');
  showNewPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
});
</script>
{{-- confirm password.. --}}
<script  async>
    const confirmpasswordInput = document.getElementById('confirm_password');
const showConfirmPasswordButton = document.getElementById('show-confirmpassword');

showConfirmPasswordButton.addEventListener('click', function() {
  const type = confirmpasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  confirmpasswordInput.setAttribute('type', type);
  showConfirmPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
  showConfirmPasswordButton.querySelector('i').classList.toggle('fa-eye');
  showConfirmPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
});
</script>
<script  async>
    $('body').click(function(){
        var error_class = $('#old_password-error').text();
        var new_error_class = $('#new_password-error').text();
        var conforim_error_class = $('#confirm_password-error').text();
        // alert(error_class);
        if (error_class != '') {
            $('#show-password').css('top','9%');
        } else{
            $('#show-password').css('top','18%');
        }

        if (new_error_class != '') {
            $('#show-newpassword').css('top','9%');
        } else {
            $('#show-newpassword').css('top','18%');
        }

        if (conforim_error_class != '') {
            $('#show-confirmpassword').css('top','9%');
        } else {
            $('#show-confirmpassword').css('top','18%');
        }

    })
</script>
@endsection
