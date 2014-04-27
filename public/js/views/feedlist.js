app.views.Feedlists = app.views.PreRenderedList.extend({

	events: {
		'click #btn-list-create': 'createList',
		'keydown #name-input': 'createOnEnter'
	},

	modelAttributes: {
		id: {
			select: '.feedlist-item--id'
		},
		name: {
			select: '.feedlist-item--name',
			getter: 'text'
		}
	},

	itemSelector: app.selectors.feedlistItem,

	subViews: {},

	initialize: function(opts) {
		this.collection = new app.collections.Feedlist();
		app.views.PreRenderedList.prototype.initialize.apply(this, arguments);
		this.listenTo(this.collection, 'add', this.listAdded);
		this.listenTo(this.collection, 'remove', this.listRemoved);
	},

	createList: function(){
		var input = this.$('#name-input');
		var name = input.val().trim();
		input.val('');
		app.setAjaxMessage('Creating list');
		this.collection.create({ name: name }, { wait: true });
	},

	newItemView: function(model, el){
		var item = new app.views.FeedlistItem({
			model: model,
			el: el
		});
		this.subViews[model.id] = item;
		return item;
	},

	listAdded: function(model){
		var item = this.newItemView(model);
		this.$('ul').append(item.render().$el);
		this.checkEmptyMessage();
	},

	listRemoved: function(model){
		this.subViews[model.id].close();
		delete this.subViews[model.id];
		this.checkEmptyMessage();
	},

	createOnEnter: function(evt) {
		if (evt.keyCode == 13) {
			this.createList();
		}
	},
});

app.views.FeedlistItem = Backbone.View.extend({

	template: app.templates.listitem,

	events: {
		'click .btn-list-remove': 'removeList',
	},

	initialize: function(){
		this.listenTo(this.model, 'sync', this.render);
	},

	render: function(){
		var content = this.template.render(this.model.toJSON());
		if (this.isEmpty()) {
			this.setElement(content);
		}
		else {
			this.$el.html($(content).html());
		}
		return this;
	},

	removeList: function(){
		var modal = $('#delete-modal');
		var deleteFunction = $.proxy(this.deleteModel, this);
		modal.on('click', '#btn-modal-delete', deleteFunction);
		modal.on('hide.bs.modal', function(){
			modal.off();
		});
		modal.modal({
			backdrop: 'static'
		});
	},

	deleteModel: function(){
		var deleteComplete = $.proxy(this.deleteComplete, this);
		app.setAjaxMessage('Deleting list');
		this.model.destroy({ wait: true });
	},
});