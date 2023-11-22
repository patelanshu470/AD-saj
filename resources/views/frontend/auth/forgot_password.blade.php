@extends('frontend.layouts.fullLayoutMaster')

@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                <span></span> Pages
                <span></span> Forgot Password
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
                                        <h3 class="mb-30">Forgot Password</h3>
                                    </div>
                                    <form method="POST" action="{{ route('forget.password.post') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" required="" name="email" placeholder="Your Email">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up">Reset</button>
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


