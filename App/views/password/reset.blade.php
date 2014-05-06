@extends('core.page')

@section('content')
<form class="form-horizontal col-sm-8" action="{{ action('App\Controllers\RemindersController@postReset') }}" method="POST">
	@if(Session::has('error'))
		<div class="form-group">
			<div class="col-sm-4 col-sm-offset-4">
				<span class="label label-danger label-form"> {{{ Session::get('error') }}} </span>
			</div>
		</div>
	@endif
	<div class="form-group @iferrors('email') has-error @endif">
		<label for="email" class="col-sm-4 control-label">Email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="email" name="email" placeholder="Enter email address">
		</div>
		<span class="help-block col-sm-8 col-sm-offset-4 @unlesserrors('email') hidden @endunless"> 
			{{{ $errors->first('email') }}} 
		</span> 
	</div>		
	
	<div class="form-group @iferrors('password') has-error @endif">
		<label for="password" class="col-sm-4 control-label">New Password</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
		</div> 
		<span class="help-block col-sm-8 col-sm-offset-4 @unlesserrors('password') hidden @endunless"> 
			{{{ $errors->first('password') }}} 
		</span> 
	</div>

	<div class="form-group">
		<label for="confirm" class="col-sm-4 control-label">Confirm Password</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" id="confirm" name="password_confirmation" placeholder="Confirm password">
		</div> 
	</div>

	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-4">
			<input type="submit" class="btn btn-primary" value ="Reset Password">
		</div>
	</div>
	<input type="hidden" name="token" value="{{ $token }}">
</form>
	
@stop
