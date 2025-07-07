@extends('layouts.layout')
@section('title', 'Job Details')
@section('content')
<?php
  $baseUrl = URL::to('/');
?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-xxl-8 col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <span class="text-muted d-flex align-items-center">
                            <div>
                            <i class="mdi mdi-map-marker me-1"></i>
                            {{ job_locations()[$job->location] ?? 'Unknown Location' }} | {{ job_types()[$job->job_type] ?? 'Unknown Type' }}
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! $job->description !!}</p>

                        <p class="card-text">Salary Range : {!! $job->min_salary !!} - {!! $job->max_salary !!}
                        <br>
                        Experience Lavel : {!! experience_levels()[$job->experience_level] !!} 
                        <br>
                        Deadline : {!! date('d M, Y', strtotime($job->expires_at)) !!}
                        <br>
                        <i>Posted by : {{$job->employer->name}} </i>
                        </p>
                    </div>
                    <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                            <p class="card-text text-dark d-inline">Posted Date : {{date('d M, Y', strtotime($job->posted_at))}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-12">
                @include('common.message')
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('application.store', $job->id)}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-row">
                                <div class="form-group">
                                    <label>Cover Letter</label>
                                    <textarea class="form-control" name="cover_letter" rows="5" cols="60">{{ old('cover_letter') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Upload Resume</label>
                                    <input type="file" class="form-control" name="resume_path">
                                </div>
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection