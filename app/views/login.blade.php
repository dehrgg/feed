@extends('core.page')

@section('content')

	<div class="col-sm-6">
		<form class="form-horizontal" method="post">
			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" name="email">
				</div> 
			</div>
			@if ($errors->has('email'))
				<div class="row field-error">
					<div class="col-sm-8 col-sm-offset-4">
						<p class="bg-danger"> {{{ $errors->first('email') }}} </p>
					</div>
				</div>
			@endif
			<div class="form-group">
				<label for="password" class="col-sm-3 control-label">Password</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password" name="password">
				</div> 
			</div>
			@if ($errors->has('password'))
				<div class="row field-error">
					<div class="col-sm-8 col-sm-offset-4">
						<p class="bg-danger"> {{{ $errors->first('password') }}} </p>
					</div>
				</div>
			@endif
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-3">
					<input type="submit" class="btn btn-primary" value ="Sign In">
				</div>
			</div>
		</form>			
	</div>
	
@stop