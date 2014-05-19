@include('site._partials/header')

<article>
	<h2>{{ $page->title }}</h2>
	{{ $page->body }}
</article>

@include('site._partials/footer')
