/**
 * Model to represent an individual RSS Feed
 */
app.models.Feed = Backbone.Model.extend({
	validate: function(attrs, options){
		var errors = {};
		if (!(attrs.name && attrs.name.length)){
			errors.name = "Name is required";
		}
		for (var prop in errors){
			return errors;
		}
	}
});

/**
 * A collection of Feeds belonging to a particular Feedlist
 */
app.collections.FeedlistFeeds = Backbone.Collection.extend({
	model: app.models.Feed,

	initialize: function(data, options){
		this.list = options.list;
	},

	url: function(){
		return this.list.url() + '/pins';
		// return this.list.url() + '/feeds';
	}
});

/**
 * A collection of Feeds belonging to the authenticated user
 */
app.collections.UserFeeds = Backbone.Collection.extend({
	url: function(){
		// return app.rootUrl + '/user/feeds';
		return app.rootUrl + '/pins';
	}
});