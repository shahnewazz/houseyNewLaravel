
<div class="widget-form" id="widget-{{ $id }}" data-index="{{ $id }}" data-item_count="1">
    <input type="hidden" name="widgets[widget-{{$id}}][widget_type]" value="banner">

    <div class="repeater-form-fields-wrapper">
        <div class="repeater-form-fields pb-4">
            <div class="card-header d-flex align-items-center gap-3">
                <button class="btn btn-icon btn-xs btn-label-primary repeater-form-move" type="button">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 2.5L7 0.5M7 0.5L9 2.5M7 0.5V13.5M5 11.5L7 13.5M7 13.5L9 11.5M11.5 5L13.5 7M13.5 7L11.5 9M13.5 7H0.5M2.5 5L0.5 7M0.5 7L2.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="btn btn-icon btn-xs btn-label-primary repeater-form-toggle-btn" type="button">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 11.5V2.5M7 11.5L9.5 9M7 11.5L4.5 9M7 2.5L9.5 5M7 2.5L4.5 5M13.5 0.5H0.5M13.5 13.5H0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <h5 class="card-title repeater-item-title">Item 1</h5>
                <button class="btn btn-sm btn-danger repeater-form-remove-btn ms-auto" type="button">Remove</button>
            </div>
            <div class="repeater-form-wrapper">
                <div class="mb-3">
                    <label for="widget_title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="widgets[widget-{{$id}}][widget_data][repeater-item-1][title]" placeholder="Enter widget title">
                </div>
                <div class="mb-3">
                    <label for="widget_image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="widgets[widget-{{$id}}][widget_data][repeater-item-1][image]">
                </div>
                <div class="mb-3">
                    <label for="widget_description" class="form-label">Description</label>
                    <textarea class="form-control" name="widgets[widget-{{$id}}][widget_data][repeater-item-1][description]" rows="3" placeholder="Enter widget description"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-sm btn-primary repeater-form-add-btn" type="button">Add New</button>