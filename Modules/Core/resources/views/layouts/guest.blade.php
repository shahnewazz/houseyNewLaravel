<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('guest-title') - {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">


    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/img/logo/favicon.png" type="image/x-icon">

    <!-- global style sheet for all pages -->
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/css/core.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/conca.css')}}">

    @stack('styles')
</head>

<body>
   

    @yield('guest-content')


    <!-- global js scripts for all pages -->
    <script src="{{asset('backend/assets/vendor/js/jquery-v3.7.1.js')}}"></script>
    <script src="{{asset('backend/assets/vendor/js/core.js')}}"></script>


    @stack('scripts')
    <script>
        'use strict';

        $(document).ready(function() {
            $('[data-width]').each(function() {
                $(this).css('width', $(this).data('width'))
            });
        });
    </script>
</body>
