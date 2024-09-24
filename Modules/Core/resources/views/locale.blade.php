@extends('core::layouts.master')

@section('content')
<div class="card shadow rounded-md">
    <div class="card-body">
        <h5 class="card-title">Change Language {{__('profile.welcome')}}</h5>

        <form action="{{route('locale')}}" method="post">
            @csrf
            <select name="lang" id="locale" class="form-control">
                <option value="en" {{app()->getLocale() == 'en' ? 'selected' : ''}}>English</option>
                <option value="bds" {{app()->getLocale() == 'bds' ? 'selected' : ''}}>Bangla</option>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Change</button>
        </form>
    </div>
</div>
@endsection
