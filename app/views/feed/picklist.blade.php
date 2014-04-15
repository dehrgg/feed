<div class="modal fade" id ="picklist-modal" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="modalTitle">Select lists</h4>
      </div> 
      <div class="modal-body">
        <div class="picklist">
          @foreach($lists as $list)
          @include('shared.feed.picklistItem', array_merge($list->toArray(), array('full' => $list->isFull())))
          @endforeach
        </div>

<!--           @if(count($lists) < 10)
          <div class="input-group">
            <input type="text" id="name-input" class="form-control" name="name" placeholder="Create new list">
            <span class="btn-text-field input-group-addon" id="btn-list-create">
                  <span class="glyphicon glyphicon-plus"></span>
            </span>
          </div>
          @endif -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-modal-done">Done</button>
      </div>
    </div>
  </div>
</div>