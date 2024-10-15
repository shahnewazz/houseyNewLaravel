@extends('core::frontend.layouts.master')

@section('content')

{{-- @foreach (\Modules\Core\Models\Language::all() as $lang)
<a href="{{ route('change.language', $lang->code) }}">{{$lang->name}}</a>
@endforeach

@foreach ($translatedBlogs as $translatedBlog)
    <h2>{{ $translatedBlog['translations']['title'] }}</h2>
    <!-- You can also display other fields like description if needed -->
@endforeach

<!-- You can add more translatable fields similarly --> --}}

@isset($page)
    @php
        var_dump($page);
    @endphp
@endisset
@endsection
