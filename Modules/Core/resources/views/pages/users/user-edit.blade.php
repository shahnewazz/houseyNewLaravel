@extends('core::layouts.master')

@section('content')
    <div class="card">
        <div class="card-body">

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
                                <span class="d-none d-sm-block">{{__('users.upload_user_photo')}}</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="profile_picture" name="profile_picture" class="profile-picture-upload" hidden>
                            </label>
                            <button type="button" class="btn btn-outline-secondary profile-picture-reset mb-3 d-none">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">{{__('users.reset')}}</span>
                            </button>
        
                            <div class="form-text">{{__('users.user_photo_size')}}</div>
                        </div>
                    </div>
                    @error('profile_picture')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="card-body pt-4">
                    <div class="row g-6">
                        <div class="col-md-6">
                            <x-core::form.input-label :value="__('First Name')" />
                            <x-core::form.input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" />
                            <x-core::form.input-error field="first_name" />
                        </div>
                        <div class="col-md-6">
                            <x-core::form.input-label for="last_name" :value="__('Last Name')" />
                            <x-core::form.input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" />
                            <x-core::form.input-error field="last_name" />
                        </div>
                        <div class="col-md-6">
                            <x-core::form.input-label for="email" :value="__('E-mail')" />
                            <x-core::form.input type="email" id="email" name="email" value="{{ old('email') }}" />
                            <x-core::form.input-error field="email" />
                        </div>
                        <div class="col-md-6">
                            <x-core::form.input-label for="username" :value="__('Username')" />
                            <x-core::form.input type="text" id="username" name="username" value="{{ old('username') }}" />
                            <x-core::form.input-error field="username" />
                        </div>
                        @php
                            $roles = \Spatie\Permission\Models\Role::all();
                        @endphp
                        <div class="col-md-6">
                            <x-core::form.input-label for="role" :value="__('Role')" />
                            <select class="form-select" name="role" aria-label="Role">
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{ucwords(Str::replaceFirst('_', ' ', $role->name))}}</option>
                                @endforeach
                            </select>
                            <x-core::form.input-error field="role" />
                        </div>
                        <div class="col-md-6">
                            <x-core::form.input-label for="status" :value="__('Status')" />
                            <select class="form-select" name="status" aria-label="Status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <x-core::form.input-error field="status" />
                        </div>
                        <div class="col-md-6">
                            <x-core::form.input-label for="phone" :value="__('Phone Number')" />
                            <x-core::form.input type="text" id="phone" name="phone" value="{{ old('phone') }}" />
                            <x-core::form.input-error field="phone" />
                        </div>
                        <div class="col-md-6">
                            <x-core::form.input-label for="address" :value="__('Address')" />
                            <x-core::form.input type="text" id="address" name="address" value="{{ old('address') }}" />
                            <x-core::form.input-error field="address" />
                        </div>
                        <div class="col-md-6">
                            <x-core::form.input-label for="city" :value="__('City')" />
                            <x-core::form.input type="text" id="city" name="city" value="{{ old('city') }}" />
                            <x-core::form.input-error field="city" />
                        </div>
                        <div class="col-md-6">
                            <x-core::form.input-label for="state" :value="__('State')" />
                            <x-core::form.input type="text" id="state" name="state" value="{{ old('state') }}" />
                            <x-core::form.input-error field="state" />
                        </div>
                        <div class="col-md-6">
                            <x-core::form.input-label for="zipCode" :value="__('Zip Code')" />
                            <x-core::form.input type="text" id="zipCode" name="zipCode" value="{{ old('zipCode') }}" />
                            <x-core::form.input-error field="zipCode" />
                        </div>
                        <div class="col-md-6">
                            <x-core::form.input-label for="country" :value="__('Country')" />
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
                            <x-core::form.input-label for="password" :value="__('Password')" />
                            <x-core::form.input type="text" id="password" name="password" />
                            <x-core::form.input-error field="password" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-md-6">
                            <x-core::form.input-label for="password_confirmation" :value="__('Confirm Password')" />
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
    </div>
@endsection