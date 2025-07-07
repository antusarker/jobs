@extends('layouts.layout')
@section('title', 'All Employers')
@section('content')
<?php
  $baseUrl = URL::to('/');
?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Employer List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;">Employer</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:;">List</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employers as $key=>$employer)
                                    <tr>
                                        <th scope="row">{{++$key}}</th>
                                        <td>{{$employer->name}}</td>
                                        <td>{{$employer->email}}</td>
                                        <td><span class="badge badge-primary">...</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
@endsection