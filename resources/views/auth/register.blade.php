@extends('layouts.website')

@section('content')


<!-- <div class="container-fluid p-0">
    <div class="image image-s image-hd-md image-header-lg">
        <img class="image-cover" src="/images/register.jpg" alt="Demo Image">
    </div>
</div> -->

<div class="container">

    <div class="row justify-content-center my-5">

        <div class="col-12 col-sm-12 col-md-6 p-5">
            <h4 class=" text-uppercase d-inline-block border-bottom pb-1 mb-4 border-dark">Register</h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row">


                    <div class="col-12 form-group mb-2">
                        <label class="font-weight-bold" for="name">Full Name</label>
                        <input id="name" type="text" class="form-control rounded-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group mb-2">
                        <label class="font-weight-bold" for="mobile">Mobile No</label>
                        <input id="mobile" type="text" class="form-control rounded-0 @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>
                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group mb-2">
                        <label class="font-weight-bold" for="email">Email Address</label>
                        <input class="form-control rounded-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" type="email" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group mb-2">
                        <label class="font-weight-bold" for="password">Password</label>


                        <div class="input-group">
                            <input class="form-control rounded-0 @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="new-password" >
                            <div class="input-group-append" id="show_hide_password" style="cursor:pointer;">
                                <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group mb-2">
                        <label class="font-weight-bold" for="password-confirm">Confirm Password</label>
                        <input class="form-control rounded-0 @error('password') is-invalid @enderror" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" >
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="iamagree" id="iamagree" {{ old('iamagree') ? 'checked' : '' }} required>
                                <label class="form-check-label" for="iamagree">
                                    <span class="small">I agree to <a target="_blank" href="/tnc">Terms & Conditions</a> and <a target="_blank" href="/privacypolicy">privacy policy</a></span>
                                </label>
                            </div>
                        </div>
                        @error('iamagree')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group mb-2">
                        <input class="btn btn-dark rounded-0 btn-lg text-uppercase" type="submit" value="Register" >
                    </div>

                    <div class="col-12 form-group mb-2">
                        <a class="btn btn-link px-0 mr-4" href="/login">{{ __('Already have accoutn? Login here!') }}</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
