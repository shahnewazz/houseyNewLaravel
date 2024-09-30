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
                        <div class="">
                            <label for="lang_img" class="btn btn-primary me-3 mb-3" tabindex="0">
                                <span class="d-none d-sm-block">Upload Flag</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="lang_img" name="lang_img" id="lang_img" hidden>
                            </label>
                            
                            <button class="btn btn-outline-secondary lang-flag-img-reset mb-3 d-none">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>
                        </div>
                        <img class="lang-flag-img visually-hidden" src="" alt="" width="80px">
                        <div class="form-text">Allowed JPG or PNG. Max size of 512KB</div>
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


@push('scripts')

<script>
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
                    $('.lang-flag-img').attr('src', e.target.result).removeClass('visually-hidden');;
                }
                reader.readAsDataURL(input.files[0]);

                $('.lang-flag-img-reset').removeClass('d-none');
            } else {
                alert('Please select a valid image file');
                
            }
       })

         $('.lang-flag-img-reset').on('click', function(e) {
            e.preventDefault();
            $('#lang_img').val('');
            $('.lang-flag-img').addClass('visually-hidden');
            $(this).addClass('d-none');
         })
    });
</script>
    
@endpush
