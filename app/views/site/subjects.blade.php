@include('site._partials/header')

<h2>Predmety</h2>

<hr>
<table class="Gtable">
	<thead>
		<tr>
			<td><h3>Zimný semester:</h3></td>
			<td><h3>Letný semester:</h3></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="Gtd">
			@foreach ($subjects as $subject)
				@if ($subject->semester == 0 && $subject->visible == 0)
					<a href="{{ ('/subjects/').$subject->id.'/'.$subject->slug }}" class="up3">{{ $subject->title }}</a><br>
				@endif
			@endforeach
			</td>
			<td class="Gtd">
			@foreach ($subjects as $subject)
				@if ($subject->semester == 1 && $subject->visible == 0)
					<a href="{{ ('/subjects/').$subject->id.'/'.$subject->slug }}">{{ $subject->title }}</a><br>
				@endif
			@endforeach
			</td>
		</tr>
	</tbody>
</table>
@include('site._partials/footer')
