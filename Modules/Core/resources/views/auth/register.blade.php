@extends('core::layouts.guest')


@section('guest-content')

<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card p-5 shadow">
                <form id="register-form" method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="row g-6">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input class="form-control" type="text" id="first_name" name="first_name" value="{{old('first_name')}}">
                            @error('first_name') <div class="form-text text-danger">{{ $message }}</div>  @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input class="form-control" type="text" id="last_name" name="last_name" value="{{old('last_name')}}">
                            @error('last_name') <div class="form-text text-danger">{{ $message }}</div>  @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{old('email')}}">
                            @error('email') <div class="form-text text-danger">{{ $message }}</div>  @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}">
                            @error('username') <div class="form-text text-danger">{{ $message }}</div>  @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                            @error('password') <div class="form-text text-danger">{{ $message }}</div>  @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirmation Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}">
                            @error('password_confirmation') <div class="form-text text-danger">{{ $message }}</div>  @enderror
                        </div>
                    </div>
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary me-3">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script type="module">
    $(document).ready(function () {
        $('#register-form').validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 3
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                username: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }
            },
            messages: {
                first_name: {
                    required: "First name is required",
                    minlength: "First name must be at least 3 characters"
                },
                last_name: {
                    required: "Last name is required",
                    minlength: "Last name must be at least 3 characters"
                },
                email: {
                    required: "Email is required",
                    email: "Please enter a valid email address"
                },
                username: {
                    required: "Username is required",
                },
                password: {
                    required: "Password is required",
                    minlength: "Password must be at least 6 characters"
                },
                password_confirmation: {
                    required: "Confirmation password is required",
                    minlength: "Confirmation password must be at least 6 characters",
                    equalTo: "Password and confirmation password must match"
                }
            }
        });

    });
</script>
    
@endpush