@extends('core::layouts.master')

@section('title', 'Settings')

@section('content')
    @include('core::pages.settings._nav')

@php
    $settings = \Modules\Core\Models\SiteSetting::all()->pluck('value', 'key')->toArray();  
    $partials = [
        '_general' => 'General',
        '_business' => 'Business',
        '_interface' => 'Interface',
    ];  
@endphp

    @foreach ($partials as $key => $label)
        @include('core::pages.settings.partials.general.'.$key, ['settings' => $settings])
    @endforeach

@endsection


@push('scripts')
<script>
    "use strict";

    $(document).ready(function(){

        // Handle number input & check it is positive
        $('input[type="number"]').on('input', function(){
            if($(this).val() < 1){
                $(this).val(1);
            }
        });

    });
</script>
    
@endpush