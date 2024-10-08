@extends('core::layouts.master')

@section('content')
<div class="card shadow rounded-md">
    <div class="d-flex align-items-start row">
        <div class="col-sm-12">
            <div class="card-body">
                @isset($blog)
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
                @endisset
            </div>
        </div>
    </div>
</div>
@endsection
