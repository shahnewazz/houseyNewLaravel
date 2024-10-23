<!doctype html>
<html class="no-js" lang="zxx" dir="{{ session('lang_dir', 'ltr') }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>@yield('title')</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
       
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <!-- Place favicon.ico in the root directory -->
      <link rel="shortcut icon" type="image/x-icon" href="{{'storage/'.$config['site_favicon']}}">

      <!-- CSS here -->
      <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/assets/css/swiper-bundle.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/assets/css/font-awesome-pro.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/assets/css/ion.rangeSlider.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/assets/css/flatpicker-min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/assets/css/spacing.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">

      <!-- toastr -->
      <link rel="stylesheet" href="{{asset('backend/assets/vendor/libs/toastr/toastr.css')}}">

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
   </head>
   <body>

      @if ($config['site_preloader'] == 'on')
         <div id="loading">
            <div class="loading"></div>
         </div>
      @endif

    @yield('content')

    
      
    <!-- JS here -->
    <script src="{{asset('frontend/assets/js/vendor/jquery.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/waypoints.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap-bundle.js')}}"></script>
    <script src="{{asset('frontend/assets/js/swiper-bundle.js')}}"></script>
    <script src="{{asset('frontend/assets/js/imagesloaded-pkgd.js')}}"></script>
    <script src="{{asset('frontend/assets/js/isotope-pkgd.js')}}"></script>
    <script src="{{asset('frontend/assets/js/magnific-popup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/nice-select.js')}}"></script>
    <script src="{{asset('frontend/assets/js/purecounter.js')}}"></script>
    <script src="{{asset('frontend/assets/js/wow.js')}}"></script>
    <script src="{{asset('frontend/assets/js/ajax-form.js')}}"></script>
    <script src="{{asset('frontend/assets/js/flatpicker.js')}}"></script>
    <script src="{{asset('frontend/assets/js/parallax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jarallax.js')}}"></script>
    <script src="{{asset('frontend/assets/js/parallax-scroll.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.mb.YTPlayer.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/slider-init.js')}}"></script>
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>


    <!-- others -->
    <script src="{{asset('backend/assets/vendor/libs/toastr/toastr.js')}}"></script>

    <script>
      'use strict';
              // ajax setup
              $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

      $(document).ready(function() {
            $(document).on('click', '.lang-btn', function() {
                var code = $(this).data('lang');
                $.ajax({
                    url: "{{ route('set-lang', ':code') }}".replace(':code', code),
                    type: 'POST',
                    data: {
                        code: code,
                    },
                    success: function(response) {
                       if(response.status){
                        toastr.success(response.message);
                           setTimeout(function() {
                              location.reload();
                           }, 1000);
                       }
                    },
                     error: function(xhr, status, error) {
                        toastr.error('Something went wrong');
                     }
                });
            })
        });
    </script>
   </body>
</html>
