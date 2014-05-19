<div class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<a href="{{ URL::route('admin.pages.index') }}" class = "navbar-brand"><span class = "imgColor1">STU</span> CMS<span class = "imgColor1">imple</span></a>
		<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
			<span class = "icon-bar"></span>
			<span class = "icon-bar"></span>
			<span class = "icon-bar"></span>
		</button>
		<div class = "collapse navbar-collapse navHeaderCollapse">

		@include('admin._partials.navigation')

		</div>	
	</div>
</div>


