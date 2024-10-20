<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">


    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/'.$config['site_favicon'])}}">

    <!-- global style sheet for all pages -->
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/css/core.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/css/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/conca.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/elegant-icon.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/vendor/libs/toastr/toastr.css')}}">
    <link href="{{asset('backend/assets/vendor/libs/sweetalert2/sweetalert2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/vendor/libs/select2/select2.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <style>
        :root {
            --tp-theme-primary: {{ $config['site_primary_color'] }};
            --tp-theme-2: {{ $config['site_secondary_color'] }};
            --tp-grey-1: {{ $config['site_body_color'] }};
            --tp-common-black: {{ $config['site_heading_color'] }};
            --tp-common-falured: {{ $config['site_preloader_overlay'] }};
        }
    
        body {
            color: var(--tp-grey-1);
        }
    </style>
    @stack('styles')
</head>

<body>
   

    <div class="app-main">

        <!-- app wrapper start -->
        <div id="app-wrapper" class="app-wrapper d-flex flex-column align-items-stretch" data-sidebar-collapsed="false">
    
            @include('core::layouts.sidebar')
    
            @include('core::layouts.header')
    
            <!-- app content start -->
            <div class="app-content-wrapper pt-13 pb-3">
                <div class="container ">
                    <div class="page-content">
                        
                        @yield('content')
    
                    </div><!-- page content end -->
                </div>
            </div><!-- app content end -->
    
            <div class="app-backdrop"></div>
            <!-- app content end -->
        </div>
        <!-- app wrapper end -->
    </div>


    <!-- global js scripts for all pages -->
    <script src="{{asset('backend/assets/vendor/js/jquery-v3.7.1.js')}}"></script>
    <script src="{{asset('backend/assets/vendor/js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('backend/assets/vendor/js/core.js')}}"></script>


    <!-- app js -->
    <script src="{{asset('backend/assets/js/conca-sidebar.js')}}"></script>
    <script src="{{asset('backend/assets/js/conca.js')}}"></script>


    <script src="{{asset('backend/assets/vendor/libs/toastr/toastr.js')}}"></script>
    <script src="{{asset('backend/assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
    <script src="{{asset('backend/assets/vendor/libs/select2/select2.js')}}"></script>

    <script>
        'use strict';

        // tab
        $(document).on('click', '.repeater-lang-btn', function(e) {
            e.preventDefault();
            var $this = $(this);
            var code = $this.data('code');

            $this.addClass('active').siblings('.repeater-lang-btn').removeClass('active');
            $this.closest('.repeater-lang-content').find('.repeater-lang-tab').removeClass('active');
            $this.closest('.repeater-lang-content').find('.repeater-lang-tab[data-code="' + code + '"]').addClass('active');

            
        });
        $(document).on('change', '#iconType', function() {
            var $this = $(this);

            $this.closest('.conca-icon-uploader').find('.icon-upload-field').hide();
            $this.closest('.conca-icon-uploader').find('.icon-upload-field[data-type="' + $this.val() + '"]').show();
            
        });

        // ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.conca-select2').each(function() {
            $(this).wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Select Value',
                dropdownParent: $(this).parent()
            });

        });

        $('.input-color').each(function(){
            $(this).siblings('.input-color-placeholder').css('background-color', $(this).val());
        })

        $(document).on('input', '.input-color', function() {
            $(this).siblings('.input-color-placeholder').css('background-color', $(this).val());
        });
        
        // Handle image preview
        $(document).on('change', '.image-input', function (e) {
            var file = e.target.files[0];
            var target = $(this).data('target');
            var resetButton = $(this).data('reset');

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(target).attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                $(resetButton).removeClass('d-none');
            }
        });

        // Handle image reset
        $(document).on('click', '.image-reset', function () {
            var target = $(this).data('target');  
            var input = $(this).closest('.image-upload-container').find('.image-input'); 
            var defaultSrc = $(target).data('default'); 

            $(target).attr('src', defaultSrc); 
            input.val('');
            $(this).addClass('d-none');
        });

        @if($errors->any())
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000",
            };

            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif


        $(document).ready(function() {
            $(document).on('click', '.lang-btn', function() {
                var lang = $(this).data('lang');
                $.ajax({
                    url: "{{ route('admin.languages.change', ':lang') }}".replace(':lang', lang),
                    type: 'POST',
                    data: {
                        lang: lang,
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            })
        });
        
    </script>

    @stack('scripts')
</body>
