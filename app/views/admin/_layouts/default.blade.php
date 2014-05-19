<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Back office</title>
	<script type="text/javascript" src="{{ URL::asset('tinymce/tinymce.min.js') }}"></script>
	<script type="text/javascript">
	tinymce.init({
	    selector: "textarea",
	    theme: "modern",
	    plugins: [
	         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
	         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	         "save table contextmenu directionality emoticons template paste textcolor"
	   ],
	   content_css: "css/content.css",
	   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor", 
	   style_formats: [
	        {title: 'Bold text', inline: 'b'},
	        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
	        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
	        {title: 'Example 1', inline: 'span', classes: 'example1'},
	        {title: 'Example 2', inline: 'span', classes: 'example2'},
	        {title: 'Table styles'},
	        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	    ]
	}); 
	</script>

	<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/main.css') }}" rel="stylesheet">

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/script.js') }}"></script>

</head>
<body>
@include('admin._partials.header')
<div class = "container">
	<div class = "row">
		<div class = "panel panel-default">
			<div class = "panel-body">
	
			@yield('main')

			</div>
		</div>
	</div>
</div>
@include('admin._partials.about-modal')
</body>
</html>
