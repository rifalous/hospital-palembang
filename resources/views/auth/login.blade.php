@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
<div class="col-sm-12">

    <div class="wrapper-page">

        <div class="m-t-40 account-pages">
            <div class="text-center account-logo-box" style="background-color: #fff">
                <h2 class="text-uppercase">
                    <a href="index.html" class="text-success">
                        <span><img src="assets/images/logo.png" alt="" style="width: 150px; height: auto"></span>
                    </a>
                </h2>
                <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
            </div>
            <div class="account-content">

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Oh snap!</strong>{{ session('error') }}
                </div>
                @endif

                <form class="form-horizontal" action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}
                    <div class="text-center"  style="background: #fff !important">
    
                        <!-- Image logo -->
                        <!-- <a href="{{ url('/') }}" class="logo">
                            <span>
                                <img src="{{ url('assets/images/hospital.jpg') }}" alt="" style="width: 180px; height: 60px;">
                            </span>
                            <i>
                                <img src="{{ url('assets/images/hospital.jpg') }}" alt="" height="28">
                            </i>
                        </a> -->
                        <h3>Sistem Informasi Rumah Sakit</h3>
                    </div><br>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"">
                        <div class="col-xs-12">
                            <input class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" type="email" required="required" placeholder="Email" name="email">
                            @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="required" placeholder="Password" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-success">
                                <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group account-btn text-center m-t-10">
                        <div class="col-xs-12">
                            <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div><br>

                    <div class="form-group text-center m-t-30">
                        <!-- <div class="col-sm-12">
                            <a href="{{ route('password.request') }}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                        </div> -->
                    </div>

                </form>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- end card-box-->

    </div>
    <!-- end wrapper -->

</div>

@endsection
