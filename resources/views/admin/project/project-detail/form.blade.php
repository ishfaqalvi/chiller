<div class="row">
	
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('project_id') }}
        {{ Form::text('project_id', $projectDetail->project_id, ['class' => 'form-control' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => 'Project Id','required']) }}
        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('chiller_id') }}
        {{ Form::text('chiller_id', $projectDetail->chiller_id, ['class' => 'form-control' . ($errors->has('chiller_id') ? ' is-invalid' : ''), 'placeholder' => 'Chiller Id','required']) }}
        {!! $errors->first('chiller_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('chiller_maximum_capacity') }}
        {{ Form::text('chiller_maximum_capacity', $projectDetail->chiller_maximum_capacity, ['class' => 'form-control' . ($errors->has('chiller_maximum_capacity') ? ' is-invalid' : ''), 'placeholder' => 'Chiller Maximum Capacity','required']) }}
        {!! $errors->first('chiller_maximum_capacity', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('chiller_minimum_capacity') }}
        {{ Form::text('chiller_minimum_capacity', $projectDetail->chiller_minimum_capacity, ['class' => 'form-control' . ($errors->has('chiller_minimum_capacity') ? ' is-invalid' : ''), 'placeholder' => 'Chiller Minimum Capacity','required']) }}
        {!! $errors->first('chiller_minimum_capacity', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('chilled_water_flow') }}
        {{ Form::text('chilled_water_flow', $projectDetail->chilled_water_flow, ['class' => 'form-control' . ($errors->has('chilled_water_flow') ? ' is-invalid' : ''), 'placeholder' => 'Chilled Water Flow','required']) }}
        {!! $errors->first('chilled_water_flow', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('partial_load_25') }}
        {{ Form::text('partial_load_25', $projectDetail->partial_load_25, ['class' => 'form-control' . ($errors->has('partial_load_25') ? ' is-invalid' : ''), 'placeholder' => 'Partial Load 25','required']) }}
        {!! $errors->first('partial_load_25', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('partial_load_50') }}
        {{ Form::text('partial_load_50', $projectDetail->partial_load_50, ['class' => 'form-control' . ($errors->has('partial_load_50') ? ' is-invalid' : ''), 'placeholder' => 'Partial Load 50','required']) }}
        {!! $errors->first('partial_load_50', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('partial_load_75') }}
        {{ Form::text('partial_load_75', $projectDetail->partial_load_75, ['class' => 'form-control' . ($errors->has('partial_load_75') ? ' is-invalid' : ''), 'placeholder' => 'Partial Load 75','required']) }}
        {!! $errors->first('partial_load_75', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('partial_load_100') }}
        {{ Form::text('partial_load_100', $projectDetail->partial_load_100, ['class' => 'form-control' . ($errors->has('partial_load_100') ? ' is-invalid' : ''), 'placeholder' => 'Partial Load 100','required']) }}
        {!! $errors->first('partial_load_100', '<div class="invalid-feedback">:message</div>') !!}
    </div>

	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>