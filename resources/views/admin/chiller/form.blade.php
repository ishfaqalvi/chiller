<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('brand_id', 'Brand') }}
        {{ Form::select('brand_id', brands(), $chiller->brand_id, ['class' => 'form-control select' . ($errors->has('brand_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('brand_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('model_id', 'Model') }}
        {{ Form::select('model_id', [], $chiller->model_id, ['class' => 'form-control select' . ($errors->has('model_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','disabled']) }}
        {!! $errors->first('model_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $chiller->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-8 mb-3">
        {{ Form::label('formula') }}
        {{ Form::text('formula', $chiller->formula, ['class' => 'form-control' . ($errors->has('formula') ? ' is-invalid' : ''), 'placeholder' => 'Formula']) }}
        {!! $errors->first('formula', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('status') }}
        {{ Form::select('status', ['Pending'=>'Pending','Approved'=>'Approved','Disabled'=>'Disabled'], $chiller->status ?? 'Approved', ['class' => 'form-control form-select' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required', 'id' => 'status']) }}
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('chiller_maximum_capacity') }}
        {{ Form::number('chiller_maximum_capacity', $chiller->chiller_maximum_capacity, ['class' => 'form-control' . ($errors->has('chiller_maximum_capacity') ? ' is-invalid' : ''), 'placeholder' => 'Maximum Capacity','required']) }}
        {!! $errors->first('chiller_maximum_capacity', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('chiller_minimum_capacity') }}
        {{ Form::number('chiller_minimum_capacity', $chiller->chiller_minimum_capacity, ['class' => 'form-control' . ($errors->has('chiller_minimum_capacity') ? ' is-invalid' : ''), 'placeholder' => 'Minimum Capacity','required']) }}
        {!! $errors->first('chiller_minimum_capacity', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('chilled_water_flow') }}
        {{ Form::number('chilled_water_flow', $chiller->chilled_water_flow, ['class' => 'form-control' . ($errors->has('chilled_water_flow') ? ' is-invalid' : ''), 'placeholder' => 'Chilled Water Flow','required']) }}
        {!! $errors->first('chilled_water_flow', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-3 mb-3">
        {{ Form::label('partial_load_25','IPLV 25%') }}
        {{ Form::number('partial_load_25', $chiller->partial_load_25, ['class' => 'form-control' . ($errors->has('partial_load_25') ? ' is-invalid' : ''), 'placeholder' => 'IPLV 25%','required']) }}
        {!! $errors->first('partial_load_25', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-3 mb-3">
        {{ Form::label('partial_load_50','IPLV 50%') }}
        {{ Form::number('partial_load_50', $chiller->partial_load_50, ['class' => 'form-control' . ($errors->has('partial_load_50') ? ' is-invalid' : ''), 'placeholder' => 'IPLV 50%','required']) }}
        {!! $errors->first('partial_load_50', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-3 mb-3">
        {{ Form::label('partial_load_75','IPLV 75%') }}
        {{ Form::number('partial_load_75', $chiller->partial_load_75, ['class' => 'form-control' . ($errors->has('partial_load_75') ? ' is-invalid' : ''), 'placeholder' => 'IPLV 75%','required']) }}
        {!! $errors->first('partial_load_75', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-3 mb-3">
        {{ Form::label('partial_load_100','IPLV 100%') }}
        {{ Form::number('partial_load_100', $chiller->partial_load_100, ['class' => 'form-control' . ($errors->has('partial_load_100') ? ' is-invalid' : ''), 'placeholder' => 'IPLV 100%','required']) }}
        {!! $errors->first('partial_load_100', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>
