@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card bg-dark shadow-light text-light">
                <div class="card-header text-center h3 text-roboto">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <input id="email" type="email" class="form-control mt-4 @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                            <input id="password" type="password" class="form-control mt-4 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input id="password-confirm" type="password" class="form-control mt-4" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">

                            <button type="submit" class="btn btn-danger mt-4">
                                {{ __('Reset Password') }}
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
