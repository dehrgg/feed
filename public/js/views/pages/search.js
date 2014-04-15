app.views.Search = Backbone.View.extend({
	
	subViews: {},

	events: {
		"keydown #query": "searchOnEnter"
	},

	initialize: function(opts) {
		this.feedProvider = opts.feedProvider || GoogleFeedProvider;
		this.collection = new app.collections.UserFeeds();
		this.listenTo(this.collection, 'add', this.createResult);
		this.listenTo(this.collection, 'remove', this.removeResult);
	},

	render: function(){
		var query = this.$('#query').val().trim();
		if (query != this.query) {
			this.clearResults();
			this.query = query;
			if (query.length > 0) {
				this.feedProvider.findFeeds(query, $.proxy(this.queryResponse, this));
			}
		}
		return this;
	},

	queryResponse: function(result) {
		if (result.error) {

		}
		else {
			this.collection.set(result.data);
			// _.each(result.data, this.createResult, this);
		}
	},

	createResult: function(model){
		var feedResult = new app.views.Feed({
			template: app.templates.searchresult,
			model: model
		});
		this.bubble(feedResult);
		this.subViews[model.cid] = feedResult;
		this.$("#results").append(feedResult.render().el);
	},

	removeResult: function(model){
		this.subViews[model.cid].close();
		delete this.subViews[model.cid];
	},

	searchOnEnter: function(evt) {
		if (evt.keyCode == 13) {
			this.render();
		}
	},

	clearResults: function() {
		_.each(this.subViews, function(view){
			view.close();
		});
		this.subViews.length = 0;
	},

	setProvider: function(feedProvider){
		this.feedProvider = feedProvider;
	}
});


