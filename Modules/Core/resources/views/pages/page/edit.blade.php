@extends('core::layouts.master')

@section('content')
<div class="card mb-5">
    @isset($page)
    <div class="card-header d-flex mb-5 align-items-center">
        <span class="card-title m-0 fs-4">Edit <b>{{$page->title}}</b></span>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-primary ms-auto">Back</a>
    </div>
    <div class="card-body">

       
        <form action="{{route('admin.pages.update', ['id' => $page->id])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-5">
                        <label for="page_name" class="form-label">Page Name</label>
                        <input type="text" class="form-control" id="page_name" name="title" placeholder="Page Name" value="{{old('title', $page->title)}}">
                    </div> 
                    <div class="mb-5">
                        <label for="page_url" class="form-label">URL</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{url('/')}}/</span>
                            <input type="text" class="form-control" id="page_url" name="slug" value="{{old('slug', $page->slug)}}">
                        </div>
                        <div class="form-text">Alpha Numeric and hyphens are allowed, (Leave Blank for making home page)</div>
                    </div> 
                </div>
                <div class="col-md-4">
                    
                    <div class="mb-5">
                        <label for="page_status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="page_status">
                            <option>Select Status</option>
                            <option value="active" @if ($page->status == 'active') selected @endif>Active</option>
                            <option value="inactive" @if ($page->status == 'inactive') selected @endif>Inactive</option>
                            <option value="draft" @if ($page->status == 'draft') selected @endif>Draft</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
    @endisset
</div>
@endsection