<div class="settings-item w-100 confirm-wrap">
  @if($obj->id)
    <form method="POST" action="{{ route($route.'.update') }}" class="p-t-15" id="TypeFrm" data-validate=true>
    <input type="hidden" name="id" value="{{encrypt($obj->id)}}">
  @else
    <form method="POST" action="{{ route($route.'.store') }}" class="p-t-15" id="TypeFrm" data-validate=true>
  @endif
    @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="form-group form-group-default form-group-default-select2 required">
          <label>Status</label>
          <select name="status" class="full-width miniweb-select2-input" data-parent=".jconfirm-box">
            <option value="1" @if($obj->status == 1) selected="selected" @endif>Enabled</option>
            <option value="2" @if($obj->status == 2) selected="selected" @endif>Disabled</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group form-group-default required ">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{$obj->name}}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-right">
        <button class="btn btn-primary" id="miniweb-ajax-form-submit-btn" type="button">Save</button>
      </div>
    </div>
  </form>
</div>