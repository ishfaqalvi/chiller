<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $contact->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('email') }}
        {{ Form::email('email', $contact->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email','required']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('phone') }}
        {{ Form::text('phone', $contact->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Phone','required']) }}
        {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('message') }}
        {{ Form::text('message', $contact->message, ['class' => 'form-control' . ($errors->has('message') ? ' is-invalid' : ''), 'placeholder' => 'Message','required']) }}
        {!! $errors->first('message', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>
