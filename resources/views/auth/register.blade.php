@extends('layouts.wizard')
@section('wizard')
    <div class="limiter">
        <div class="container-login100">
            <div class="login100-more" style="background-image: url({{ asset('wizard/images/bg-01.jpg') }});"></div>

            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form action="{{ route('register') }}" class="login100-form validate-form" method="post">
                    @csrf
                    <span class="login100-form-title p-b-59">
						<span class="fa fa-university"></span> Student Sign Up
					</span>

                    <div class="wrap-input100 validate-input" data-validate="Name is required">
                        <span class="label-input100">Full Name</span>
                        <input class="input100 form-control @error('name') is-invalid @enderror" type="text" name="name"
                               placeholder="Name..." value="{{ old('name') }}">
                        <span class="focus-input100"></span>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Age is required">
                        <span class="label-input100">Age</span>
                        <input class="input100 form-control @error('age') is-invalid @enderror" type="age" name="age"
                               placeholder="Age..." value="{{ old('age') }}" min="16" max="40">
                        <span class="focus-input100"></span>
                        @error('age')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Gender is required">
                        <span class="label-input100">Gender</span>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="--- Select Gender ---" disabled selected>--- Select Gender ---</option>
                            <option value="Male">--- Male ---</option>
                            <option value="Female">--- Female ---</option>
                        </select>
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="County is required">
                        <span class="label-input100">County</span>
                        <select name="county_id" id="county_id"
                                class="form-control @error('county_id') is-invalid @enderror">
                            <option value="--- Select County ---" disabled selected>--- Select County ---</option>

                            @foreach(\App\Http\Controllers\SystemController::fetchData()[0] as $county)
                                <option value="{{ $county->id }}">--- {{ $county->name }} ---</option>
                            @endforeach
                        </select>
                        @error('county_id')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Program is required">
                        <span class="label-input100">Program</span>
                        <select name="program_id" id="program_id"
                                class="form-control @error('product_id') is-invalid @enderror">
                            <option value="--- Select Program ---" disabled selected>--- Select Program ---</option>

                            @foreach(\App\Http\Controllers\SystemController::fetchData()[1] as $program)
                                <option value="{{ $program->id }}">--- {{ $program->name }} ---</option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <span class="label-input100">Email</span>
                        <input class="input100 form-control @error('email') is-invalid @enderror" type="text"
                               name="email"
                               placeholder="Email address..."
                               value="{{ old('email') }}">
                        <span class="focus-input100"></span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <span class="label-input100">Phone Number</span>
                        <input class="input100 form-control @error('phoneNumber') is-invalid @enderror" type="text"
                               name="phoneNumber" placeholder="Phone Number..."
                               value="{{ old('phoneNumber') }}">
                        <span class="focus-input100"></span>
                        @error('phoneNumber')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100 form-control @error('password') is-invalid @enderror" type="password"
                               name="password"
                               placeholder="*************">
                        <span class="focus-input100"></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Repeat Password is required">
                        <span class="label-input100">Confirm Password</span>
                        <input class="input100 form-control" type="password" name="password_confirmation"
                               id="password_confirmation"
                               placeholder="*************">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                Sign Up
                            </button>
                        </div>

                        <a href="{{ route('login') }}" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                            Sign In
                            <i class="fa fa-long-arrow-right m-l-5"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
