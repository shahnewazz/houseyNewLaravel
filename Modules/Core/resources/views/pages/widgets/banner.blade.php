<div class="widget-form" id="widget-{{ $id }}" data-index="{{ $id }}">
    <input type="hidden" name="widgets[widget-{{$id}}][widget_type]" value="banner">
    <div class="mb-3">
        <label for="widget_subtitle" class="form-label">Subtitle</label>
        <input type="text" class="form-control" name="widgets[widget-{{$id}}][widget_data][subtitle]" placeholder="Enter widget subtitle">
    </div>
    <div class="mb-3">
        <label for="widget_title" class="form-label">Title</label>
        <input type="text" class="form-control" name="widgets[widget-{{$id}}][widget_data][title]" placeholder="Enter widget title">
    </div>
    <div class="mb-3">
        <label for="widget_description" class="form-label">Description</label>
        <textarea class="form-control" name="widgets[widget-{{$id}}][widget_data][description]" rows="3" placeholder="Enter widget description"></textarea>
    </div>
    <div class="mb-3">
        <label for="widget_btn_text" class="form-label">Button Text</label>
        <input type="text" class="form-control" name="widgets[widget-{{$id}}][widget_data][btn_text]" placeholder="Button Text">
    </div>
    <div class="mb-3">
        <label for="widget_btn_url" class="form-label">Button URL</label>
        <input type="url" class="form-control" name="widgets[widget-{{$id}}][widget_data][btn_url]" placeholder="Button URL">
    </div>
    <div class="mb-3">
        <label for="widget_image" class="form-label">Image</label>
        <input type="file" class="form-control" name="widgets[widget-{{$id}}][widget_data][image]">
    </div>
</div>