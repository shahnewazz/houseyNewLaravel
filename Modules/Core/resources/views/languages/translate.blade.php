@extends('core::layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex mb-5 align-items-center">
            <h2 class="card-title m-0">Translations {{$language->name}}</h2>
            <a href="{{ route('admin.languages.index') }}" class="btn btn-primary ms-auto">Back</a>
        </div>
        <table class="table">
            <thead class="table-light">
                <th>SN</th>
                <th>Types</th>
                <th>
                    Action
                </th>
            </thead>
            <tbody>
                @foreach($files as $key => $file)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucwords($file) }}</td>
                        <td>
                           <a class="btn btn-primary" href="{{ route('admin.languages.translations.show', ['file' => $file, 'lang' => $code]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $files->links('core::components.pagination') !!}
    </div>
</div>

@endsection

@push('scripts')

@endpush