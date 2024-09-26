@extends('core::layouts.master')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row align-items-center mb-6">
                <div class="col-xl-5">
                    <h4 class="card-title m-0">{{__('users.all_users')}}</h4>
                </div>
                <div class="col-xl-7">
                    <div class="d-flex gap-6">
                        <div class="form-control-icon flex-grow-1 flex-shrink-1 flex-basis-0">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.22221 13.4444C10.6586 13.4444 13.4444 10.6586 13.4444 7.22221C13.4444 3.78578 10.6586 1 7.22221 1C3.78578 1 1 3.78578 1 7.22221C1 10.6586 3.78578 13.4444 7.22221 13.4444Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M15 15L11.6167 11.6166" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <input type="text" class="" id="user_search" placeholder="Enter Keywords...">
                        </div>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary  flex-basis-1">
                            {{__('users.add_user')}}
                        </a>
                    </div>
                </div>
            </div>

            

            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>{{__('users.name')}}</th>
                            <th>{{__('users.email')}}</th>
                            <th>{{__('users.role')}}</th>
                            <th>{{__('users.joined')}}</th>
                            <th>{{__('users.status')}}</th>
                            <th>{{__('users.actions')}}</th>
                        </tr>
                    </thead>
    
                    <tbody id="users_list_table">
                        @include('core::pages.users.partials._users-table', ['users' => $users])
                    </tbody>
    
                </table>
            </div>
        </div>
    </div>

  
<!-- Modal -->
<div class="modal fade" id="userEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
     "use strict";

    // User Search
    $('#user_search').on('keyup', function() {
        var search = $(this).val();
        $.ajax({
            url: "{{ route('admin.users.index') }}",
            type: 'GET',
            data: {
                search: search
            },
            success: function(response) {
                $('#users_list_table').html(response);
            }
        });
    });

    // Pagination
    $(document).on('click', '.tp-pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var search = $('#user_search').val();

        // add page query string to the URL
        window.history.pushState("", "", '?page=' + page);


        $.ajax({
            url: "{{ route('admin.users.index') }}",
            type: 'GET',
            data: {
                page: page,
                search: search
            },
            success: function(response) {
                $('#users_list_table').html(response);
            }
        });
    });


    $(document).on('click', '.show-user-btn', function(){
        let username = $(this).data('username');
        
        $.ajax({
            url: "{{ route('admin.users.show', ':username') }}".replace(':username', username),
            type: 'GET',
            data: {
                username: username
            },
            beforeSend: function() {
                $('.app-backdrop').addClass('show');
            },
            success: function(response) {
                $('#userEdit .modal-content').html(response);
                $('.app-backdrop').removeClass('show');
                $('#userEdit').modal('show');
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

</script>
@endpush