@extends('layouts.guestLayout')
@section('title', 'Login')
@section('content')
<div class="authincation-content">
    <div class="row no-gutters">
        <div class="col-xl-12">
            <div class="auth-form">
                <h4 class="text-center mb-4">Sign in your account</h4>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label><strong>Email</strong></label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label><strong>Password</strong></label>
                        <input type="password" class="form-control" value="" name="password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                        <div class="form-group">
                            <div class="form-check ml-2">
                                <input class="form-check-input" type="checkbox" id="basic_checkbox_1" name="remember">
                                <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{route('password.request')}}">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">Log in</button>
                    </div>
                </form>
                <div class="new-account mt-3">
                    <p>Don't have an account? <a class="text-primary" href="{{route('register')}}">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
