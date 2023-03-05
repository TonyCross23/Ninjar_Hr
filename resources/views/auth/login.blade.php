@extends('layouts.app_plain')

@section('title','Login')

@section('content')
<div class="container">
    <div class="row justify-content-center align-content-center" style="height: 100vh;">
        <div class="col-md-6">
            <div class="text-center md-0">
                <img src="{{asset('image/logo.png')}}" alt="ninja" style="width: 80px;">
            </div>

            <div class="card">
                <div class="card-body">
                   <div class="mb-4 text-center">
                        <h4>Login</h4>
                        <p>Please! Login account</p>
                   </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-outline my-4">
                            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror"  value="{{ old('phone') }}" name="phone" required>
                            <label for="phone" class="form-label">Phone</label>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-outline my-4">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            <label for="password" class="form-label">Password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="">
                            <button type="submit" class="btn btn-theme mt-4 btn-block">Login</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
