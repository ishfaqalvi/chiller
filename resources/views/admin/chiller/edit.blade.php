@extends('admin.layout.app')

@section('title')
    {{ __('Update') }} Chiller
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
            <h5 class="mb-0">{{ __('Edit ') }} Chiller </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('chillers.update', $chiller->id) }}" class="validate"   role="form" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                 @include('admin.chiller.form')
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){
        $('.select').select2();
        var _token = $("input[name='_token']").val();
        $.validator.addMethod("validFormula", function(value, element) {
            return this.optional(element) || /^[0-9+\-*/^().x\s]+$/.test(value);
        }, "Please enter a valid formula with numbers, math signs, and the variable 'x'.");
        $('.validate').validate({
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).addClass('is-invalid');
                $(element).removeClass('is-valid');
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            success: function(label) {
                label.addClass('validation-valid-label').text('Success.');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }else {
                    error.insertAfter(element);
                }
            },
            rules: {
                formula: {
                    required: function(element) {
                        return $("#status").val() === "Approved";
                    },
                    validFormula: true,
                    "remote":
                    {
                        url: "{{ route('chillers.validFormula') }}",
                        type: "POST",
                        data: {
                            _token:_token,
                            formula: function() {
                                return $("input[name='formula']").val();
                            }
                        },
                    }
                }
            },
            messages: {
                formula: {
                    required: "Please enter a formula",
                    validFormula: "The formula can only contain numbers, math signs, and the variable 'x'.",
                    remote: jQuery.validator.format("{0} must be a valid formula..")
                }
            }
        });
        var default_model_id = "{{ $chiller->model_id }}";
        let id = $('select[name=brand_id]').val();
        models_list(id, default_model_id);
        $('select[name=brand_id]').change(function () {
            let id = $(this).val();
            models_list(id, 0);
        });
        function models_list(id,default_model_id){
            $('select[name=model_id]').html('<option value="">--Select--</option>');
            $('select[name=model_id]').attr('disabled',false);
            $.get('/admin/chillers/get_models', {id: id}).done(function (result) {
                let data = JSON.parse(result);
                $.each(data, function (i, val) {
                    if(val.id == default_model_id){
                        $('select[name=model_id]').append($('<option>',
                            {selected : 'selected', value : val.id, text : val.name}
                        ));
                    }else{
                        $('select[name=model_id]').append($('<option>',
                            {value : val.id,  text : val.name}
                        ));
                    }
                });
            });
        }
    });
</script>
@endsection
