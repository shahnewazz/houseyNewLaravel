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

                        <div class="user-filter-by-role">
                            <select class="form-select user-filter-role" name="role">
                                <option value="" selected>Select Role</option>
                                @foreach(\Spatie\Permission\Models\Role::whereNotIn('name', ['super_admin'])->get() as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-control-icon flex-grow-1 flex-shrink-1 flex-basis-0">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.22221 13.4444C10.6586 13.4444 13.4444 10.6586 13.4444 7.22221C13.4444 3.78578 10.6586 1 7.22221 1C3.78578 1 1 3.78578 1 7.22221C1 10.6586 3.78578 13.4444 7.22221 13.4444Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M15 15L11.6167 11.6166" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <input type="text" class="" id="user_search" placeholder="Enter Keywords...">
                        </div>
                        @can('users-create')
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary  flex-basis-1">
                            {{__('users.add_user')}}
                        </a>
                        @endcan
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

    $('.user-filter-role').on('change', function() {
        var role = $(this).val();
        var search = $('#user_search').val();

        $.ajax({
            url: "{{ route('admin.users.index') }}",
            type: 'GET',
            data: {
                role: role,
                search: search
            },
            success: function(response) {
                $('#users_list_table').html(response);
            }
        });
    });

    // User Search
    $('#user_search').on('keyup', function() {
        var search = $(this).val();
        var role = $('.user-filter-role').val();
        $.ajax({
            url: "{{ route('admin.users.index') }}",
            type: 'GET',
            data: {
                search: search,
                role: role
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
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        });
    });

    $(document).on('click', '.user-delete-btn', function(e){
        e.preventDefault();

        var username = $(this).data('username');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form').submit();
            }
        });
    })

</script>
@endpush