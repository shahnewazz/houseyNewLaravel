@extends('core::layouts.master')

@section('content')
<div class="card shadow rounded-md">
    <div class="d-flex align-items-start row">
        <div class="col-sm-12">
            <div class="card-body">
                <form action="{{route('xss.post')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="data" class="form-label">Data</label>
                        <input type="text" class="form-control" id="data" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
