@extends('core::layouts.master')

@section('content')


<div class="card">
    <div class="card-body">
        <h4>Edit Language {{$language->name}}</h4>

        <form action="{{ route('languages.update', ['id' => $language->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-6">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $language->name) }}">
                    @error('name')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="code" class="form-label">Code</label>
                    <input class="form-control" type="text" id="code" name="code" value="{{ old('code', $language->code) }}">
                    @error('code')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check form-switch">
                        <input type="hidden" name="status" value="0">
                        <input class="form-check-input" type="checkbox" role="switch" name="status" id="status_{{$language->id}}" @if ($language->status == 1) checked @endif>
                    </div> 
                    @error('status')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="default_{{$language->id}}" class="form-label">Default</label>
                    <div class="form-check form-switch">
                        <input type="hidden" name="isDefault" value="0">
                        <input class="form-check-input" type="checkbox" role="switch" name="isDefault" id="default_{{$language->id}}" @if ($language->isDefault == 1) checked @endif>
                    </div>   
                    @error('isDefault')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div>
                        <label for="code" class="form-label">Direction</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="direction" id="ltr" value="ltr" @if($language->direction == 'ltr') checked @endif>
                        <label class="form-check-label" for="ltr">Left To Right</label>
                    </div>                       
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="direction" id="rtl" value="rtl" @if($language->direction == 'rtl') checked @endif>
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

