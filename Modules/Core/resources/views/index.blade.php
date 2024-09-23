@extends('core::layouts.master')

@section('content')
<div class="card shadow rounded-md">
    <div class="d-flex align-items-start row">
        <div class="col-sm-12">
            <div class="card-body">
                <h5 class="card-title text-primary mb-3">{{__('profile.welcome')}} {{auth()->user()->full_name}} 🎉</h5>
                <p class="mb-6">
                    You have done 72% more sales today.<br>Check your new badge in your profile.
                </p>

                <!-- load all available lang -->

                <a href="{{route('languages.index')}}" class="btn btn-outline-primary">Languages</a>
            </div>
        </div>
    </div>
</div>
@endsection
