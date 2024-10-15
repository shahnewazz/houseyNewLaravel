@extends('core::layouts.master')

@section('content')

<form action="{{route('admin.pages.set_home')}}" method="POST">
    @csrf
    @method('POST')
    <x-core::card>
        <x-slot name="header">
            Set Home Page
        </x-slot>

        <label for="home_page" class="form-label">Select Home Page</label>
        <select name="home_page" id="home_page" class="form-select conca-select2" required>
            <option value="">Select Home Page</option>
            @foreach ($pages as $page)
                <option value="{{$page->id}}" @if($page->is_home == 1) selected @endif>{{$page->title}}</option>
            @endforeach
        </select>

        <x-slot name="footer">
            <button type="submit" class="btn btn-primary float-end">Save</button>
        </x-slot>

    </x-core::card>
</form>

<form action="{{route('admin.pages.store')}}" method="POST">
    @csrf
    @method('POST')
    <x-core::card>
        <x-slot name="header">
            Add New Page
        </x-slot>
        
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-5">
                        <label for="page_name" class="form-label">Page Name</label>
                        <input type="text" class="form-control" id="page_name" name="title" placeholder="Page Name" value="{{old('title')}}" required>
                        <x-core::form.input-error field="title" />
                    </div> 
                    <div class="mb-5">
                        <label for="page_url" class="form-label">URL</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{url('/')}}/</span>
                            <input type="text" class="form-control" id="page_url" name="slug">
                        </div>
                        <div class="form-text">Alpha Numeric and hyphens are allowed.</div>
                        <x-core::form.input-error field="slug" />
                    </div> 
                </div>
                <div class="col-md-4">
                    
                    <div class="mb-5">
                        <label for="page_status" class="form-label">Status</label>
                        <select class="form-select conca-select2" name="status" id="page_status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                        <x-core::form.input-error field="status" />
                    </div>
                </div>
            </div>   

        <x-slot name="footer">
            <button type="submit" class="btn btn-primary float-end">Create</button>
        </x-slot>

    </x-core::card>
</form>


<x-core::card>
    <x-slot name="header">
        All Pages
    </x-slot>
        @isset($pages)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="pages_list_table">
                    @include('core::pages.page.partials._page-list', ['pages' => $pages])
                </tbody>
            </table>          
        </div>
        @endisset
</x-core::card>

@endsection

@push('scripts')

<script>
    "use strict";

    // delete page
    $(document).on('click', '.page-del-btn', function(e){
        e.preventDefault();
        
        Swal.fire({
            title: 'Delete Page',
            text: 'Are you sure you want to delete this page?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form').submit();
            }
        });
    })

</script>
    
@endpush