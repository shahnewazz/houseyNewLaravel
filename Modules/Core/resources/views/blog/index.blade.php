@extends('core::layouts.master')

@section('content')
<div class="card shadow rounded-md">
    <div class="d-flex align-items-start row">
        <div class="col-sm-12">
            <div class="card-body">
                <form action="{{route('admin.blog.store')}}" method="POST">
                    @csrf
                    @method('POST')

                    @foreach (\Modules\Core\Models\Language::all() as $lang)
                    <label for="">{{$lang->code}}</label>
                    <input type="text" name="title[]" class="form-control" {{ $lang->isDefault == 1 ? 'required' :'' }}>
                    <input type="hidden" name="lang[]" value="{{$lang->code}}">
                    @endforeach



                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
