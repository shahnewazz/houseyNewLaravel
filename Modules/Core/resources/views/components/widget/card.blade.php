<div class="card shadow rounded-md {{ $class ?? '' }}">
  <div class="card-thumbnail img-thumbnail p-3 text-center">
    <img class="img-fluid" src="{{$src ?? ''}}" alt="{{$title ?? ''}}">
  </div>
  <div class="card-body">
      <div class="row align-items-center g-4">
        <div class="col-9">
          <h5 class="card-title m-0 fs-4">{{$title ?? ''}}</h5>
        </div>
        <div class="col-3">
          <button type="button" class="btn btn-primary btn-sm float-end widget-add-btn" data-widget="{{$widget}}">
            <span>Add</span>
          </button>
        </div>
      </div>
  </div>
</div>