app.views.FeedIndex = app.views.PreRenderedList.extend({

	modelAttributes: {
		url: {
			select: '.feed-item--url',
		},
		name: {
			select: '.feed-item--name',
			getter: 'text'
		},
		color: {
			select: '.feed-item--color',
		},
		id: {
			select: '.feed-item--id',
			integer: true
		}
	},

	itemSelector: app.selectors.feedItem,

	subViews: {},

	initialize: function(opts) {
		this.collection = new app.collections.UserFeeds();
		app.views.PreRenderedList.prototype.initialize.apply(this, arguments);
		this.listenTo(this.collection, 'add', this.feedAdded);
		this.listenTo(this.collection, 'remove', this.feedRemoved);
	},

	newItemView: function(model, el){
		var item = new app.views.Feed({
			template: app.templates.saved,
			model: model,
			el: el
		});
		this.bubble(item);
		this.subViews[model.id] = item;
		return item;
	},

	feedAdded: function(model){

	},

	feedRemoved: function(model){
		this.subViews[model.id].close();
		delete this.subViews[model.id];
		this.checkEmptyMessage();
	}
});

app.views.Feed = Backbone.View.extend({

	initialize: function(opts){
		this.template = opts.template;
		this.listenTo(this.model, 'change', this.render);
	},

	events: {
		'click :button[data-usr-action="pin"]': 'pinFeed',
		// 'click .expand-feed': 'previewFeed',
		'click :button[data-usr-action="addlist"]': 'openPicklist',
		'click .btn-list-remove': 'unpinFeed',
		'click :button[data-usr-action="edit"]': 'editPin'
	},

	render: function() {
		var content = this.template.render(this.model.toJSON());
		if (this.isEmpty()) {
			this.setElement(content);
		}
		else {
			this.$el.html($(content).html());
		}
		return this;
	},

	pinFeed: function() {
		this.model.set({'name': app.stripHTML(this.model.get('name'))});
		app.setAjaxMessage('Pinning feed');
		this.model.save().done($.proxy(this.pinComplete, this));
	},

	unpinFeed: function() {
		this.model.destroy({wait: true});
	},

	pinComplete: function(data){
		if (data.status == 'success') {
			alert('Feed pinned successfully');
		}
		else if (data.status == 'error') {
			alert(data.message);
		}
	},

	openPicklist: function(){
		this.trigger('request.picklist', $.proxy(this.addToLists, this));
	},

	addToLists: function(lists){
		_.each(lists, function(list){
			var feedCopy = new app.models.Feed({
				url: this.model.get('url'),
				name: app.stripHTML(this.model.get('name'))
			});
			list.createFeed(feedCopy);
		}, this);
	},

	editPin: function(){
		this.trigger('pin.edit', this.model);
	}
});