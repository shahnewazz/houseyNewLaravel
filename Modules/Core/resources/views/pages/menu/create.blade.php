@extends('core::layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">Create Menu</div>
                    <div class="card-body">

                        <form id="menuBuilderForm" class="form-horizontal">
                            <div class="mb-3">
                                <label for="page-select">Select Page</label>
                                <select id="page-select" class="form-select">
                                    <option value="">Select Page</option>
                                    <option value="1" data-title="home" data-url="/home">Home</option>
                                    <option value="2" data-title="about" data-url="/about">About</option>
                                    <option value="3" data-title="services" data-url="/services">Services</option>
                                    <option value="4" data-title="contact" data-url="/contact">Contact</option>
                                </select>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="text" class="form-label">Text</label>
                                <div class="input-group">
                                    <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="href" class="form-label">URL</label>
                                <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                            </div>
                            <div class="form-group mb-3">
                                <label for="target" class="form-label">Target</label>
                                <select name="target" id="target" class="form-select item-menu">
                                    <option value="_self">Self</option>
                                    <option value="_blank">Blank</option>
                                    <option value="_top">Top</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Tooltip</label>
                                <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="menuUpdateBtn" class="btn btn-primary" disabled>
                            <i class="fas fa-sync-alt"></i> 
                            Update
                        </button>
                        <button type="button" id="menuAddBtn" class="btn btn-success">
                            <i class="fas fa-plus"></i> 
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                
                
                <form id="menuAddForm" action="{{route('admin.menus.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="menu_data" value=""> 
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="">
                            <label for="menu_title" class="form-label">Menu Title</label>
                            <input class="form-control form-control-sm" type="text" name="menu_title" value="{{old('menu_title')}}" required>
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-sm btn-primary" id="createMenu">Create Menu</button>
                        </div>
                    </div>     
                    
                    <p class="text-secondary">
                        Add menu items by selecting from the pages list on the left. Drag and drop to reorder menu items.
                    </p>
                    
                    <div class="menu-box">
                        <div class="card-body">
                            <ul id="menuBuilderArea" class="sortableLists list-group">
                            </ul>
                        </div>
                    </div>
                </form>
               
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('css/bootstrap-iconpicker.min.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    
@endpush

@push('scripts')
    <script type="text/javascript" src="{{asset('js/menu-editor.min.js')}}"></script>

<script>
    "use strict";

    $('#page-select').on('change', function() {
        var page = $('#page-select option:selected');
        var text = page.data('title');
        var href = page.data('url');

        $('#text').val(text.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        }));
        $('#href').val(href);
    });


    var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
    // sortable list options
    var sortableListOptions = {
        placeholderCss: {'background-color': "#cccccc"}
    };

    var editor = new MenuEditor('menuBuilderArea', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
    editor.setForm($('#menuBuilderForm'));
    editor.setUpdateButton($('#menuUpdateBtn'));

    // create menu 
    $('#createMenu').on('click', function (e) {
        e.preventDefault();

        var str = editor.getString();
        var menu_title = $('input[name="menu_title"]').val();
        var menu_data = $('input[name="menu_data"]').val(str);

        if(menu_title.trim() == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Menu title is required!',
            });
            return
        }


        if(JSON.parse(menu_data.val()).length == 0){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Menu items are required!',
            });
            return
        }
        
        $('#menuAddForm').submit();
    });


    $('#menuAddBtn').on('click', function(){
        if($('#text').val() === ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Text is required!',
            });
            return;
        }
        if($('#href').val() === ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'URL is required!',
            });
            return;
        }
        editor.add();
    });

    $("#menuUpdateBtn").click(function(){
        editor.update();
    });
    
    
</script>
@endpush