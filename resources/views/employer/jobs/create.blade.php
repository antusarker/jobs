@extends('layouts.layout')
@section('title', 'Create Job')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Create Job</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;">Job</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:;">Create</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                @include('common.message')
            </div>
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('job.store')}}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Job Title *</label>
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Ex: Sr. Software Engineer">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Location *</label>
                                        <select class="form-control" name="location">
                                            <option selected>Choose...</option>
                                            @foreach (job_locations() as $key => $value)
                                                <option value="{{ $key }}" {{ old('location') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Job Type *</label>
                                        <select class="form-control" name="job_type">
                                            <option selected>Choose...</option>
                                            @foreach (job_types() as $key => $value)
                                                <option value="{{ $key }}" {{ old('job_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Experience Level *</label>
                                        <select class="form-control" name="experience_level">
                                            <option selected>Choose...</option>
                                            @foreach (experience_levels() as $key => $value)
                                                <option value="{{ $key }}" {{ old('experience_level') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Skills *</label>
                                        <select class="form-control" name="job_skill">
                                            <option selected>Choose...</option>
                                            @foreach (job_skills() as $key => $value)
                                                <option value="{{ $key }}" {{ old('job_skill') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Min Salary *</label>
                                        <input type="text" class="form-control number-only" name="min_salary" value="{{ old('min_salary') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Max Salary *</label>
                                        <input type="text" class="form-control number-only" name="max_salary" value="{{ old('max_salary') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Deadline *</label>
                                        <input type="date" class="form-control" name="expires_at" value="{{ old('expires_at') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description *</label>
                                    <textarea class="form-control" id="ckeditor" name="description" rows="10" cols="60">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active') == 1 ? 'checked' : 'checked'}} >
                                        <label class="form-check-label">
                                            Is Active
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Create Job</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection