@extends('admin._layouts.default')

@section('main')
	<h2>Display subject</h2>

	<hr>

	<h3>{{ $subject->title }}</h3>
	<h5>{{ $subject->created_at }}</h5>
	{{ $subject->body }}

@stop
