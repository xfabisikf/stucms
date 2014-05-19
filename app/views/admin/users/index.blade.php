@extends('admin._layouts.default')

@section('main')

    <h1 class = "left40">
        <i class="icon-user"></i> Moderators&nbsp;&nbsp;&nbsp;<a href="{{ URL::route('admin.users.create') }}" class="btn btn-success"><i class="icon-plus-sign"></i> Add new moderator</a>
    </h1>

    <hr>

    {{ Notification::showAll() }}

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#
                    <a href="{{ URL::route('admin.users.index', array('orderby' => 'id', 'ord' => 'asc')) }}"><i class="icon-chevron-up"></i></a>
                    <a href="{{ URL::route('admin.users.index', array('orderby' => 'id', 'ord' => 'desc')) }}"><i class="icon-chevron-down"></i></i></a>
                </th>
                <th>Email
                    <a href="{{ URL::route('admin.users.index', array('orderby' => 'email', 'ord' => 'asc')) }}"><i class="icon-chevron-up"></i></a>
                    <a href="{{ URL::route('admin.users.index', array('orderby' => 'email', 'ord' => 'desc')) }}"><i class="icon-chevron-down"></i></a>
                </th>
                <th>When
                    <a href="{{ URL::route('admin.users.index', array('orderby' => 'created_at', 'ord' => 'asc')) }}"><i class="icon-chevron-up"></i></a>
                    <a href="{{ URL::route('admin.users.index', array('orderby' => 'created_at', 'ord' => 'desc')) }}"><i class="icon-chevron-down"></i></a>
                </th>
                <th><i class="icon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="col-md-1">{{ $user->id }}</td>
                <td class="col-md-5">{{ $user->email }}</a></td>
                <td class="col-md-4">{{ $user->created_at }}</td>
                <td class="col-md-2">
                    <div class="left">
                    <a href="{{ URL::route('admin.users.edit', $user->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
                    </div>
                    <div class="left">
                    {{ Form::open(array('route' => array('admin.users.destroy', $user->id), 'method' => 'post', 'data-confirm' => 'Are you sure?')) }}

                        <button type="submit" href="{{ URL::route('admin.users.destroy', $user->id) }}" class="btn btn-danger btn-mini">Delete</button>

                    {{ Form::close() }} 
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop