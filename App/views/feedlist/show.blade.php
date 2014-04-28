@extends('core.page')

@section('content')
<!-- For editing the feeds from the page of the list itself. Not yet implemented.
<div>
	<button class="btn btn-default">Feeds<span class="glyphicon glyphicon-pencil btn-glyph"></span></button>
	<button class="btn btn-default">Delete<span class="glyphicon glyphicon-trash btn-glyph"></span></button>
</div> -->
@foreach($stories as $story)
	@include('shared.feed.story', $story)
@endforeach
@if (count($stories) === 0)
	<p>
		There are no stories to display - 
		add feeds from your <a href="{{ asset('/pins') }}"> pinned feeds </a> 
		or <a href="{{ asset('/search') }}">search</a> for new ones 
	</p>
@endif
@stop