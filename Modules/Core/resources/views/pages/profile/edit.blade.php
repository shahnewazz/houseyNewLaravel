@extends('core::layouts.master')

@section('content')
<div class="card mb-5">
    <form id="profile_form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @php

            $user_profile_picture = $user->profile_picture == null ? $user->getInitialsAttribute() : asset('storage/'.$user->profile_picture);
        @endphp

        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                @isset($user->profile_picture)
                    <!-- profile photo from DB -->
                    <img width="120" class="profile-photo" src="{{asset('storage/'.$user->profile_picture)}}" alt="">
                @else
                    <!-- placeholder photo -->
                    <div class="avatar avatar-lg rounded">
                        <img width="120" class="profile-photo position-absolute start-0 top-0 z-1 visually-hidden" src="" alt="">
                        <div class="avatar-text bg-label-success">{{$user_profile_picture}}</div>
                    </div>
                @endisset
            

                <div class="button-wrapper">
                    <label for="profile_picture" class="btn btn-primary me-3 mb-3" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        
                        @isset($user->profile_picture)
                            <input type="file" id="profile_picture" name="profile_picture" name="profile_picture" class="profile-picture-upload" hidden>
                        @else
                            <input type="file" id="profile_picture" name="profile_picture" class="profile-picture-upload" hidden>
                        @endisset
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
                    <label for="first_name" class="form-label">First Name</label>
                    <input class="form-control" type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                    @error('first_name')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old( 'last_name', $user->last_name) }}">
                    @error('last_name')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" type="text" id="email" name="email" value="{{ old('email',  $user->email ) }}">
                    @error('email')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" disabled>
                    @error('username')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status" aria-label="Select Status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control " id="phone" name="phone" value="{{ old('phone' ,$user->phone ) }}">
                    @error('phone')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
                    @error('address')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input class="form-control" type="text" id="city" name="city" value="{{ old('city', $user->city) }}">
                    @error('city')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="state" class="form-label">State</label>
                    <input class="form-control" type="text" id="state" name="state" value="{{ old('state', $user->state) }}">
                    @error('state')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="zipCode" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" id="zipCode" name="zipCode" maxlength="6" value="{{ old('zipCode', $user->zipCode ) }}">
                    @error('zipCode')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $user->country) }}">
                    @error('country')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="btn btn-primary me-3">Save changes</button>
            </div>
        </div>
    </form>
</div>

<div class="card">
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')
           
        <div class="card-body">
            <div class="h3">
                Password
            </div>     
            <div class="row g-6">
                <div class="col-md-6">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input class="form-control" type="password" id="current_password" name="current_password" >
                    @error('current_password') <div class="form-text text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="update_password_password" class="form-label">New Password</label>
                    <input class="form-control" type="password" name="password" id="update_password_password">
                    @error('password') <div class="form-text text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" id="update_password_password_confirmation">
                    @error('password_confirmation') <div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="btn btn-primary me-3">Update Password</button>
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    "use strict";

    $(document).ready(function() {

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
                    $('.profile-photo').attr('src', e.target.result).removeClass('visually-hidden');
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
            $('.profile-photo').attr('src', '{{ $user_profile_picture }}').addClass('visually-hidden');
            $('.profile-picture-upload').val('');
        });
    });

    
</script>  

@endpush