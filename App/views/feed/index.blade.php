@extends('core.page')

@section('outer-content')
@include('feed.picklist', array('lists' => $lists))
@include('feed.edit')
@stop

@section('content')
@foreach($feeds as $feed)
@include('shared.feed.saved', $feed)
@endforeach
<p class="empty-message @if (count($feeds) > 0) hidden @endif">
	You have no pinned feeds -
	try <a href="{{ asset('/search') }}">searching</a> for some 
</p>

@stop
@section('scripts') 
@include('core.scripts', $scripts)
<!-- Page setup -->
<script type="text/javascript">
$(document).ready(function(){
	var feedView = new app.views.FeedIndex({ el: $(app.selectors.content) });
	var picklist = new app.views.Picklist({ el: $('#picklist-modal') });
	picklist.listenTo(feedView, 'request.picklist', function(action){
		picklist.setAction(action);
		picklist.open();
	});
	var editView = new app.views.PinDialog({ el: $('#pin-modal') });
	editView.listenTo(feedView, 'pin.edit', function(pin) {
		editView.setModel(pin);
		editView.open();
	})
});
</script>
@stop