@extends('core::frontend.layouts.master')

@section('content')

@isset($page)
    

    @isset($page->widgets)
        @foreach ($page->widgets as $key => $widget)
            @php
            
                $code = request()->query('code', 'en');
                $dataArr = [
                    'id' => $loop->iteration,
                    'data' => !empty($widget['widget_data']) ? $widget['widget_data'] : [],
                    'code' => $code,
                ];

            @endphp
            @include('core::frontend.pages.widgets.'.$widget['widget_type'], $dataArr)
        @endforeach
    @endisset
@endisset
@endsection
