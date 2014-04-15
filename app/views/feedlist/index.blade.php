@extends('core.page')

@section('outer-content')
<div class="modal fade" id ="delete-modal" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="modalTitle">Confirm deletion</h4>
      </div> 
      <div class="modal-body">
        <p>Are you sure you want to delete this list?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-modal-delete">Delete</button>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')
<div class="form-group">
  <label for="name-input" class="sr-only">Create List</label>
  <div class="input-group">
    <input type="text" id="name-input" class="form-control" name="name" placeholder="Enter name for new list">
    <span class="btn-text-field input-group-addon" id="btn-list-create">
          <span class="glyphicon glyphicon-plus"></span>
    </span>
  </div>
</div>

<ul class="list-unstyled">
@foreach ($lists as $list)
	@include('shared.feedlist.listitem', $list)	
@endforeach
</ul>

<p class="empty-message col-lg-11 @if (count($lists) > 0) hidden @endif">You have not created any lists</p>

@stop

@section('scripts') 
@include('core.scripts', $scripts)
<!-- Page setup -->
<script type="text/javascript">
$(document).ready(function(){
  window.FeedList = new app.views.Feedlists({el: $(app.selectors.content)});
});
</script>
@stop

