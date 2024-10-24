@extends('core::frontend.layouts.master')

@section('content')

@isset($page)
    

    @if(isset($page->widgets) && !empty($page->widgets))
        @foreach (unserialize($page->widgets) as $key => $widget)
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
    @endif
@endisset
@endsection
