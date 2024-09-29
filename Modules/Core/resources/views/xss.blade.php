@extends('core::layouts.master')

@section('content')
<div class="card shadow rounded-md">
    <div class="d-flex align-items-start row">
        <div class="col-sm-12">
            <div class="card-body">
                {{$data}}
                {!! $data !!}
            </div>
        </div>
    </div>
</div>
@endsection
