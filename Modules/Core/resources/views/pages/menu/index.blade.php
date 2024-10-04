@extends('core::layouts.master')

@section('content')

@php
    $all_menu = \Modules\Core\Models\Menu::all();
@endphp


<div class="row mb-5">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="m-0">All Menus</h5>
                    <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#menuModal" class="text-underline">
                        Add Menu
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_menu as $menu)
                            <tr>
                                <td>{{$menu->title}}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{route('admin.menus.edit', ['id' => $menu->id])}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
                
                  
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">Add item</div>
                    <div class="card-body">
                        <form id="frmEdit" class="form-horizontal">
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
                        <button type="button" id="btnUpdate" class="btn btn-primary" disabled>
                            <i class="fas fa-sync-alt"></i> 
                            Update
                        </button>
                        <button type="button" id="btnAdd" class="btn btn-success">
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
                
                @isset($single_menu)
                <form id="menuAddForm" action="{{route('admin.menus.update', ['id' => $single_menu->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="menu_data" @isset($single_menu) value="{{$single_menu->menu_items}}" @endisset> 
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="">
                            <label for="menu_title" class="form-label">Menu Title</label>
                            <input class="form-control form-control-sm" type="text" name="menu_title" @isset($single_menu) value="{{old('menu_title', $single_menu->title)}}" @endisset >
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-sm btn-primary" id="saveMenu">Save Menu</button>
                        </div>
                    </div>     
                    
                    <p class="text-secondary">
                        Add menu items by selecting from the pages list on the left. Drag and drop to reorder menu items.
                    </p>
                    
                    <div class="menu-box">
                        <div class="card-body">
                            <ul id="myEditor" class="sortableLists list-group">
                            </ul>
                        </div>
                    </div>
                </form>
                @else
                    <div class="alert alert-warning">Select Menu to Edit</div>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.menus.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="menu_name" class="form-label">Menu Name</label>
                        <input type="text" class="form-control" id="menu_name" name="menu_title" value="{{old('menu_name')}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
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

    $('#menuUpdateBtn').on('click', function(e){
        e.preventDefault();
        
        var menuId = document.getElementById('menuSelect').value;
        if(menuId) {
            // Get the form element
            var form = document.getElementById('menuForm');
            // Update the action URL with the selected menu ID
            form.action = "{{ route('admin.menus.edit', ['id' => ':id']) }}".replace(':id', menuId);
            // Submit the form
            form.submit();
        } else {
            alert('Please select a menu first.');
        }
    })

    $('#page-select').on('change', function() {
        var page = $('#page-select option:selected');
        var text = page.data('title');
        var href = page.data('url');

        $('#text').val(text);
        $('#href').val(href);
    });

    // menu items
    var arrayjson = $('input[name="menu_data"]').val();
    // icon picker options
    var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
    // sortable list options
    var sortableListOptions = {
        placeholderCss: {'background-color': "#cccccc"}
    };

    var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
    editor.setForm($('#frmEdit'));
    editor.setUpdateButton($('#btnUpdate'));
    
    if( $('input[name="menu_data"]').val()){
        editor.setData(arrayjson);
    }

    $('#saveMenu').on('click', function () {
        var str = editor.getString();
        var menu_Name = $('input[name="menu_title"]').val();
        var menu_data = $('input[name="menu_data"]').val();
        if(menu_Name.trim() == ''){
            alert("Enter Menu Title")
            return
        }

        $('input[name="menu_data"]').val(str);
        $('#menuAddForm').submit();
    });

    $("#btnUpdate").click(function(){
        editor.update();
    });

    $('#btnAdd').click(function(){
        if($('#text').val() === ''){
            alert('Enter a menu item');
            return;
        }
        if($('#href').val() === ''){
            alert('Enter a URL');
            return;
        }
        editor.add();
    });
    $('#btn-add-page').on('click', function() {
            var page = $('#page-select option:selected');
            console.log(page.data('title'));
            editor.add({
                name: page.data('title'),
                href: page.data('url'),
                target: "_self",
                icon: "fas fa-link"
            });
        });
    
</script>
@endpush