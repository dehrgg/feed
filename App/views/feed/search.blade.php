@extends('core.page')

@section('outer-content')
@include('feed.picklist', array('lists' => $lists))
@stop

@section('content')
<div class="form-group">
  <label for="query" class="sr-only">Search Feeds</label>
  <div class="input-group">
    <input type="text" id="query" class="form-control" name="query" placeholder="Find RSS Feeds" autofocus>
    <span class="btn-text-field input-group-addon">
          <span class="glyphicon glyphicon-search"></span>
    </span>
  </div>
</div>
<div id="results">	
@foreach ($results as $result)	
@include('shared.feed.searchresult', (array) $result);
@endforeach
</div>
@stop

@section('scripts') 
@include('core.scripts', $scripts)
<!-- Page setup -->
<script type="text/javascript">
google.setOnLoadCallback(function(){
  var feedProvider = new GoogleFeedProvider();
  var searchView = new app.views.Search({
    el: $(app.selectors.content),
    feedProvider: feedProvider
  });
  var picklist = new app.views.Picklist({el: $('#picklist-modal')});
  picklist.listenTo(searchView, 'request.picklist', function(action){
    picklist.setAction(action);
    picklist.open();
  });
});
</script>
@stop
