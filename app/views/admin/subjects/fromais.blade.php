@extends('admin._layouts.default')

@section('main')

	<h2 class = "left40"><i class="icon-info-sign"></i> Select Subjects from AIS:</h2>

	@include('admin._partials.notifications')

    <?php $i=0; $w='W'; $s='S'?>

    <form action="{{ URL::route('admin.subjects.setsub') }}" method="POST">
        <h3 class="col-md-6 left40">Winter semester:</h3>
        <h3 class="col-md-6">Summer semester:</h3>
        <div class="col-md-6 left40">
		@foreach ($domW->getElementsByTagName('a') as $link)
            <?php 
                $find = strpos($link->getAttribute('href'), 'syllabus');
                $i++;
            ?>
            @if($find !== false)
                <input type="checkbox" name="{{ 'name'.$i }}" value="{{ $link->getAttribute('href').'@'.$link->nodeValue.'@'.$w }}"> {{ $link->nodeValue }}<br>
            @endif
        @endforeach
        </div>
        <div class="col-md-6">
        @foreach ($domS->getElementsByTagName('a') as $link)
            <?php 
                $find = strpos($link->getAttribute('href'), 'syllabus');
                $i++;
            ?>
            @if($find !== false)
                <input type="checkbox" name="{{ 'name'.$i }}" id="href" value="{{ $link->getAttribute('href').'@'.$link->nodeValue.'@'.$s }}"> {{ $link->nodeValue }}<br>
            @endif
        @endforeach
        </div>
        <div class="col-md-11 col-md-offset-1">&nbsp;</div>
        <div class="col-md-11 col-md-offset-1">&nbsp;</div>
        <div class="col-md-8 col-md-offset-4 left40">
            {{ Form::submit('Get subjects', array('class' => 'btn btn-success btn-save btn-lg')) }}
            <a class = "btn btn-default btn-lg" href = "{{ URL::route('admin.subjects.index') }}">Cancel</a>
        </div><br><br>
	</form>

@stop
