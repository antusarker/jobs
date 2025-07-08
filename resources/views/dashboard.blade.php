@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
<?php
  $baseUrl = URL::to('/');
?>
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">No of Jobs </div>
                            <div class="stat-digit">{{$total_jobs}}</div>
                        </div>
                        <a href="{{route('job.list')}}">View <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Employer</div>
                            <div class="stat-digit">{{$employers}}</div>
                        </div>
                        <a href="{{route('employer.list')}}">View <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Application</div>
                            <div class="stat-digit">{{$applications}}</div>
                        </div>
                        <a href="{{route('application.all')}}">View <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Candidate</div>
                            <div class="stat-digit">{{$candidates}}</div>
                        </div>
                        <a href="{{route('candidate.list')}}">View <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
                <!-- /# card -->
            </div>
            <!-- /# column -->
        </div>
    </div>
</div>
@endsection