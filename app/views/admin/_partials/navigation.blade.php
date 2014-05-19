@if (Sentry::check())
<ul class="nav navbar-nav navbar-left">
	<li class="{{ Request::is('admin/pages*') ? 'active' : null }}"><a href="{{ URL::route('admin.pages.index') }}"><i class="icon-file"></i> Pages</a></li>
	<li class="{{ Request::is('admin/subjects*') ? 'active' : null }}"><a href="{{ URL::route('admin.subjects.index') }}"><i class="icon-edit"></i> Subjects</a></li>
	@if (Sentry::getUser()->permissions == 1)
		<li class="{{ Request::is('admin/users*') ? 'active' : null }}"><a href="{{ URL::route('admin.users.index') }}"><i class="icon-user"></i> Moderators</a></li>
		<li class="{{ Request::is('admin/settings*') ? 'active' : null }}"><a href="{{ URL::route('admin.settings') }}"><i class="icon-cog"></i> Settings</a></li>
	@endif
	<li><a class="{{ Request::is('page.index*') ? 'active' : null }}" href = "{{ URL::route('page.index') }}" target="_blank"><i class="icon-eye-open"></i> Frontend</a></li>
	<li class="{{ Request::is('admin/about*') ? 'active' : null }}"><a href="#about" data-toggle = "modal"><i class="icon-info-sign"></i> About</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
	<li><a href="{{ URL::route('admin.logout') }}"><i class="icon-lock"></i> Logout</a></li>
</ul>
@endif