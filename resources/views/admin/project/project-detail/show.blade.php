@extends('admin.layout.app')

@section('title')
    {{ $projectDetail->name ?? "Show Project Detail" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Detail Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('project-details.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Back
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Show') }} Project Detail</h5>
        </div>
        <div class="card-body">
            
                        <div class="form-group mb-3">
                            <strong>Project Id:</strong>
                            {{ $projectDetail->project_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Chiller Id:</strong>
                            {{ $projectDetail->chiller_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Chiller Maximum Capacity:</strong>
                            {{ $projectDetail->chiller_maximum_capacity }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Chiller Minimum Capacity:</strong>
                            {{ $projectDetail->chiller_minimum_capacity }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Chilled Water Flow:</strong>
                            {{ $projectDetail->chilled_water_flow }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Partial Load 25:</strong>
                            {{ $projectDetail->partial_load_25 }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Partial Load 50:</strong>
                            {{ $projectDetail->partial_load_50 }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Partial Load 75:</strong>
                            {{ $projectDetail->partial_load_75 }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Partial Load 100:</strong>
                            {{ $projectDetail->partial_load_100 }}
                        </div>

        </div>
    </div>
</div>
@endsection