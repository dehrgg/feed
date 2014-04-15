@extends('core.page')

@section('content')

<div class="row">
	<form class="form-horizontal col-sm-10 col-md-8" action="{{{ asset('user/'.$id) }}}" method="POST">
		
		<input type="hidden" name="_method" value="PUT">
		@if (isset($wasUpdated) && $wasUpdated)
		<div class="form-group">
			<div class="label label-success col-sm-offset-4">
				Password successfully changed
			</div>
		</div>
		@endif
		<div class="form-group @iferrors('email') has-error @endif">
			<label for="email" class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="email" name="email" readonly value="{{{ $email }}}">
			</div>
		</div>

		<div class="form-group @iferrors('old-password') has-error @endif">
			<label for="password" class="col-sm-4 control-label">Existing Password</label>
			<div class="col-sm-8">
				<input type="password" class="form-control" id="old-password" name="old-password" placeholder="Enter current password">
			</div> 
			<span class="help-block col-sm-8 col-sm-offset-4 @unlesserrors('old-password') hidden @endunless"> 
				{{{ $errors->first('old-password') }}} 
			</span> 
		</div>		
		
		<div class="form-group @iferrors('password') has-error @endif">
			<label for="password" class="col-sm-4 control-label">New Password</label>
			<div class="col-sm-8">
				<input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
			</div> 
			<span class="help-block col-sm-8 col-sm-offset-4 @unlesserrors('password') hidden @endunless"> 
				{{{ $errors->first('password') }}} 
			</span> 
		</div>

		<div class="form-group">
			<label for="confirm" class="col-sm-4 control-label">Confirm Password</label>
			<div class="col-sm-8">
				<input type="password" class="form-control" id="confirm" name="password_confirmation" placeholder="Confirm new password">
			</div> 
		</div>

		<div class="form-group">
			<div class="col-sm-4 col-sm-offset-4">
				<input type="submit" class="btn btn-primary" value ="Change Password">
			</div>
		</div>
	</form>
</div>
	
@stop
