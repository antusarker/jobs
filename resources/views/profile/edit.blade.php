@extends('layouts.layout')
@section('title', 'Profile')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Profile</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;">Profile</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:;">Update</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                @if(empty(auth()->user()->email_verified_at))
                    @include('profile.partials.email-verification')
                @endif
                @include('profile.partials.update-profile-information-form')
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
</div>
@endsection