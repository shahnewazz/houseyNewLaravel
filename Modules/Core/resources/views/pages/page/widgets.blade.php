@extends('core::layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
        @isset($page)
            <p>{{$page->widgets}}</p>
        @endisset
    </div>
</div>
@endsection