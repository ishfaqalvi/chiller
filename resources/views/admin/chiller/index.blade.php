@extends('admin.layout.app')

@section('title')
    Chiller
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Chiller Managment</span>
        </h4>
    </div>
    @can('chillers-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('chillers.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Create New
            </a>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Chiller</h5>
        </div>
        <div class="table-responsive">
            <table class="table datatable-basic">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Capacity</th>
                        <th>CHW Flow</th>
                        <th>IPLV</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($chillers as $key => $chiller)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $chiller->name }}</td>
                        <td>{{ $chiller->model }}</td>
                        <td>
                            {{ 'Max => '.$chiller->chiller_maximum_capacity }}</br>
                            {{ 'Min => '.$chiller->chiller_minimum_capacity }}
                        </td>
                        <td>{{ $chiller->chilled_water_flow }}</td>
                        <td>
                            {{ '25% => '.$chiller->partial_load_25 }}</br>
                            {{ '50% => '.$chiller->partial_load_50 }}</br>
                            {{ '75% => '.$chiller->partial_load_75 }}</br>
                            {{ '100% => '.$chiller->partial_load_100 }}</br>
                        </td>
                        <td>{{ $chiller->status }}</td>
                        <td class="text-center">@include('admin.chiller.actions')</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });
        $(".sa-confirm").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.value === true)  $(this).closest("form").submit();
            });
        });
    });
</script>
@endsection
