/**
 * Represents a dialog for editing a pinned feed
 */
app.views.PinDialog = Backbone.View.extend({
	template: app.templates.form,

	events: {
		"click :button[name='modal-save']": "saveChanges",
	},

	initialize: function() {
		this.$form = this.$('.pin-form');
	},

	render: function() {
		this.$form.html(this.template.render(this.model.toJSON()));
		if (window.jscolor) {
			jscolor.color($(app.selectors.pinColor)[0], {hash: true});
		}
	},

	saveChanges: function() {
		this.updateModel(['#pin-alias', '#pin-color']);
		this.model.save();
	},

	open: function() {
		this.$el.modal({
			backdrop: 'static'
		});
	},

	/**
	 * Applies the values from each specified field to the underlying model
	 * @param  Array[String] inputs selectors for the fields to be considered
	 */
	updateModel: function(inputs){
		for (var i=0; i<inputs.length; ++i) {
			var input = $(inputs[i]);
			this.model.set(input.attr('name'), input.val());
		}
	},

	setModel: function(model){
		this.model = model;
		this.render();
	}

});