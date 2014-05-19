@extends('admin._layouts.default')

@section('main')

<h2 class = "left40"><i class="icon-pencil"></i> Edit subject</h2>

@include('admin._partials.notifications')

<?php function set_selected($desired_value, $new_value){if($desired_value==$new_value){echo ' selected="selected"';}}?>

	{{ Form::model($subject, array('method' => 'post', 'route' => array('admin.subjects.update', $subject->id), 'files' => true)) }}

		<div class="col-md-3">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $title }}">
            </div>
		
            <div class="form-group">
                <label for="semester">Which semester?</label>
                <select class="form-control" id="semester" name="semester">
                    <option value = "0" <?php set_selected('0', $semester); ?>>Winter</option>
                    <option value = "1" <?php set_selected('1', $semester); ?>>Summer</option>
                </select>  
            </div>

            <div class="form-group">
                <label for="visible">Invisible?</label>
                <select class="form-control" id="visible" name="visible">
                    <option value = "0" <?php set_selected('0', $visible); ?>>no</option>
                    <option value = "1" <?php set_selected('1', $visible); ?>>yes</option>
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
