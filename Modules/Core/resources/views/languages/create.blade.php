@extends('core::layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Add Language</h4>

        <form action="{{ route('languages.store') }}" method="POST">
            @csrf
            <div class="row g-6">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="code" class="form-label">Code</label>
                    <input class="form-control" type="text" id="code" name="code" value="{{ old('code') }}">
                    @error('code')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div>
                        <label for="code" class="form-label">Direction</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="direction" id="ltr" value="ltr">
                        <label class="form-check-label" for="ltr">Left To Right</label>
                    </div>                       
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="direction" id="rtl" value="rtl">
                        <label class="form-check-label" for="rtl">Right To Left</label>
                    </div>                       
                    @error('direction')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror                
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="btn btn-primary me-3">Save changes</button>
            </div>
        </form>
    </div>
</div>

@endsection
