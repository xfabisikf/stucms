@extends('admin._layouts.default')
 
@section('main')

    <h2 class = "left40"><i class="icon-pencil"></i> Edit moderator</h2>

    @include('admin._partials.notifications')

    {{ Form::model($user, array('method' => 'post', 'route' => array('admin.users.update', $user->id))) }}

    <div class="col-md-3">

        <div class="form-group">
            <label for="password">New password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm new password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter password again">
        </div>

        <div class="form-group">
            <label for="activated">Active user?</label>
            <select class="form-control" id="activated" name="activated">
                <option value = "0">no</option>
                <option value = "1">yes</option>
            </select>
        </div>
    </div>
    <div class = "col-md-2 col-md-offset-10 up15 mbottom15">
        <div class="form-actions">
                {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
            <a href="{{ URL::route('admin.users.index') }}" class="btn btn-large">Cancel</a>
        </div>
    </div>

    {{ Form::close() }}
 
@stop