app.templates = app.templates || {};

app.templates['form'] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<div class=\"pin-form\">\r");_.b("\n" + i);_.b("	<div class=\"form-group\">\r");_.b("\n" + i);_.b("		<label for=\"pin-name\" class=\"control-label\"> Display Name </label>\r");_.b("\n" + i);_.b("		<input type=\"text\" id=\"pin-name\" name=\"name\" value=\"");_.b(_.v(_.f("name",c,p,0)));_.b("\" class=\"form-control\">\r");_.b("\n" + i);_.b("	</div>\r");_.b("\n" + i);_.b("	<div class=\"form-group\">\r");_.b("\n" + i);_.b("		<label for=\"pin-color\" class=\"control-label\"> Color </label>\r");_.b("\n" + i);_.b("		<input type=\"color\" id=\"pin-color\" name=\"color\" value=\"");_.b(_.v(_.f("color",c,p,0)));_.b("\" class=\"form-control pin-color-input\">\r");_.b("\n" + i);_.b("	</div>	\r");_.b("\n" + i);_.b("</div>");return _.fl();;});
app.templates['picklistItem'] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<div class=\"checkbox picklist--item ");if(_.s(_.f("full",c,p,1),c,p,0,45,64,"{{ }}")){_.rs(c,p,function(c,p,_){_.b("picklist--item-full");});c.pop();}_.b("\">\r");_.b("\n" + i);_.b("	<label>\r");_.b("\n" + i);_.b("	  <input type=\"checkbox\"");if(_.s(_.f("full",c,p,1),c,p,0,121,129,"{{ }}")){_.rs(c,p,function(c,p,_){_.b("disabled");});c.pop();}_.b(">\r");_.b("\n" + i);_.b("	  <span class=\"picklist--list-name\">");_.b(_.v(_.f("name",c,p,0)));_.b("</span>\r");_.b("\n" + i);_.b("	  ");if(_.s(_.f("full",c,p,1),c,p,0,209,254,"{{ }}")){_.rs(c,p,function(c,p,_){_.b("<span class=\"label label-warning\">Full</span>");});c.pop();}_.b("\r");_.b("\n" + i);_.b("	</label>\r");_.b("\n" + i);_.b("	<input type=\"hidden\" class=\"picklist--list-id\" value=\"");_.b(_.v(_.f("id",c,p,0)));_.b("\">\r");_.b("\n" + i);_.b("</div>");return _.fl();;});
app.templates['saved'] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<div class=\"feed-item col-lg-11\">\r");_.b("\n" + i);_.b("	<div class=\"row\">\r");_.b("\n" + i);_.b("		<button class=\"pin-theme btn btn-default col-xs-6 col-sm-7 col-md-9\" style=\"border-color:");_.b(_.v(_.f("color",c,p,0)));_.b(";\">\r");_.b("\n" + i);_.b("			<div class=\"glyphicon glyphicon-chevron-down feed-item--title-btn pull-left\"></div>\r");_.b("\n" + i);_.b("			<div class=\"media-body\"> <h5 class=\"feed-item--name\">");_.b(_.v(_.f("name",c,p,0)));_.b("</h5> </div>\r");_.b("\n" + i);_.b("		</button>\r");_.b("\n" + i);_.b("		<input type=\"hidden\" value=\"");_.b(_.v(_.f("id",c,p,0)));_.b("\" class=\"feed-item--id\">\r");_.b("\n" + i);_.b("		<input type=\"hidden\" value=\"");_.b(_.v(_.d("feed.url",c,p,0)));_.b("\" class=\"feed-item--url\">\r");_.b("\n" + i);_.b("		<input type=\"hidden\" value=\"");_.b(_.v(_.f("color",c,p,0)));_.b("\" class=\"feed-item--color\">\r");_.b("\n" + i);_.b("		<div class=\"btn-group btn-group-borderless col-xs-6 col-sm-5 col-md-3 feed-item--btn-bar\">\r");_.b("\n" + i);_.b("			<button class=\"btn btn-default btn-md\" data-usr-action=\"addlist\">\r");_.b("\n" + i);_.b("				<span class=\"glyphicon glyphicon-add-list\"></span>\r");_.b("\n" + i);_.b("				<span class=\"sr-only\">Add to list</span>\r");_.b("\n" + i);_.b("			</button>\r");_.b("\n" + i);_.b("			<button class=\"btn btn-default btn-md\" data-usr-action=\"edit\">\r");_.b("\n" + i);_.b("				<span class=\"glyphicon glyphicon-pencil\"></span>\r");_.b("\n" + i);_.b("				<span class=\"sr-only\">Edit feed</span>\r");_.b("\n" + i);_.b("			</button>\r");_.b("\n" + i);_.b("			<button class=\"btn btn-default btn-md btn-list-remove\" data-usr-action=\"unpin\">\r");_.b("\n" + i);_.b("				<span class=\"glyphicon glyphicon-remove\"></span>\r");_.b("\n" + i);_.b("				<span class=\"sr-only\">Unpin Feed</span>\r");_.b("\n" + i);_.b("			</button>\r");_.b("\n" + i);_.b("		</div>\r");_.b("\n" + i);_.b("	</div>\r");_.b("\n" + i);_.b("</div>");return _.fl();;});
app.templates['searchresult'] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<div class=\"feed-item col-md-10 col-md-offset-1\">\r");_.b("\n" + i);_.b("	<p>\r");_.b("\n" + i);_.b("		<a href=\"");_.b(_.v(_.f("link",c,p,0)));_.b("\"> ");_.b(_.t(_.f("name",c,p,0)));_.b(" </a> \r");_.b("\n" + i);_.b("		<br><small> ");_.b(_.t(_.f("snippet",c,p,0)));_.b(" <small>\r");_.b("\n" + i);_.b("	</p>\r");_.b("\n" + i);_.b("	<div class=\"btn-group btn-group-borderless\">\r");_.b("\n" + i);_.b("		<button class=\"btn btn-default btn-md\" data-usr-action=\"addlist\">\r");_.b("\n" + i);_.b("			<span class=\"glyphicon glyphicon-add-list\"></span>\r");_.b("\n" + i);_.b("			<span class=\"sr-only\">Add to list</span>\r");_.b("\n" + i);_.b("		</button>\r");_.b("\n" + i);_.b("		<button class=\"btn btn-default btn-md\" data-usr-action=\"pin\">\r");_.b("\n" + i);_.b("			<span class=\"glyphicon glyphicon-pushpin\"></span>\r");_.b("\n" + i);_.b("			<span class=\"sr-only\">Pin</span>\r");_.b("\n" + i);_.b("		</button>\r");_.b("\n" + i);_.b("	</div<	\r");_.b("\n" + i);_.b("</div>");return _.fl();;});
app.templates['story'] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<a href=\"");_.b(_.v(_.f("link",c,p,0)));_.b("\" target=\"_blank\" class=\"story-item btn btn-default row col-xs-12 col-md-10 col-lg-9\">\r");_.b("\n" + i);_.b("	<h5 class=\"story-item--title pin-theme col-xs-10 col-md-11\" style=\"border-color:");_.b(_.v(_.d("pin.color",c,p,0)));_.b(";\">\r");_.b("\n" + i);_.b("		");_.b(_.v(_.f("title",c,p,0)));_.b("\r");_.b("\n" + i);_.b("		<br> <small> ");_.b(_.v(_.f("publishedDate",c,p,0)));_.b(" </small>\r");_.b("\n" + i);_.b("	</h5>\r");_.b("\n" + i);_.b("	<div class=\"col-xs-2 col-md-1 story-item--icon\">\r");_.b("\n" + i);_.b("		<span class=\"glyphicon glyphicon-chevron-right\"></span>	\r");_.b("\n" + i);_.b("	</div>	\r");_.b("\n" + i);_.b("</a>");return _.fl();;});
