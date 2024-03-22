<div class="row">
	<div class="col-md-6">
        <div class="form-group mb-3">
            {{ Form::label('title') }}
            {{ Form::text('title', $blog->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title','required']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-3">
            {{ Form::label('description') }}
            {{ Form::textarea('description', $blog->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','required','rows'=>'6']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-6 mb-3">
        {{ Form::label('thumbnail') }}
        {{ Form::file('thumbnail', ['class' => 'form-control dropify' . ($errors->has('thumbnail') ? ' is-invalid' : ''), 'placeholder' => 'Thumbnail','required','accept' => 'image/png,image/jpg,image/jpeg','data-default-file' => isset($blog->thumbnail) ? $blog->thumbnail : '','data-height' => '223', isset($blog->thumbnail) ? '' : 'required']) }}
        {!! $errors->first('thumbnail', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('detail') }}
        {{ Form::textarea('detail', $blog->detail, ['class' => 'form-control' . ($errors->has('detail') ? ' is-invalid' : ''), 'placeholder' => 'Detail','required','id'=>'ckeditor']) }}
        {!! $errors->first('detail', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>