@extends('core::layouts.master')

@section('content')
<div class="card mb-5">
    <form id="profile_form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @php
            $user_profile_picture = asset('backend/assets/img/avatar/avatar-placeholder.jpg');
        @endphp
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">

                <img width="120" class="profile-photo" src="{{$user_profile_picture}}" alt="">

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
                    <label for="first_name" class="form-label">First Name</label>
                    <input class="form-control" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}">
                    @error('first_name')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old( 'last_name') }}">
                    @error('last_name')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}">
                    @error('email')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                    @error('username')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" name="role" aria-label="Role">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status" aria-label="Status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control " id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                    @error('address')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input class="form-control" type="text" id="city" name="city" value="{{ old('city') }}">
                    @error('city')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="state" class="form-label">State</label>
                    <input class="form-control" type="text" id="state" name="state" value="{{ old('state') }}">
                    @error('state')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="zipCode" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" id="zipCode" name="zipCode" maxlength="6" value="{{ old('zipCode') }}">
                    @error('zipCode')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}">
                    @error('country')<div class="form-text text-danger">{{ $message }}</div>  @enderror
                </div>
            </div>

            <div class="border-bottom my-6"></div>

            <div class="h3">
                Password
            </div>     
            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                    @error('password') <div class="form-text text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                    @error('password_confirmation') <div class="form-text text-danger">{{ $message }}</div>  @enderror
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
                    $('.profile-photo').attr('src', e.target.result);
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
            $('.profile-photo').attr('src', '{{ $user_profile_picture }}');
            $('.profile-picture-upload').val('');
        });
    });

    
</script>  

@endpush