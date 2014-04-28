<nav class="navbar navbar-default main-nav" role="navigation">
 	<div class="container-fluid">
 		<div class="navbar-header">
 			<a class="navbar-brand" href="{{ $_ENV['PARENT_ROOT'] }}"><strong>Dylan Gibbs</strong></a>
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
	 				<a href="{{ $_ENV['PARENT_ROOT'] }}">Home</a>
	 			</li>
	 			<li>
	 				<a href="{{ $_ENV['PARENT_ROOT'] }}/about">About</a>
	 			</li>
	 			<li class="{{{ $active === 'portfolio' ? 'active' : '' }}}">
	 				<a href="{{ $_ENV['PARENT_ROOT'] }}/portfolio">Portfolio</a>
	 			</li>
	 			<li>
	 				<a href="{{ $_ENV['PARENT_ROOT'] }}/portfolio">Resume</a>
	 			</li>
	 			<li>
	 				<a href="{{ $_ENV['PARENT_ROOT'] }}/contact">Contact</a>
	 			</li>
	 		</ul>
 		</div>
	</div>
</nav>