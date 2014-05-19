<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<script type="text/javascript" src="{{ URL::asset('tinymce/tinymce.min.js') }}"></script>

	<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/main.css') }}" rel="stylesheet">

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/script.js') }}"></script>
</head>
<body>
	<div class = "modal-dialog modal-dialog-login">
		<div class = "modal-content">
			<div class = "form-horizontal">
				<div class = "modal-header modal-header-login">
					<span class = "imgColor1 left">STU</span><span class = "left"> CMS</span>&nbsp;<span class = "imgColor1 left">imple</span><span class = "right">Login</span>
				</div>
				<div class = "modal-body">
					<br>
					{{ Form::open() }}
					@if ($errors->has('login'))
						<div class="alert alert-danger">{{ $errors->first('login', ':message') }}</div>
					@endif

					<div class = "form-group">
						<label for = "email" class = "col-lg-2 control-label">Email:</label>
						<div class = "col-lg-10">
							<input type = "text" class = "form-control" id = "email" name = "email" placeholder = "Email">
						</div>
					</div>

					<div class = "form-group">
						<label for = "password" class = "col-lg-2 control-label">Password:</label>
						<div class = "col-lg-10">
							<input type = "password" class = "form-control" id = "password" name = "password" placeholder = "Password">
						</div>
					</div>

					<div class = "modal-footer">
						<button class = "btn btn-primary" type = "submit">Login</button>
					</div>
					{{ Form::close() }}
				</div>
			</div>	
		</div>
	</div>


</body>
</html>