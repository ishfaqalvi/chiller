@extends('admin.layout.app')

@section('title')
    {{ $chiller->name ?? "Show Chiller" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Chiller Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('chillers.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Chiller</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Brand:</strong>
                {{ $chiller->brand->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Model:</strong>
                {{ $chiller->model->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Name:</strong>
                {{ $chiller->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Formula:</strong>
                {{ $chiller->formula }}
            </div>
            <div class="form-group mb-3">
                <strong>Maximum Capacity:</strong>
                {{ $chiller->chiller_maximum_capacity }}
            </div>
            <div class="form-group mb-3">
                <strong>Minimum Capacity:</strong>
                {{ $chiller->chiller_maximum_capacity }}
            </div>
            <div class="form-group mb-3">
                <strong>Water Flow:</strong>
                {{ $chiller->chilled_water_flow }}
            </div>
            <div class="form-group mb-3">
                <strong>Status:</strong>
                {{ $chiller->status }}
            </div>
            <div class="form-group mb-3">
                <strong>Partial Load 25 %:</strong>
                {{ $chiller->partial_load_25 }}
            </div>
            <div class="form-group mb-3">
                <strong>Partial Load 50 %:</strong>
                {{ $chiller->partial_load_50 }}
            </div>
            <div class="form-group mb-3">
                <strong>Partial Load 75 %:</strong>
                {{ $chiller->partial_load_75 }}
            </div>
            <div class="form-group mb-3">
                <strong>Partial Load 100 %:</strong>
                {{ $chiller->partial_load_100 }}
            </div>
        </div>
    </div>
</div>
@endsection
