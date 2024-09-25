@extends('core::layouts.master')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="d-flex align-items-center">
                <h4 class="card-title m-0">{{__('users.all_users')}}</h4>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary ms-auto">
                    {{__('users.add_user')}}
                </a>
            </div>

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
@endsection