@include('site._partials/header')

<article>
	<h2>{{ $subject->title }}</h2>
	{{ $subject->body }}
</article>

@include('site._partials/footer')
