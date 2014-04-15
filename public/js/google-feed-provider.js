google.load('feeds', '1');
window.GoogleFeedProvider = function() {

	var _mapEntries = function(entries) {
		return _.map(entries, function(entry){
			return new app.models.Feed({
				name: app.stripHTML(entry.title, true),
				url: entry.url,
				snippet: app.stripHTML(entry.contentSnippet, true),
				link: entry.link
			});
		});
	};

	return {
		loadFeed: function(){
			return google.feeds.loadFeed.apply(undefined, arguments);
		},

		findFeeds: function(query, callback){
			google.feeds.findFeeds(query, function(result){
				if (result.error) {

				}
				else {
					var feeds = _mapEntries(result.entries, callback);
					callback({
						status: 'success',
						data: feeds
					});
				}
			});
		}
	};
};