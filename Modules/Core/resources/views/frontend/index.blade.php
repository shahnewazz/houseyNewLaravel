@extends('core::frontend.layouts.master')

@section('title')
{{$page->title}}
@endsection

@section('content')
<a href="{{$page->slug}}">{{$page->title}}</a>
@endsection