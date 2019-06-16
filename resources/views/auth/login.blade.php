@extends('layouts.wizard')
@section('wizard')
    <div class="limiter">
        <div class="container-login100">
            <div class="login100-more" style="background-image: url({{ asset('wizard/images/bg-01.jpg') }});"></div>

            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form action="{{ route('login') }}" class="login100-form validate-form" method="post">
                    @csrf
                    <span class="login100-form-title p-b-59">
						<span class="fa fa-graduation-cap"></span> Student Sign In
					</span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <span class="label-input100">Email</span>
                        <input class="input100 form-control @error('email') is-invalid @enderror" type="email"
                               name="email"
                               id="email"
                               placeholder="Email addess..." value="{{ old('email') }}">
                        <span class="focus-input100"></span>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100 form-control @error('password') is-invalid @enderror" id="password"
                               type="password"
                               name="password"
                               placeholder="*************">
                        <span class="focus-input100"></span>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    {{--                    <div class="container-login100-form-btn" style="margin-left: 150px; margin-bottom: 30px;">--}}
                    {{--                        <a href="{{ route('password.request') }}"--}}
                    {{--                           class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30 float-right">--}}
                    {{--                            {{ __('Forgot Your Password?') }}--}}
                    {{--                            <i class="fa fa-anchor m-l-5"></i>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                Sign In
                            </button>
                        </div>
                        <a href="{{ route('register') }}" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                            Sign Up
                            <i class="fa fa-long-arrow-right m-l-5"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
