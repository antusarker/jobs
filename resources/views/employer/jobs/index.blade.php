@extends('layouts.layout')
@section('title', 'All Jobs')
@section('content')
<?php
  $baseUrl = URL::to('/');
?>
<div class="content-body">
    <div class="container-fluid">
        @if($recent_jobs ?? false)
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <h4>Recent Jobs</h4>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($recent_jobs as $job)
            <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{$job->title}}</h5>
                        <span class="text-muted d-flex align-items-center">
                            <div>
                            <i class="mdi mdi-map-marker me-1"></i>
                            {{ job_locations()[$job->location] ?? 'Unknown Location' }} | {{ job_types()[$job->job_type] ?? 'Unknown Type' }}
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! \Str::limit($job->description, 300, '...') !!}</p>
                        <i>Posted by : {{$job->employer->name}}</i>
                    </div>
                    <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                            <p class="card-text text-dark d-inline">Posted Date: {{date('d M, Y', strtotime($job->posted_at))}}</p>
                        </div>

                        <div>
                            <a href="{{route('job.details', $job->id)}}" class="btn btn-primary">Job Details</a>
                            @if(auth()->user()->role_id != 3)
                            <a href="{{route('job.wise.application.list', $job->id)}}" class="btn btn-primary">Application List</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <h4>All Jobs</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($jobs as $job)
            <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{$job->title}}</h5>
                        <span class="text-muted d-flex align-items-center">
                            <div>
                            <i class="mdi mdi-map-marker me-1"></i>
                            {{ job_locations()[$job->location] ?? 'Unknown Location' }} | {{ job_types()[$job->job_type] ?? 'Unknown Type' }}
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! \Str::limit($job->description, 300, '...') !!}</p>
                        <i>Posted by : {{$job->employer->name}}</i>
                    </div>
                    <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                            <p class="card-text text-dark d-inline">Posted Date: {{date('d M, Y', strtotime($job->posted_at))}}</p>
                        </div>

                        <div>
                            <a href="{{route('job.details', $job->id)}}" class="btn btn-primary">Job Details</a>
                            @if(auth()->user()->role_id != 3)
                            <a href="{{route('job.wise.application.list', $job->id)}}" class="btn btn-primary">Application List</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection