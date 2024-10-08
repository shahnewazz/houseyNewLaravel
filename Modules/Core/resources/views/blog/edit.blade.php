@extends('core::layouts.master')

@section('content')
<div class="card shadow rounded-md">
    <div class="d-flex align-items-start row">
        <div class="col-sm-12">
            <div class="card-body">
                @isset($blog)
                    <form action="{{route('admin.blog.update', ['id' => $blog->id])}}" method="POST">
                        @csrf
                        @method('PUT')

                        @foreach (\Modules\Core\Models\Language::all() as $lang)
                        @php
                            
                            if ($lang->code == 'en') {
                                $title = $blog->title;
                            } else {
                                
                                $translation = $blog->translations->where('field_name', 'title')->where('language_code', $lang->code)->first();
                                $title = $translation ? $translation->content : '';
                            }
                        @endphp
                
                        <div class="form-group">
                            <label for="">{{ $lang->code }}</label>
                            <input type="text" name="title[]" value="{{ $title }}" class="form-control" {{ $lang->isDefault == 1 ? 'required' :'' }}>
                            <input type="hidden" name="lang[]" value="{{ $lang->code }}">
                        </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>
                @else
                <div class="alert alert-outline-danger">
                    Blog not found
                </div>
                @endisset
            </div>
        </div>
    </div>
</div>
@endsection
