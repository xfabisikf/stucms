@extends('admin._layouts.default')

@section('main')

    <h1 class = "left40">
        <i class="icon-file"></i> Pages&nbsp;&nbsp;&nbsp;<a href="{{ URL::route('admin.pages.create') }}" class="btn btn-success"><i class="icon-plus-sign"></i> Add new page</a>
    </h1>

    <hr>

    {{ Notification::showAll() }}

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#
                    <a href="{{ URL::route('admin.pages.index', array('orderby' => 'id', 'ord' => 'asc')) }}"><i class="icon-chevron-up"></i></a>
                    <a href="{{ URL::route('admin.pages.index', array('orderby' => 'id', 'ord' => 'desc')) }}"><i class="icon-chevron-down"></i></i></a>
                </th>
                <th>Title
                    <a href="{{ URL::route('admin.pages.index', array('orderby' => 'title', 'ord' => 'asc')) }}"><i class="icon-chevron-up"></i></a>
                    <a href="{{ URL::route('admin.pages.index', array('orderby' => 'title', 'ord' => 'desc')) }}"><i class="icon-chevron-down"></i></a>
                </th>
                <th>When
                    <a href="{{ URL::route('admin.pages.index', array('orderby' => 'created_at', 'ord' => 'asc')) }}"><i class="icon-chevron-up"></i></a>
                    <a href="{{ URL::route('admin.pages.index', array('orderby' => 'created_at', 'ord' => 'desc')) }}"><i class="icon-chevron-down"></i></a>
                </th>
                <th><i class="icon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($pages as $page)
            <tr>
                <td class="col-md-1">{{ $page->id }}</td>
                <td class="col-md-6"><a href="{{ URL::route('admin.pages.show', $page->id) }}">{{ $page->title }}</a></td>
                <td class="col-md-3">{{ $page->created_at }}</td>
                <td class="col-md-2">
                        
                    @if ($page->edit == 1)
                        @if (Sentry::getUser()->permissions == 1)
                            <a href="{{ URL::route('admin.pages.edit', $page->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
                        @else
                            <a href="{{ URL::route('admin.pages.edit', $page->id) }}" class="btn btn-success btn-mini pull-left" disabled>Edit</a>
                        @endif
                    @else
                        <a href="{{ URL::route('admin.pages.edit', $page->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
                    @endif

                    @if ($page->solid == 1)
                        
                        @if (Sentry::getUser()->permissions == 1)
                            {{ Form::open(array('route' => array('admin.pages.destroy', $page->id), 'method' => 'post', 'data-confirm' => 'Are you sure?')) }}
                                <div class="left">
                                <button type="submit" href="{{ URL::route('admin.pages.destroy', $page->id) }}" class="btn btn-danger btn-mini">Delete</button>
                                </div>
                                <div class="left iconspec">
                                @if ($page->menu == 1)
                                <i class="icon-list"></i>
                                @endif 
                                </div>

                            {{ Form::close() }}
                        @else
                            <div class="left">
                            <button type="submit" href="{{ URL::route('admin.pages.destroy', $page->id) }}" class="btn btn-danger btn-mini" disabled>Delete</button>
                            </div>
                            <div class="left iconspec">
                            @if ($page->menu == 1)
                            <i class="icon-list"></i>
                            @endif 
                            </div>
                        @endif
                    @else
                        {{ Form::open(array('route' => array('admin.pages.destroy', $page->id), 'method' => 'post', 'data-confirm' => 'Are you sure?')) }}
                            <div class="left">
                            <button type="submit" href="{{ URL::route('admin.pages.destroy', $page->id) }}" class="btn btn-danger btn-mini">Delete</button>
                            </div>
                            <div class="left iconspec">
                            @if ($page->menu == 1)
                            <i class="icon-list"></i>
                            @endif 
                            </div>
                        {{ Form::close() }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop
