@extends('core::layouts.master')

@section('content')
<?php $code = request()->query('code', 'en'); ?>

<form class="form-page-widget" action="{{route('admin.pages.widgets.save', ['id' => $page->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
   
    <x-core::card>
        <x-slot name="header_2">
            <div class="d-flex align-items-center">
                <span class="card-title m-0 fs-4">Edit Widgets</span>
                <div class="d-flex align-items-center justify-content-end ms-auto gap-3">
                    <a href="{{route('admin.pages.index')}}" class="btn btn-label-secondary">
                        Back
                    </a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#allWidget">
                        UI Blocks
                    </button>
                </div>
            </div>
        </x-slot>
    
       
        @php
            $widgetCount = @isset($page->widgets) ? count($page->widgets) : 0;
        @endphp


        <div class="alert alert-danger">
            <strong>Warning!</strong> Please fill all required fields before saving.
        </div>
    
        <div class="widget-container" id="widgetContainer" data-widgets="{{$widgetCount}}">
            @isset($page->widgets)
                @foreach ($page->widgets as $key => $widget)
                    @php
                        $dataArr = [
                            'id' => $loop->iteration,
                            'data' => !empty($widget['widget_data']) ? $widget['widget_data'] : [],
                            'code' => $code,
                        ];

                    @endphp
                    @include('core::pages.widgets.'.$widget['widget_type'], $dataArr)
                @endforeach
                
            @endisset
           
        </div>
        
    
    
        <x-slot name="footer">
            <button class="btn btn-primary float-end widget-save-btn" type="submit">Save Widgets</button>
        </x-slot>
    </x-core::card>
</form>


<!-- Modal -->
<div class="modal fade" id="allWidget" tabindex="-1" aria-labelledby="allWidgetLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
        <div class="modal-header px-5">
            <h5 class="modal-title fs-5 text-black" id="allWidgetLabel">UI Blocks</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row row-cols-lg-4 row-cols-sm-3 row-cols-1 g-5">
                <div class="col">
                    <x-core::widget.card title="Header 1" widget="header-1" code="{{$code}}" src="https://shofy.botble.com/themes/shofy/images/shortcodes/about.png"  />
                </div>
                <div class="col">
                    <x-core::widget.card title="Banner" widget="banner" code="{{$code}}" src="https://shofy.botble.com/themes/shofy/images/shortcodes/about.png"  />
                </div>
                <div class="col">
                    <x-core::widget.card title="Facilities" widget="facilities" code="{{$code}}" src="https://shofy.botble.com/themes/shofy/images/shortcodes/about.png"  />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('backend/assets/vendor/libs/sortable/sortable.js')}}"></script> <!-- jQuery UI for sorting -->
<script src="{{asset('backend/assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>

<script>
    'use strict';


    document.addEventListener('click', function(e) {
    if (e.target.matches('.repeater-form-add-btn')) {
        e.preventDefault();

        // Find the closest parent element with the class '.widget-form'
        var parentElement = e.target.closest('.card-body');
        
        if (!parentElement) {
            console.error('Could not find the .widget-form element.');
            return; // Exit if no .widget-form is found
        }

        // Find and clone the first .repeater-form-fields inside the widget form
        var repeaterFields = parentElement.querySelector('.repeater-form-fields');
        if (!repeaterFields) {
            console.error('Could not find the .repeater-form-fields element.');
            return; // Exit if no .repeater-form-fields is found
        }

        var html = repeaterFields.cloneNode(true); // Clone the node

        // Find the widget form with data-item_count
        var widgetForm = parentElement.querySelector('[data-item_count]');
        
        if (!widgetForm) {
            console.error('Could not find the element with data-item_count attribute.');
            return; // Exit if no widgetForm with data-item_count is found
        }

        // Get the current repeater index
        var repeaterIndex = parseInt(widgetForm.getAttribute('data-item_count'), 10) || 0;

        // Update the cloned HTML
        var updatedHtml = html.innerHTML.replaceAll('[repeater-item-1]', '[repeater-item-' + (repeaterIndex + 1) + ']');
        html.innerHTML = updatedHtml; // Update the cloned element's HTML

        // Update the repeater item title
        var itemTitle = html.querySelector('.repeater-item-title');
        if (itemTitle) {
            itemTitle.textContent = 'Item ' + (repeaterIndex + 1); // Set the new title
        }

        // change the for and id attributes of the for="contact_icon" fields
        var fields = html.querySelectorAll('[for="contact_icon"], [id="contact_icon"]');
        fields.forEach(function(field) {
            field.setAttribute('for', 'contact_icon_' + (repeaterIndex + 1));
            field.setAttribute('id', 'contact_icon_' + (repeaterIndex + 1));
        });


        // Append the cloned element to the repeater wrapper
        var repeaterWrapper = parentElement.querySelector(".repeater-form-fields-wrapper");
        if (!repeaterWrapper) {
            console.error('Could not find the .repeater-form-fields-wrapper element.');
            return; // Exit if no .repeater-form-fields-wrapper is found
        }

        repeaterWrapper.appendChild(html); // Append the cloned element

        // Update the data-item_count attribute
        widgetForm.setAttribute('data-item_count', repeaterIndex + 1);

        // Re-initialize the sortable if necessary
        if (repeaterWrapper._sortable) {
            repeaterWrapper._sortable.destroy();
        }

        Sortable.create(repeaterWrapper, {
            animation: 150,
            handle: '.repeater-form-move',
        });
    }
});




    $(document).on('click', '.repeater-form-toggle-btn', function(e) {
        e.preventDefault();
        $(this).closest('.repeater-form-fields').find('.repeater-form-wrapper').slideToggle();
    });


    $(document).on('click', '.repeater-form-remove-btn', function(e) {
        e.preventDefault();
        
        // Count the number of `.repeater-form-fields` elements
        let formFields = $(this).closest('.widget-form').find('.repeater-form-fields');


        if (formFields.length > 1) {
            // If there is more than one item, show the confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('.repeater-form-fields').remove();
                }
            });
        } else {
            // If there is only one item, show a warning or prevent removal
            Swal.fire({
                icon: 'warning',
                title: 'Cannot remove the last item!',
                text: 'At least one item must remain.',
                confirmButtonColor: '#3085d6'
            });
        }
    });

    const widgetWrapper = document.getElementById('widgetContainer');

    if (widgetWrapper) {
        Sortable.create(widgetWrapper, {
            animation: 150,
            handle: '.handle',
            onEnd: function (evt) {
                
                const widgets = widgetWrapper.querySelectorAll('.widget-item');
                widgets.forEach((widget, index) => {
                    widget.setAttribute('data-index', index);
                });
            }
        });
    }



    // Add widget when button is clicked
    $(document).on('click', '.widget-add-btn', function(e) {
        e.preventDefault();
        let $button = $(this);
        let widgetName = $(this).data('widget');
        let widgetCode = $(this).data('code');
        
        var widgetContainers = document.querySelectorAll('.widget-container');

        widgetContainers.forEach(function(container) {
            var currentWidgets = parseInt(container.getAttribute('data-widgets'), 10) || 0;
            container.setAttribute('data-widgets', currentWidgets + 1);
        });
        
        console.log(widgetCode);

        $.ajax({
            url: "{{ route('admin.pages.widgets.load', ':widget') }}".replace(':widget', widgetName),
            method: 'GET',
            data: {
                id: document.getElementById('widgetContainer').getAttribute('data-widgets'),
                code: widgetCode
            },
            beforeSend: function() {
                $button.prop('disabled', true).append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            },
            success: function(response) {
                $('.widget-container').append(response.html);

                // refresh select2
                $(document).trigger('contentLoaded');
                
                toastr.success('Widget added successfully!');
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON.message)
                widgetContainers.forEach(function(container) {
                    var currentWidgets = parseInt(container.getAttribute('data-widgets'), 10) || 0;
                    container.setAttribute('data-widgets', currentWidgets - 1);
                });
            },
            complete: function() {
                $button.prop('disabled', false).find('.spinner-border').remove();
            }
        });
    });



    // Remove widget
    $(document).on('click', '.widget-remove', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('.widget-item').remove();
            }
        });
    });


</script>
@endpush
