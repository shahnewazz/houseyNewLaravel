@extends('core::frontend.layouts.master')

@section('content')

@isset($page)
    

    @isset($page->widgets)
        @foreach ($page->widgets as $key => $widget)
            @php
            
                                              
                $dataArr = [
                    'id' => $loop->iteration,
                    'data' => !empty($widget['widget_data']) ? $widget['widget_data'] : [],
                    'code' => app()->getLocale(),
                ];

            @endphp
           

            @if(View::exists('core::frontend.pages.widgets.'.$widget['widget_type']))
            @include('core::frontend.pages.widgets.'.$widget['widget_type'], $dataArr)
            @endif

        @endforeach
    @endisset
@endisset
@endsection
