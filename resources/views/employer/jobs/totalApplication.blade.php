@extends('layouts.layout')
@section('title', 'Job wise Applications')
@section('content')
<?php
  $baseUrl = URL::to('/');
?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Applications</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;">{{$job->title}} ({{job_types()[$job->job_type]}})</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:;">All</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            @foreach($applications as $application)
            <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{$application->candidate->name}}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! \Str::limit($application->cover_letter, 300, '...') !!}</p>
                    </div>
                    <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                            <p class="card-text text-dark d-inline">Applied Date: {{date('d M, Y', strtotime($application->created_at))}}</p>
                        </div>
                        <div>
                            <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" class="btn btn-primary">View Resume <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection