@extends('core::layouts.master')

@section('content')
<div class="card shadow rounded-md">
    <div class="d-flex align-items-start row">
        <div class="col-sm-12">
            <div class="card-body">
                <form action="{{route('admin.blog.store')}}" method="POST">
                    @csrf
                    @method('POST')

                    <ul class="nav nav-underline mb-3" id="pills-tab" role="tablist">
                        @foreach (\Modules\Core\Models\Language::all() as $lang)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $lang->isDefault == 1 ? ' active' :'' }}" id="pills-{{$lang->code}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$lang->code}}" type="button" role="tab" aria-controls="pills-{{$lang->code}}" aria-selected="true">{{$lang->name}}</button>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @foreach (\Modules\Core\Models\Language::all() as $lang)
                        <div class="tab-pane fade {{ $lang->isDefault == 1 ? ' show active' :'' }}" id="pills-{{$lang->code}}" role="tabpanel" aria-labelledby="pills-{{$lang->code}}-tab" tabindex="0">
                            <div class="alert alert-outline-warning" role="alert">
                                You are adding a blog in <b>{{strtoupper($lang->name)}}</b> language
                            </div>

                            <label for="">Title ({{strtoupper($lang->code)}})</label>
                            <input type="text" name="title[]" class="form-control" {{ $lang->isDefault == 1 ? 'required' :'' }}>
                            <input type="hidden" name="lang[]" value="{{$lang->code}}">
                        </div>
                        @endforeach
                    </div>
                      
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection