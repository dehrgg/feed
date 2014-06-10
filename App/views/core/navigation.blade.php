<nav class="navbar navbar-default main-nav" role="navigation">
 		<div class="navbar-header">
 			<a href="{{ $_ENV['PARENT_ROOT'] }}"><img class="dg-logo" src="{{ asset('img/brand.png') }}"></a>
 			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
      		</button>
 		</div>
 		<div class="collapse navbar-collapse" id="nav-collapse">
	 		<ul class="nav navbar-nav">
	 			<li>
	 				<a href="{{ $_ENV['PARENT_ROOT'] }}#about">About</a>
	 			</li>
	 			<li class="{{{ $active === 'portfolio' ? 'active' : '' }}}">
	 				<a href="{{ $_ENV['PARENT_ROOT'] }}#projects">Projects</a>
	 			</li>
	 			<li>
	 				<a href="{{ $_ENV['PARENT_ROOT'] }}#resume">Resume</a>
	 			</li>
	 		</ul>
 		</div>
</nav>