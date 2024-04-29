@extends('admin.layout.app')

@section('title')
    Project Detail
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Detail Managment</span>
        </h4>
    </div>
    @can('project-details-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('project-details.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">Project Detail</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    
										<th>Project Id</th>
										<th>Chiller Id</th>
										<th>Chiller Maximum Capacity</th>
										<th>Chiller Minimum Capacity</th>
										<th>Chilled Water Flow</th>
										<th>Partial Load 25</th>
										<th>Partial Load 50</th>
										<th>Partial Load 75</th>
										<th>Partial Load 100</th>

                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($projectDetails as $key => $projectDetail)
                <tr>
                    <td>{{ ++$key }}</td>
                    
											<td>{{ $projectDetail->project_id }}</td>
											<td>{{ $projectDetail->chiller_id }}</td>
											<td>{{ $projectDetail->chiller_maximum_capacity }}</td>
											<td>{{ $projectDetail->chiller_minimum_capacity }}</td>
											<td>{{ $projectDetail->chilled_water_flow }}</td>
											<td>{{ $projectDetail->partial_load_25 }}</td>
											<td>{{ $projectDetail->partial_load_50 }}</td>
											<td>{{ $projectDetail->partial_load_75 }}</td>
											<td>{{ $projectDetail->partial_load_100 }}</td>

                    <td class="text-center">@include('admin.project-detail.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@canany(['project-details-view', 'project-details-edit', 'project-details-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('project-details.destroy',$projectDetail->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('project-details-view')
                    <a href="{{ route('project-details.show',$projectDetail->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('project-details-edit')
                    <a href="{{ route('project-details.edit',$projectDetail->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('project-details-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany
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