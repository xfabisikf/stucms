@extends('admin._layouts.default')

@section('main')

    <h1 class = "left40">
    	<i class="icon-cog"></i> Settings
    </h1><br>
    
    <?php function set_selected($desired_value, $new_value){if($desired_value==$new_value){echo ' selected="selected"';}}?>

    {{ Notification::showAll() }}

    {{ Form::open(array('method' => 'post', 'route' => 'admin.settings.depart')) }}
    	<div class="col-md-12">
	    	<div class="col-md-5">
				<div class="form-group">
		            <label for="depart">Department of faculty?</label>
		            <select class="form-control" id="depart" name="depart">
		            	<option value = "0" <?php set_selected('0', $depart); ?>>All departments</option>
		                <option value = "21030642" <?php set_selected('21030642', $depart); ?>>Department of Automobile Mechatronics</option>
		                <option value = "21030548" <?php set_selected('21030548', $depart); ?>>Department of Electroenergetics and Applied Electrotechnics</option>
		                <option value = "21030549" <?php set_selected('21030549', $depart); ?>>Department of Electronics and Photonics</option>
		                <option value = "21030550" <?php set_selected('21030550', $depart); ?>>Department of Electrical Engineering</option>
		                <option value = "21030816" <?php set_selected('21030816', $depart); ?>>Department of Informatics and Mathematics</option>
		                <option value = "21030817" <?php set_selected('21030817', $depart); ?>>Department of Nuclear Science and Physical Engineering</option>
		                <option value = "21030356" <?php set_selected('21030356', $depart); ?>>Department of Robotics and Cybernetics</option>
		                <option value = "21030818" <?php set_selected('21030818', $depart); ?>>Department of Telecommunications</option>
		            </select>
		        </div>
		    
	        {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
	    	</div>
	    	<div class = "col-md-5 col-md-offset-1 alert alert-warning">
	    		<p>The system uses this selection to know which department 
				it's supposed to look in to get the subjects from Academic information system.</p>
	    	</div>
	    </div>

	{{ Form::close() }}

	{{ Form::open(array('method' => 'post', 'route' => 'admin.settings.style')) }}
		<div class="col-md-12 up35 mbottom15">
	    	<div class="col-md-5">
				<div class="form-group">
		            <label for="style">Change cascading styles of Frontend?</label>
		            <select class="form-control" id="style" name="style">
		            	@foreach($styles as $style)
							<option value="{{ ('/site/assets/css').'/'.$style }}" <?php set_selected($style, $styler); ?>>{{ $style }}</option>
						@endforeach
		            </select>
		        </div>
		    
	        {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
	    	</div>
	    	<div class = "col-md-5 col-md-offset-1 alert alert-warning">
	    		<p>The system uses this selection to view custom cascading style of his frontend.
	    		<span class="italic">(Copy your style.css in the folder 'public/site/assets/css' shaped 'yourstyle.css')</span></p>
	    	</div>
    	</div>

	{{ Form::close() }}
@stop