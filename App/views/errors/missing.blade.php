@extends('core.page')

@section('content')
	<div class="row">
		<span class="col-xs-12 col-md-6">
			<h2><code class="error-page-code center-block" style="text-align:center;">404 - Page not found</code></h2>
			<p class ="lead">A team of experts are working to find this page!
			<br>In the meantime - use the navigation to find your way back.
			</p>
			<p>
			If a bad link brought you here <a href="mailto:dylan@dehrg.com"> let me know </a>
			</p>
		</span>
		<img src="{{ asset('img/dog.jpg') }}" class="img-responsive dog-img col-xs-12 col-md-6">
	</div>
@stop