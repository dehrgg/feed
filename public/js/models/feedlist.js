/**
 * Model representing a list of RSS Feeds
 */
app.models.Feedlist = Backbone.Model.extend({

	initialize: function(){
		if (!this.has('pins')){
			this.set('pins', this.createCollection());
		}
	},

	parse: function(){
		var data = Backbone.Model.prototype.parse.apply(this, arguments);
		var pins = data.pins;
		if (pins) {
			data.pins = this.createCollection(pins);
		}
		return data;
	},

	validate: function(attrs, options){
		var errors = {};
		if (!(attrs.name && attrs.name.length)){
			errors.name = "Name is required";
		}
		for (var prop in errors){
			return errors;
		}
	},

	addFeed: function(feed){
		return this.get('pins').add(feed);
	},

	createFeed: function(feed){
		return this.get('pins').create(feed);
	},

	createCollection: function(data){
		return new app.collections.FeedlistFeeds(data, { list: this });
	}
});

/**
 * Collection of Feedlists belonging to the authenticated user
 */
app.collections.Feedlist = Backbone.Collection.extend({

	model: app.models.Feedlist,

	url: function(){
		return app.rootUrl + '/lists';
	}
});

