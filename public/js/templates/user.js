app.templates = app.templates || {};

app.templates['edit-user.blade'] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("@extends('core.page')\r");_.b("\n" + i);_.b("\r");_.b("\n" + i);_.b("@section('content')\r");_.b("\n" + i);_.b("\r");_.b("\n" + i);_.b("<div class=\"row\">\r");_.b("\n" + i);_.b("	<form class=\"form-horizontal col-sm-10 col-md-8\" action=\"");_.b(_.t(_.d("asset('user/'.$id)",c,p,0)));_.b("\" method=\"POST\">\r");_.b("\n" + i);_.b("		\r");_.b("\n" + i);_.b("		<input type=\"hidden\" name=\"_method\" value=\"PUT\">\r");_.b("\n" + i);_.b("		@if (isset($wasUpdated) && $wasUpdated)\r");_.b("\n" + i);_.b("		<div class=\"form-group\">\r");_.b("\n" + i);_.b("			<div class=\"label label-success col-sm-offset-4\">\r");_.b("\n" + i);_.b("				Password successfully changed\r");_.b("\n" + i);_.b("			</div>\r");_.b("\n" + i);_.b("		</div>\r");_.b("\n" + i);_.b("		@endif\r");_.b("\n" + i);_.b("		<div class=\"form-group @iferrors('email') has-error @endif\">\r");_.b("\n" + i);_.b("			<label for=\"email\" class=\"col-sm-4 control-label\">Email</label>\r");_.b("\n" + i);_.b("			<div class=\"col-sm-8\">\r");_.b("\n" + i);_.b("				<input type=\"text\" class=\"form-control\" id=\"email\" name=\"email\" readonly value=\"");_.b(_.t(_.f("$email",c,p,0)));_.b("\">\r");_.b("\n" + i);_.b("			</div>\r");_.b("\n" + i);_.b("		</div>\r");_.b("\n" + i);_.b("\r");_.b("\n" + i);_.b("		<div class=\"form-group @iferrors('old-password') has-error @endif\">\r");_.b("\n" + i);_.b("			<label for=\"password\" class=\"col-sm-4 control-label\">Existing Password</label>\r");_.b("\n" + i);_.b("			<div class=\"col-sm-8\">\r");_.b("\n" + i);_.b("				<input type=\"password\" class=\"form-control\" id=\"old-password\" name=\"old-password\" placeholder=\"Enter current password\">\r");_.b("\n" + i);_.b("			</div> \r");_.b("\n" + i);_.b("			<span class=\"help-block col-sm-8 col-sm-offset-4 @unlesserrors('old-password') hidden @endunless\"> \r");_.b("\n" + i);_.b("				");_.b(_.t(_.f("$errors->first('old-password')",c,p,0)));_.b(" \r");_.b("\n" + i);_.b("			</span> \r");_.b("\n" + i);_.b("		</div>		\r");_.b("\n" + i);_.b("		\r");_.b("\n" + i);_.b("		<div class=\"form-group @iferrors('password') has-error @endif\">\r");_.b("\n" + i);_.b("			<label for=\"password\" class=\"col-sm-4 control-label\">New Password</label>\r");_.b("\n" + i);_.b("			<div class=\"col-sm-8\">\r");_.b("\n" + i);_.b("				<input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" placeholder=\"Enter new password\">\r");_.b("\n" + i);_.b("			</div> \r");_.b("\n" + i);_.b("			<span class=\"help-block col-sm-8 col-sm-offset-4 @unlesserrors('password') hidden @endunless\"> \r");_.b("\n" + i);_.b("				");_.b(_.t(_.f("$errors->first('password')",c,p,0)));_.b(" \r");_.b("\n" + i);_.b("			</span> \r");_.b("\n" + i);_.b("		</div>\r");_.b("\n" + i);_.b("\r");_.b("\n" + i);_.b("		<div class=\"form-group\">\r");_.b("\n" + i);_.b("			<label for=\"confirm\" class=\"col-sm-4 control-label\">Confirm Password</label>\r");_.b("\n" + i);_.b("			<div class=\"col-sm-8\">\r");_.b("\n" + i);_.b("				<input type=\"password\" class=\"form-control\" id=\"confirm\" name=\"password_confirmation\" placeholder=\"Confirm new password\">\r");_.b("\n" + i);_.b("			</div> \r");_.b("\n" + i);_.b("		</div>\r");_.b("\n" + i);_.b("\r");_.b("\n" + i);_.b("		<div class=\"form-group\">\r");_.b("\n" + i);_.b("			<div class=\"col-sm-4 col-sm-offset-4\">\r");_.b("\n" + i);_.b("				<input type=\"submit\" class=\"btn btn-primary\" value =\"Change Password\">\r");_.b("\n" + i);_.b("			</div>\r");_.b("\n" + i);_.b("		</div>\r");_.b("\n" + i);_.b("	</form>\r");_.b("\n" + i);_.b("</div>\r");_.b("\n" + i);_.b("	\r");_.b("\n" + i);_.b("@stop");return _.fl();;});
