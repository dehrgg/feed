@extends('core.page')

@section('content')
<form class="form-horizontal col-sm-8" action="{{ action('App\Controllers\RemindersController@postRemind') }}" method="post">

	@if(Session::has('status'))
	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-4">
			<span class="label label-success label-form"> {{{ Session::get('status') }}} </span>
		</div>
	</div>
	@endif	
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

	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-4">
			<input type="submit" class="btn btn-primary" value ="Send Reminder">
		</div>
	</div>	

</form>
@stop