@extends('core::layouts.master')

@section('content')
<div class="card mb-5">
    <form id="profile_form" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @php
            $user_profile_picture = "IMG";
        @endphp
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">

                <div class="avatar avatar-lg rounded">
                    <img width="120" class="profile-photo position-absolute start-0 top-0 z-1 visually-hidden" src="" alt="">
                    <div class="avatar-text fs-4 bg-label-success">{{$user_profile_picture}}</div>
                </div>

                <div class="button-wrapper">
                    <label for="profile_picture" class="btn btn-primary me-3 mb-3" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="profile_picture" name="profile_picture" class="profile-picture-upload" hidden>
                    </label>
                    <button type="button" class="btn btn-outline-secondary profile-picture-reset mb-3 d-none">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>

                    <div class="form-text">Allowed JPG or PNG. Max size of 2Mb</div>
                </div>
            </div>
            @error('profile_picture')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="card-body pt-4">
            <div class="row g-6">
                <div class="col-md-6">
                    <x-core::form.input-label :value="'First Name'" />
                    <x-core::form.input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" />
                    <x-core::form.input-error field="first_name" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="last_name" :value="'Last Name'" />
                    <x-core::form.input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" />
                    <x-core::form.input-error field="last_name" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="email" :value="'E-mail'" />
                    <x-core::form.input type="email" id="email" name="email" value="{{ old('email') }}" />
                    <x-core::form.input-error field="email" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="username" :value="'Username'" />
                    <x-core::form.input type="text" id="username" name="username" value="{{ old('username') }}" />
                    <x-core::form.input-error field="username" />
                </div>
                @php
                    $roles = \Spatie\Permission\Models\Role::whereNotIn('name', ['super_admin'])->get();
                @endphp
                <div class="col-md-6">
                    <x-core::form.input-label for="role" :value="'Role'" />
                    <select class="form-select user-role-select" name="role[]" aria-label="Role" multiple>
                        @foreach ($roles as $role)
                        <option value="{{$role->name}}">{{ucwords(Str::replaceFirst('_', ' ', $role->name))}}</option>
                        @endforeach
                    </select>
                    <x-core::form.input-error field="role" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="user_type" :value="'User Type'" />
                    <select class="form-select user-type-select" name="user_type" aria-label="user_type">
                        <option value="normal" selected>Normal</option>
                        <option value="admin">Admin</option>
                    </select>
                    <x-core::form.input-error field="user_type" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="status" :value="'Status'" />
                    <select class="form-select" name="status" aria-label="Status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <x-core::form.input-error field="status" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="phone" :value="'Phone Number'" />
                    <x-core::form.input type="text" id="phone" name="phone" value="{{ old('phone') }}" />
                    <x-core::form.input-error field="phone" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="address" :value="'Address'" />
                    <x-core::form.input type="text" id="address" name="address" value="{{ old('address') }}" />
                    <x-core::form.input-error field="address" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="city" :value="'City'" />
                    <x-core::form.input type="text" id="city" name="city" value="{{ old('city') }}" />
                    <x-core::form.input-error field="city" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="state" :value="'State'" />
                    <x-core::form.input type="text" id="state" name="state" value="{{ old('state') }}" />
                    <x-core::form.input-error field="state" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="zip_code" :value="'Zip Code'" />
                    <x-core::form.input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" />
                    <x-core::form.input-error field="zipCode" />
                </div>
                <div class="col-md-6">
                    <x-core::form.input-label for="country" :value="'Country'" />
                    <x-core::form.input type="text" id="country" name="country" value="{{ old('country') }}" />
                    <x-core::form.input-error field="country" />
                </div>
            </div>

            <div class="border-bottom my-6"></div>

            <div class="h3">
                Password
            </div>     
            <div class="row mb-6">
                <div class="col-md-6">
                    <x-core::form.input-label for="password" :value="'Password'" />
                    <x-core::form.input type="password" id="password" name="password" />
                    <x-core::form.input-error field="password" />
                </div>
            </div>
            <div class="row mb-6">
                <div class="col-md-6">
                    <x-core::form.input-label for="password_confirmation" :value="'Confirm Password'" />
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                    <x-core::form.input-error field="password_confirmation" />
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn btn-primary me-3">Create User</button>
            </div>
        </div>
    </form>
</div>


@endsection


@push('scripts')

<script>
    'use strict';

    $(document).ready(function() {

        $('.user-role-select').wrap('<div class="position-relative"></div>').select2({
            placeholder: 'Select value',
            dropdownParent: $('.user-role-select').parent()
        });


        $('#profile_form').on('submit', function(){
            $('[name=username]').removeAttr('disabled');
        })

        // Profile Picture Upload
        $('.profile-picture-upload').on('change', function() {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.profile-photo').attr('src', e.target.result).removeClass('visually-hidden');;
                }
                reader.readAsDataURL(input.files[0]);

                $('.profile-picture-reset').removeClass('d-none');
            } else {
                $('.profile-photo').attr('src', '{{ $user_profile_picture }}');
                alert('Please select a valid image file');
                
            }
        });

        // Profile Picture Reset
        $('.profile-picture-reset').on('click' ,function() {
            $('.profile-photo').attr('src', '{{ $user_profile_picture }}').addClass('visually-hidden');;
            $('.profile-picture-upload').val('');
        });
    });

    
</script>  
@endpush