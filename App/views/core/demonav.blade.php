<nav class="navbar navbar-default subnav" role="navigation">
 	<!-- <div class="container-fluid"> -->
 		<ol class="breadcrumb pull-left nav-breadcrumb">
  			<li><a href="{{ $_ENV['PARENT_ROOT'] }}">Home</a></li>
  			<li><a href="{{ $_ENV['PARENT_ROOT'] }}/portfolio/demos">Demos</a></li>
		  	<li class="active">Feed</li>
		</ol>
 		<div class="navbar-collapse collapse in">
	 		
	 		<div class="navbar-right">
				@if (Auth::check())
					<form class ="navbar-form navbar-right navbar-signout" action="{{ asset('/logout') }}" method="post">
						<a href="profile" class="navbar-link"> {{{ Auth::user()->email }}} </a>
						<button type="submit" class="btn btn-default"> Sign Out </button>
					</form>
				@else
				<p class="navbar-text">
					<a href="{{ asset('/login') }}" class="navbar-link"> Sign in </a>
					or <a href="{{ asset('/signup') }}" class="navbar-link"> Sign up </a>
				<p>
				@endif
			</div>
 		</div>
	<!-- </div> -->
</nav>