@extends('core::layouts.master')

@section('content')

@php
    $all_menu = \Modules\Core\Models\Menu::all();
@endphp


<div class="row mb-5">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="px-2 mb-5">
                    <div class="row align-items-center mb-6">
                        <div class="col-xl-5">
                            <h4 class="card-title m-0">All Menus</h4>
                        </div>
                        <div class="col-xl-7">
                            <div class="d-flex gap-6 justify-content-end">
                                
                                <a href="{{route('admin.menus.create', ['code' => 'en'])}}" class="btn btn-primary  flex-basis-1">
                                    Create Menu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @if(isset($all_menu) && !$all_menu->isEmpty())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    SN
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Language Code
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_menu as $menu)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$menu->title}}</td>
                                <td>{{$menu->code}}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{route('admin.menus.edit', ['id' => $menu->id, 'code' => $menu->code])}}">Edit</a>
                                    <form action="{{route('admin.menus.destroy', ['id' => $menu->id])}}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger menu-del-btn" data-title="{{$menu->title}}">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="alert alert-warning">
                        No menu found.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    "use strict";

    $('.menu-del-btn').on('click', function(e){
        e.preventDefault();
        var form = $(this).parent('form');
        var title = $(this).data('title');
        var confirm_message = 'Are you sure you want to delete This menu?';
        var html = '<p>This will delete "<strong>'+title+'</strong>" and all its items. This action cannot be undone.</p>';

        Swal.fire({
            title: 'Delete Menu',
            text: confirm_message,
            icon: 'warning',
            html: html,
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }); 
    
</script>    
@endpush