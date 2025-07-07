@extends('layouts.guestLayout')
@section('title', 'Registration')
@section('content')
<div class="authincation-content">
    <div class="row no-gutters">
        <div class="col-xl-12">
            <div class="auth-form">
                <h4 class="text-center mb-4">User registration</h4>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label><strong>User Type *</strong></label>
                        <select id="inputState" class="form-control" name="role_id">
                            <option selected="" disabled>Choose...</option>
                            <option value="2">Employer</option>
                            <option value="3">Candidate</option>
                        </select>
                        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label><strong>Name *</strong></label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label><strong>Email *</strong></label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label><strong>Password *</strong></label>
                        <input type="password" class="form-control" value="" name="password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label><strong>Confirm Password *</strong></label>
                        <input type="password" class="form-control" value="" name="password_confirmation">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </form>
                <div class="new-account mt-3">
                    <p>Don't have an account? <a class="text-primary" href="{{route('login')}}">Already registered</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
