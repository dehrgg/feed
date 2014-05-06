@extends('core.page')

@section('content')

	<div class="col-md-6">
		<form class="form-horizontal" method="post">
			<div class="form-group">
				<label for="email" class="col-md-3 control-label">Email</label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="email" name="email">
				</div> 
			</div>
			@if ($errors->has('email'))
				<div class="row field-error">
					<div class="col-md-8 col-md-offset-4">
						<p class="bg-danger"> {{{ $errors->first('email') }}} </p>
					</div>
				</div>
			@endif
			<div class="form-group">
				<label for="password" class="col-md-3 control-label">Password</label>
				<div class="col-md-9">
					<input type="password" class="form-control" id="password" name="password">
				</div> 
			</div>
			@if ($errors->has('password'))
				<div class="row field-error">
					<div class="col-md-8 col-md-offset-4">
						<p class="bg-danger"> {{{ $errors->first('password') }}} </p>
					</div>
				</div>
			@endif
			<div class="form-group">	
				<div class="col-md-12 col-md-offset-3">
					<input type="submit" class="btn btn-primary" value ="Sign In">
					<a class="forgot" href="{{ action('App\Controllers\RemindersController@getRemind') }}">Forgot password?</a>
				</div>
			</div>
		</form>			
	</div>
	
@stop