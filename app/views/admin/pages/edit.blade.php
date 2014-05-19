@extends('admin._layouts.default')
 
@section('main')

<h2 class = "left40"><i class="icon-pencil"></i> Edit page</h2>

@include('admin._partials.notifications')

<?php function set_selected($desired_value, $new_value){if($desired_value==$new_value){echo ' selected="selected"';}}?>

    {{ Form::model($page, array('method' => 'post', 'route' => array('admin.pages.update', $page->id))) }}

        <div class="col-md-3">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $title }}">
            </div>

            <div class="form-group">
                <label for="menu">In navigation?</label>
                <select class="form-control" id="menu" name="menu">
                    <option value = "0" <?php set_selected('0', $menu); ?>>no</option>
                    <option value = "1" <?php set_selected('1', $menu); ?>>yes</option>
                </select>
            </div>
            @if (Sentry::getUser()->permissions == 1)
            <div class="form-group">
                <label for="solid">Non-deletable page?</label>
                <select class="form-control" id="solid" name="solid">
                    <option value = "0" <?php set_selected('0', $solid); ?>>no</option>
                    <option value = "1" <?php set_selected('1', $solid); ?>>yes</option>
                </select>
            </div>

            <div class="form-group">
                <label for="edit">Non-editable page?</label>
                <select class="form-control" id="edit" name="edit">
                    <option value = "0" <?php set_selected('0', $edit); ?>>no</option>
                    <option value = "1" <?php set_selected('1', $edit); ?>>yes</option>
                </select>
            </div>
            @endif
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
                <a href="{{ URL::route('admin.pages.index') }}" class="btn btn-large">Cancel</a>
            </div>
        </div>

    {{ Form::close() }}
 
@stop