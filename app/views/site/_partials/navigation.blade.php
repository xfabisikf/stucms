<nav id="nav">
	<ul>
		<?php $i=0;?>
		@foreach ($pages as $page)

		@if($page->menu == 1)
		<?php $i++ ?>
			@if($i == 2)
			<li><a href="{{ URL::route('site.subjects') }}">Predmety</a></li>
			@endif
		<li><a href="{{ URL::route('page.show', array($page->id, $page->slug)) }}">{{ $page->title }}</a></li>
		
		@endif

		@endforeach
	</ul>
</nav>
