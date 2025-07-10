@extends('layouts.layout')
@section('title', 'All Jobs')
@section('content')
<?php
  $baseUrl = URL::to('/');
?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                @include('common.message')
            </div>
        </div>
        @if(isset($recent_jobs))
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
                            <p class="card-text text-dark d-inline">Posted Date: <br> {{date('d M, Y', strtotime($job->posted_at))}}</p>
                        </div>

                        <div>
                            <a href="{{route('job.details', $job->id)}}" class="btn btn-xs btn-primary">Job Details</a>
                            @if(auth()->user()->role_id != 3)
                            <a href="{{route('job.wise.application.list', $job->id)}}" class="btn btn-xs btn-primary">Application List</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <form id="jobFilters" style="display: none;" method="GET" action="{{ route('job.list') }}">
            <div class="row py-3">
                <div class="col-md-5">
                    <input type="text" name="title" class="form-control" 
                        placeholder="Job title" value="{{ request('title') }}">
                </div>
                <div class="col-md-4">
                    <select name="location" class="form-control">
                        <option value="" selected>Choose...</option>
                        @foreach (job_locations() as $key => $value)
                            <option value="{{ $key }}" {{(request('location') == $key) ? 'selected' : ''}}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 text-right">
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-search-web"></i> Search</button>
                    <a href="{{ route('job.list') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>All Jobs</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <button id="filterToggle" class="btn btn-sm btn-outline-primary">
                    <i class="mdi mdi-filter"></i> Filter
                </button>
            </div>
        </div>
        <div class="row">
            @if($jobs->isEmpty())
            <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
                <div class="alert alert-warning">
                    @if($search_title || $search_location)
                        No jobs found matching 
                        @if($search_title) "{{ $search_title }}" @endif
                        @if($search_location) in {{ job_locations()[$search_location] }} @endif
                    @else
                        No jobs available at this time
                    @endif
                </div>
            </div>
            @else
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
                            <p class="card-text text-dark d-inline">Posted Date: <br> {{date('d M, Y', strtotime($job->posted_at))}}</p>
                        </div>

                        <div>
                            <a href="{{route('job.details', $job->id)}}" class="btn btn-xs btn-primary">Job Details</a>
                            @if(auth()->user()->role_id != 3)
                            <a href="{{route('job.wise.application.list', $job->id)}}" class="btn btn-xs btn-primary">Application List</a>
                            @endif

                            @if(auth()->user()->role_id == 2)
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown">Action</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('job.edit',$job->id)}}">Edit</a>
                                    <a class="dropdown-item text-danger" href="#"
                                    onclick="if(confirm('Are you sure you want to delete this job?')) {
                                        event.preventDefault();
                                        document.getElementById('delete-job-{{ $job->id }}').submit();
                                    }">
                                    Delete
                                    </a>

                                    <form id="delete-job-{{ $job->id }}" action="{{ route('job.destroy', $job->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    $('#filterToggle').click(function() {
        $('#jobFilters').toggle();
    });
    @if(request()->anyFilled(['title','location'])) $('#filterToggle').click(); @endif
});
</script>
@endsection