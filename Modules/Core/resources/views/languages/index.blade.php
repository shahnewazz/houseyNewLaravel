@extends('core::layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h4 class="m-0">Languages</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.languages.create') }}" class="btn btn-primary">Add Language</a>
            </div>
        </div>
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Code</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Default</th>
                    <th scope="col">Translations</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="lang_body">
                @include('core::languages._lang-table', ['languages' => $languages])
            </tbody>
        </table>
        
    </div>
</div>
@endsection

@push('scripts')
<script>
    "use strict";

    $(document).ready(function(){


        $(document).on('click', '.lang-del-btn', function(e){
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                html: "All Translations will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });

        })


        $(document).on('change', 'input[name="isDefault"]',  function(){
            var id = $(this).attr('id').split('_')[1];
            var status = $(this).prop('checked') ? 1 : 0;
            
            $.ajax({
                url: "{{ route('admin.languages.default') }}",
                type: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function(response){
                    if(response.html){
                        toastr.success('Language set as default');
                        $('#lang_body').html(response.html);
                    }
                    
                }
            });
        });

        // make ajax call when click on status switch
        $(document).on('change', 'input[name="status"]', function(){
            var id = $(this).attr('id').split('_')[1];
            var status = $(this).prop('checked') ? 1 : 0;
            $.ajax({
                url: "{{ route('admin.languages.status') }}",
                type: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function(response){
                    if(response.html){
                        toastr.success('Language status updated');
                        $('#lang_body').html(response.html);
                    } 
                },
                error: function(xhr, status, error, response){
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        toastr.error(xhr.responseJSON.error); 
                        $('#lang_body').html(xhr.responseJSON.html);
                    } else {
                        toastr.error('An error occurred while setting the default language. Please try again.');
                        $('#lang_body').html(xhr.responseJSON.html);
                    }
                }
            });
        });
    });
</script>
@endpush