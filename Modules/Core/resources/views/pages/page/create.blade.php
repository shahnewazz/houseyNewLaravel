@extends('core::layouts.master')

@section('content')
<div class="card">
    <div class="card-header d-flex mb-5 align-items-center">
        <h2 class="card-title m-0">Edit</h2>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-primary ms-auto">Back</a>
    </div>
    <div class="card-body">
        <form action="{{route('admin.pages.store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-5">
                        <label for="page_name" class="form-label">Page Name</label>
                        <input type="text" class="form-control" id="page_name" name="title" placeholder="Page Name" value="{{old('title')}}">
                    </div> 
                    <div class="mb-5">
                        <label for="page_url" class="form-label">URL</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{url('/')}}/</span>
                            <input type="text" class="form-control" id="page_url" name="slug">
                        </div>
                        <div class="form-text">Alpha Numeric and hyphens are allowed</div>
                    </div> 
                </div>
                <div class="col-md-4">
                    
                    <div class="mb-5">
                        <label for="page_status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="page_status">
                            <option selected>Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="page_status" class="form-label d-block mb-2">Set As Home?</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_home" id="is_home_yes" value="1">
                            <label class="form-check-label" for="is_home_yes">Yes</label>
                        </div>                                                                       
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_home" id="is_home_no" value="0" checked>
                            <label class="form-check-label" for="is_home_no">No</label>
                        </div>                                                                       
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>
        </form>

    </div>
</div>
@endsection