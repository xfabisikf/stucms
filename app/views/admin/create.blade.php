<?php use \App\Models\User; if(User::find(1)) { Redirect::route('admin.login'); }?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>STU CMSimple</title>

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
					<span class = "imgColor1 left">STU</span><span class = "left"> CMS</span>&nbsp;<span class = "imgColor1 left">imple</span><span class = "right">SIGN UP!</span>
				</div>
				<div class = "modal-body">
					@include('admin._partials.notifications')

					<div class = "col-lg-12 alert alert-warning">
			    		<p>Please sign up your administrator account in the following form</p>
			    	</div>

					{{ Form::open(array('route' => 'admin.store')) }}

				        <div class="form-group">
				            <label for="email" class = "col-lg-2 control-label">Email</label>
				            <div class = "col-lg-10">
				            	<input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
				            </div>
				        </div>

				        <div class="form-group">
				            <label for="password" class = "col-lg-2 control-label">Password</label>
				            <div class = "col-lg-10">
				            	<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
				            </div>
				        </div>

				        <div class="form-group">
				            <label for="password_confirmation" class = "col-lg-2 control-label">Confirm</label>
				            <div class = "col-lg-10">
				            	<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter password again">
				            </div>
				        </div>

					    <div class = "col-lg-2 col-md-offset-4 left20">
					        <div class="form-actions">
					               {{ Form::submit('Continue', array('class' => 'btn btn-success btn-save btn-lg')) }}
					        </div>
					    </div>
					    <div class="col-12">&nbsp;</div>
					    <div class="col-12">&nbsp;</div>

				    {{ Form::close() }}
				</div>
			</div>	
		</div>
	</div>


</body>
</html>