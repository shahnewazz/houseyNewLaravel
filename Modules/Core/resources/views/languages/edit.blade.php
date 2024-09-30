@extends('core::layouts.master')

@section('content')

@isset($language)
    
<div class="card">
    <div class="card-body">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h4 class="m-0">Edit Language {{$language->name}}</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.languages.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{ route('admin.languages.update', ['id' => $language->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <div class="row g-6">
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
            </div> --}}

            <div class="col-md-6">
                <div class="mb-5">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $language->name) }}">
                    <x-core::form.input-error field="name" />
                </div>

                <div class="mb-5">
                    <label for="code" class="form-label">Language Code</label>
                    <select class="form-select lang-select" name="code" id="code">
                        @foreach (config('app.languages') as $lang => $name)
                            <option value="{{$lang}}" @if ($language->code == $lang) selected @endif>{{$name}}</option>
                        @endforeach
                    </select>
                    <x-core::form.input-error field="code" />
                </div>

                <div class="mb-5">
                    <label class="form-label me-2">Direction</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="direction" id="ltr" value="ltr" @if($language->direction == 'ltr') checked @endif>
                        <label class="form-check-label" for="ltr">Left To Right</label>
                    </div>                       
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="direction" id="rtl" value="rtl" @if($language->direction == 'rtl') checked @endif>
                        <label class="form-check-label" for="rtl">Right To Left</label>
                    </div>
                    <x-core::form.input-error field="direction" />
                </div>

                <div class="lang-avatar mb-3">
                    <div class="row">
                        <div class="col-sm-2">
                            @isset($language->image)

                            @php
                                $image = asset('storage/'.$language->image);
                            @endphp
    
                            <div class="avatar avatar-lg rounded mb-3">
                                <img class="lang-avatar" src="{{ $image }}" alt="{{$language->name}}">
                            </div>
                        @endisset
                        </div>
                        <div class="col-sm-4">
                            <label for="lang_img" class="btn btn-primary me-3 mb-3" tabindex="0">
                                <span class="d-none d-sm-block">Upload New Flag</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="lang_img" name="lang_img" id="lang_img" hidden>
                            </label>
                            <button class="btn btn-outline-secondary lang-reset-btn d-none">Reset</button>
                        </div>
                    </div>
                    <x-core::form.input-error field="lang_img" />
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary me-3">Save changes</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endisset

@endsection

@push('styles')
<link href="{{asset('backend/assets/vendor/libs/select2/select2.css')}}" rel="stylesheet" />
@endpush

@push('scripts')
<script src="{{asset('backend/assets/vendor/libs/select2/select2.js')}}"></script>
    
<script>
    'use strict';

     $(document).ready(function() {
        $('.lang-select').wrap('<div class="position-relative"></div>').select2({
            placeholder: 'Select value',
            dropdownParent: $('.lang-select').parent()
        });

       $('#lang_img').on('change', function(){

            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.lang-avatar').attr('src', e.target.result)
                }
                reader.readAsDataURL(input.files[0]);

                $('.lang-reset-btn').removeClass('d-none');
            } else {
                $('.lang-avatar').attr('src', '{{ $image }}');
                alert('Please select a valid image file');
                
            }
       })

        $('.lang-reset-btn').on('click', function(){
            $('#lang_img').val('');
            $('.lang-avatar').attr('src', '{{ $image }}');
            $(this).addClass('d-none');
        })
    });
</script>

@endpush