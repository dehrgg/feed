app.views.Picklist = Backbone.View.extend({

	template: app.templates.picklist,

	events: {
		'click #btn-modal-done': 'fireAction'
	},

	initialize: function(opts){
		this.action = opts.action;
		this.collection = this.collection || new app.collections.Feedlist();
		_.each($('.picklist--item', this.el), this.createModelFromHtml, this);
	},

	createModelFromHtml: function(item){
		var name = $('.picklist--list-name', item).html();
		var id = $('.picklist--list-id', item).val();
		var list = new app.models.Feedlist({
			name: name,
			id: id
		});
		var itemView = new app.views.PicklistItem({
			model: list,
			el: item
		});
		this.collection.add(list);
	},

	setAction: function(callback){
		this.action = callback;
	},

	fireAction: function(){
		var selected = this.collection.where({'selected': true});
		this.action(selected);
	},

	open: function(){
		this.$el.modal({
			backdrop: 'static'
		});
	}
});

app.views.PicklistItem = Backbone.View.extend({
	tagName: 'li',

	template: app.templates.picklistItem,

	events: {
		'change :checkbox': 'updateModel'
	},

	render: function(){
		var html = this.template.render(this.model.toJSON());
		this.setElement(html);
		return this;
	},

	updateModel: function(evt){
		this.model.set('selected', evt.target.checked);
	}
});