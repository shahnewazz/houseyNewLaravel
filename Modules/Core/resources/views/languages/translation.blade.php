@extends('core::layouts.master')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="d-flex mb-5 align-items-center">
            <h2 class="card-title m-0">Translations ({{ $lang }})</h2>
            <a href="{{ route('languages.translate', ['code' => $lang]) }}" class="btn btn-primary ms-auto">Back</a>
        </div>
        <table class="table">
            <thead class="table-light">
                <th>Key</th>
                <th>Value</th>
                <th>Action</th>
            </thead>
            <tbody>
                

                @foreach($translations as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>
                        <span class="value-display" data-key="{{ $key }}">{{ $value }}</span>
                        <input type="text" class="value-edit d-none" data-key="{{ $key }}" value="{{ $value }}">
                    </td>
                    <td>
                        <button class="edit-btn btn btn-sm btn-primary" data-key="{{ $key }}">Edit</button>
                        <button class="save-btn btn btn-sm btn-success d-none" data-key="{{ $key }}">Save</button>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Handle edit button click
        $('.edit-btn').on('click', function () {
            var key = $(this).data('key');
            $('span.value-display[data-key="' + key + '"]').hide();
            $('input.value-edit[data-key="' + key + '"]').removeClass('d-none');
            $(this).hide();
            $('.save-btn[data-key="' + key + '"]').removeClass('d-none');
        });
    
        // Handle save button click (AJAX request)
        $('.save-btn').on('click', function () {
            var key = $(this).data('key');
            var newValue = $('input.value-edit[data-key="' + key + '"]').val();
            var lang = "{{ $lang }}";
            var file = "{{ $file }}";

            $.ajax({
                url: "{{ route('translations.update', ['lang' => $lang, 'file' => $file]) }}",
                type: 'POST',
                data: {
                    key: key,
                    value: newValue,
                    lang: lang,
                    file: file,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        $('span.value-display[data-key="' + key + '"]').text(newValue).show();
                        $('input.value-edit[data-key="' + key + '"]').hide();
                        $('.save-btn[data-key="' + key + '"]').hide();
                        $('.edit-btn[data-key="' + key + '"]').show();
                        alert('Translation updated successfully.');
                    } else {
                        alert('Failed to update translation.');
                    }
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        });

    });
</script>
@endpush