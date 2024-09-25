@extends('core::layouts.master')

@section('content')
    <div class="card">
        <div class="card-body">

            @isset($user)
                <ul>
                    @php
                        $user->profile_picture = $user->profile_picture ? asset('storage/'.$user->profile_picture) : asset('backend/assets/img/avatar/avatar-placeholder.jpg');
                    @endphp
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md me-2">
                                <img src="{{$user->profile_picture}}" class="rounded-circle" alt="{{$user->full_name}}">
                            </div>
                            <span>{{ $user->full_name }}</span>
                        </div>
                    </li>
                    <li>
                        {{ $user->email }}
                    </li>
                    <li>
                        Admin
                    </li>
                    <li>
                        {{ $user->created_at->format('F j, Y') }}
                    </li>
                    <li>
                        @if ($user->status == 'active')
                            <span class="badge badge-success">
                                {{__('users.active')}}
                            </span>
                        @else
                            <span class="badge badge-danger">
                                {{__('users.inactive')}}
                            </span>
                        @endif
                    </li>
                </ul>

            @else
                {{__('users.user_not_found')}}
            @endisset
            
            
        </div>
    </div>
@endsection