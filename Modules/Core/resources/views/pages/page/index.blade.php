@extends('core::layouts.master')

@section('content')
<div class="card mb-5">
    <div class="card-body">
        <form action="{{route('admin.pages.store')}}" method="POST">
            @csrf
            @method('POST')
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
                        <div class="form-text">Alpha Numeric and hyphens are allowed, (Leave Blank for create home page)</div>
                        <x-core::form.input-error field="slug" />
                    </div> 
                </div>
                <div class="col-md-4">
                    
                    <div class="mb-5">
                        <label for="page_status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="page_status" required>
                            <option selected>Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                        <x-core::form.input-error field="status" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>
        </form>

    </div>
</div>
<div class="card">
    <div class="card-body">
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
    </div>
</div>

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