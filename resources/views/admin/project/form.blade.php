<div class="row">
	
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('customer_id') }}
        {{ Form::text('customer_id', $project->customer_id, ['class' => 'form-control' . ($errors->has('customer_id') ? ' is-invalid' : ''), 'placeholder' => 'Customer Id','required']) }}
        {!! $errors->first('customer_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('number_of_chillers') }}
        {{ Form::text('number_of_chillers', $project->number_of_chillers, ['class' => 'form-control' . ($errors->has('number_of_chillers') ? ' is-invalid' : ''), 'placeholder' => 'Number Of Chillers','required']) }}
        {!! $errors->first('number_of_chillers', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('building_minimum_load') }}
        {{ Form::text('building_minimum_load', $project->building_minimum_load, ['class' => 'form-control' . ($errors->has('building_minimum_load') ? ' is-invalid' : ''), 'placeholder' => 'Building Minimum Load','required']) }}
        {!! $errors->first('building_minimum_load', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('building_maximum_load') }}
        {{ Form::text('building_maximum_load', $project->building_maximum_load, ['class' => 'form-control' . ($errors->has('building_maximum_load') ? ' is-invalid' : ''), 'placeholder' => 'Building Maximum Load','required']) }}
        {!! $errors->first('building_maximum_load', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('chilled_water_differential') }}
        {{ Form::text('chilled_water_differential', $project->chilled_water_differential, ['class' => 'form-control' . ($errors->has('chilled_water_differential') ? ' is-invalid' : ''), 'placeholder' => 'Chilled Water Differential','required']) }}
        {!! $errors->first('chilled_water_differential', '<div class="invalid-feedback">:message</div>') !!}
    </div>

	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>