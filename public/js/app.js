$(document).ready(function(){
	app.start();
});

window.app = (function() {
	
	var app = {};
	app.models = {};
	app.collections = {};
	app.views = {};
	app.templates = {};
	app.cache = {};

	app.selectors = {
		content: '.page-content',
		emptyMessage: '.empty-message',
		feedItem: '.feed-item',
		feedlistItem: '.feedlist-item',
		pinColor: '#pin-color'
	};

	devRoot = '/Dehrg/public_html/Text/Feed/public';
	liveRoot = '/demos/feed';

	var source = document.location.host;
	if (source.indexOf('127.0.0.1') >= 0 || source.indexOf('localhost') >= 0){
		app.rootUrl = devRoot;
	}
	else {
		app.rootUrl = liveRoot;
	}

	app.stripHTML = function(text, allowBold) {
		var tagRegex = (allowBold === true) ? /<\/?[^b>]>|<\/?[^>\/]{2,}>/g : /<\/?[^>]*>/g;
		return text.replace(tagRegex, '');
	};

	app.decodeHTML = function(text) {
		var div = document.createElement('div');
		div.innerHTML = text;
		return div.innerText;
	};

	var ajaxMessage = '';
	var ajaxSpinner = $('#ajax-modal');

	app.start = function() {
		$(document)
			.ajaxStart(function () {
				var dialog = $('.ajax-dialog', ajaxSpinner);
				var message = $('.ajax-message', ajaxSpinner);
				dialog.css('width', 'auto');
				ajaxSpinner.css('display', 'block');
				message.text(ajaxMessage);
				(ajaxMessage) ? message.removeClass('hide') : message.addClass('hide');
				dialog.css('width', $('.ajax-content').outerWidth());
				ajaxSpinner.modal({
					backdrop: 'static'
				});
			})
			.ajaxStop(function () {
				ajaxSpinner.modal('hide');
				ajaxMessage = '';
			});
	};

	app.setAjaxMessage = function(message) {
		ajaxMessage = message;
	};

	return app;
})();

Backbone.View.prototype.close = function() {
	this.remove();
	this.unbind();
	if (this.onClose) {
		this.onClose();
	}
};

Backbone.Model.prototype.parse = Backbone.Collection.prototype.parse = function(resp, options) {
	// check and parse jsend response pattern
	return ( resp.data && resp.status ) ? JSON.parse(resp.data) : resp;
};

Backbone.View.prototype.isEmpty = function() {
	return this.$el.html() === '';
};

Backbone.View.prototype.bubble = Backbone.Model.prototype.bubble = function(target) {
	this.listenTo(target, 'all', function(event) {
		this.trigger.apply(this, arguments);
	});
};

/**
 * Common functionality for views which represent a list of models and are rendered on the server
 * These views will be read from the DOM - creating Backbone models and views for the purpose of organization
 */
app.views.PreRenderedList = Backbone.View.extend({

	initialize: function(opts){
		if (this.isEmpty()){

		}
		if (!opts.itemSelector) {

		}
		if (!this.collection) this.collection = new Backbone.Collection();
		var modelCreator = this.modelConstructor || this.collection.model;
		_.each($(this.itemSelector, this.el), function(element){
			var model = this.createModelFromHtml(element, modelCreator);
			this.collection.add(model);
			this.newItemView(model, element);
		}, this);
	},

	createModelFromHtml: function(element, model){
		var data ={};
		for (var attr in this.modelAttributes){
			data[attr] = this.getValue(this.modelAttributes[attr], element);
		}
		return new model(data);
	},

	getValue: function(attr, source){
		var func = attr.getter || 'val';
		var element = $(attr.select, source);
		var getValue = element[func];
		var value = getValue.apply(element, attr.args);
		if (attr.integer === true) return parseInt(value, 10);
		return (attr.trim === false) ? value : $.trim(value);
	},

	checkEmptyMessage: function() {
		var message = $(app.selectors.emptyMessage, this.el);
		if (this.collection.length === 0) {
			message.removeClass('hidden');
		}
		else {
			message.addClass('hidden');
		}
	}
});