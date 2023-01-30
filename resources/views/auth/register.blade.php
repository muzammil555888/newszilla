@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card bg-dark shadow-light text-light text-center">
                <div class="card-header text-center h3 text-roboto">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                            <input id="name" type="text" class="form-control mt-4 @error('name') is-invalid @enderror" name="name" placeholder="Enter Name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                            <input id="email" type="email" class="form-control mt-4 @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input id="password" type="password" class="form-control mt-4 @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input id="password-confirm" type="password" class="form-control mt-4" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                            
                            <button type="submit" class="btn btn-danger mt-4">
                                {{ __('Register') }}
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
