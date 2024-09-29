@extends('core::layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h4 class="m-0">Add Language</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.languages.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{ route('admin.languages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-6 justify-content-center">


                <div class="col-md-6">
                    <div class="mb-5">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <x-core::form.input-error field="name" />
                    </div>

                    <div class="mb-5">
                        <label for="code" class="form-label">Language Code</label>
                        <select class="form-select lang-select" name="code" id="code">
                            @foreach (config('app.languages') as $lang => $name)
                                <option value="{{$lang}}">{{$name}}</option>
                            @endforeach
                        </select>
                        <x-core::form.input-error field="code" />
                    </div>

                    <div class="mb-5">
                        <label class="form-label me-2">Direction</label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="direction" id="ltr" value="ltr" checked>
                            <label class="form-check-label" for="ltr">Left To Right</label>
                        </div>                       
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="direction" id="rtl" value="rtl">
                            <label class="form-check-label" for="rtl">Right To Left</label>
                        </div>
                        <x-core::form.input-error field="direction" />
                    </div>

                    <div class="lang-avatar mb-3">
                        <label for="lang_img" class="form-label"><span class="d-none d-sm-block">Upload Photo</span></label>
                        <input class="form-control" type="file" id="lang_img" name="lang_img">
                        <x-core::form.input-error field="lang_img" />
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary me-3">Add Language</button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="{{asset('backend/assets/vendor/libs/select2/select2.css')}}" rel="stylesheet" />
@endpush

@push('scripts')
<script src="{{asset('backend/assets/vendor/libs/select2/select2.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.lang-select').wrap('<div class="position-relative"></div>').select2({
            placeholder: 'Select value',
            dropdownParent: $('.lang-select').parent()
        });

       $('.lang_img').on('change', function(){
           
       })
    });
</script>
    
@endpush
