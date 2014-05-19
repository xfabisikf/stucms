@extends('admin._layouts.default')

@section('main')

	<h2 class = "left40"><i class="icon-plus"></i> Create new subject</h2>

	@include('admin._partials.notifications')

	{{ Form::open(array('route' => 'admin.subjects.store', 'files' => true)) }}

		<div class="col-md-3">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
            </div>

            <div class="form-group">
                <label for="semester">Which semester?</label>
                <select class="form-control" id="semester" name="semester">
                    <option value = "0">Winter</option>
                    <option value = "1">Summer</option>
                </select>  
            </div>

            <div class="form-group">
                <label for="visible">Invisible?</label>
                <select class="form-control" id="visible" name="visible">
                    <option value = "0">no</option>
                    <option value = "1">yes</option>
                </select>  
            </div>
		</div>

         <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('body', 'Content') }}
                <div class="controls">
                    {{ Form::textarea('body') }}
                </div>
            </div>
        </div>

        <div class = "col-md-2 col-md-offset-10 up15 mbottom15">
            <div class="form-actions">
                {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
                <a href="{{ URL::route('admin.subjects.index') }}" class="btn btn-large">Cancel</a>
            </div>
        </div>

	{{ Form::close() }}

@stop
