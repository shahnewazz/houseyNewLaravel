@extends('core::layouts.master')

@section('content')

@isset($page)
<form action="{{route('admin.pages.update', ['id' => $page->id])}}" method="POST">
    @csrf
    @method('PUT')
    <x-core::card>
        <x-slot name="header_2">
            <div class="d-flex align-items-center">
                <span class="card-title m-0 fs-4">Edit - <b>({{$page->title}})</b></span>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-primary ms-auto">Back</a>
            </div>
        </x-slot>

    
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-5">
                        <label for="page_name" class="form-label">Page Name</label>
                        <input type="text" class="form-control" id="page_name" name="title" placeholder="Page Name" value="{{old('title', $page->title)}}" required>
                        <x-core::form.input-error field="title" />
                    </div> 
                    <div class="mb-5">
                        <label for="page_url" class="form-label">URL</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{url('/')}}/</span>
                            <input type="text" class="form-control" id="page_url" name="slug" value="{{old('slug', $page->slug)}}">
                        </div>
                        <div class="form-text">Alpha Numeric and hyphens are allowed.</div>
                        <x-core::form.input-error field="slug" />
                    </div> 
                </div>
                <div class="col-md-4">
                    
                    <div class="mb-5">
                        <label for="page_status" class="form-label">Status</label>
                        <select class="form-select conca-select2" name="status" id="page_status" required>
                            <option>Select Status</option>
                            <option value="active" @if ($page->status == 'active') selected @endif>Active</option>
                            <option value="inactive" @if ($page->status == 'inactive') selected @endif>Inactive</option>
                            <option value="draft" @if ($page->status == 'draft') selected @endif>Draft</option>
                        </select>
                        <x-core::form.input-error field="status" />
                    </div>
                </div>
            </div>
            <x-slot name="footer">
                <button class="btn btn-primary float-end" type="submit">Update</button>
            </x-slot>
    </x-core::card>
</form>
@endisset
@endsection