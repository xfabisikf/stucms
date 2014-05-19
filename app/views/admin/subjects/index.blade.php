@extends('admin._layouts.default')

@section('main')

	<h1 class = "left40">
		<i class="icon-edit"></i> Subjects&nbsp;&nbsp;&nbsp;<a href="{{ URL::route('admin.subjects.create') }}" class="btn btn-success"><i class="icon-plus-sign"></i> Add new Subject</a>
		<a href="{{ URL::route('admin.subjects.getsub') }}" class="btn btn-success"><i class="icon-info-sign"></i> Add Subjects from AIS</a>
	</h1>

	<hr>

	{{ Notification::showAll() }}

	<table class="table table-striped">
		<thead>
			<tr>
				<th>#
                    <a href="{{ URL::route('admin.subjects.index', array('orderby' => 'id', 'ord' => 'asc')) }}"><i class="icon-chevron-up"></i></a>
                    <a href="{{ URL::route('admin.subjects.index', array('orderby' => 'id', 'ord' => 'desc')) }}"><i class="icon-chevron-down"></i></a>
                </th>
                <th>Title
                    <a href="{{ URL::route('admin.subjects.index', array('orderby' => 'title', 'ord' => 'asc')) }}"><i class="icon-chevron-up"></i></a>
                    <a href="{{ URL::route('admin.subjects.index', array('orderby' => 'title', 'ord' => 'desc')) }}"><i class="icon-chevron-down"></i></a>
                </th>
                <th>When
                    <a href="{{ URL::route('admin.subjects.index', array('orderby' => 'created_at', 'ord' => 'asc')) }}"><i class="icon-chevron-up"></i></a>
                    <a href="{{ URL::route('admin.subjects.index', array('orderby' => 'created_at', 'ord' => 'desc')) }}"><i class="icon-chevron-down"></i></a>
                </th>
                <th><i class="icon-cog margin20"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($subjects as $subject)
				<tr>
					<td class="col-md-1">{{ $subject->id }}</td>
					<td class="col-md-6"><a href="{{ URL::route('admin.subjects.show', $subject->id) }}">{{ $subject->title }}</a></td>
					<td class="col-md-2">{{ $subject->created_at }}</td>
					<td class="col-md-3">
						<div class="left">
						{{ Form::open(array('route' => array('admin.subjects.duplicate', $subject->id), 'method' => 'post')) }}
							<button type="submit" href="{{ URL::route('admin.subjects.duplicate', $subject->id) }}" class="btn btn-info btn-mini">Duplicate</button>
						{{ Form::close() }}
						</div class="left">
						<div>
						<a href="{{ URL::route('admin.subjects.edit', $subject->id) }}" class="btn btn-success btn-mini pull-left ">Edit</a>
						</div>
						<div class="left">
						{{ Form::open(array('route' => array('admin.subjects.destroy', $subject->id), 'method' => 'post', 'data-confirm' => 'Are you sure?')) }}
							<button type="submit" href="{{ URL::route('admin.subjects.destroy', $subject->id) }}" class="btn btn-danger btn-mini">Delete</button>
						{{ Form::close() }}
						</div>
						<div class="left iconspec">
						@if ($subject->visible == 1)
                            <i class="icon-eye-close"></i>
                        @elseif ($subject->visible == 0)
                        	<i class="icon-eye-open"></i>
                        @endif
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@stop
