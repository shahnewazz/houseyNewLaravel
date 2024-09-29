
@isset($user)
<div class="modal-header">
    <h1 class="modal-title fs-5" id="userEditLabel">{{$user->full_name}}</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <ul>
        @php
            $user_profile_picture = $user->profile_picture ? asset('storage/'.$user->profile_picture) : $user->getInitialsAttribute();
        @endphp
        <li>
            <div class="d-flex align-items-center">
                @isset($user->profile_picture)
                    <div class="avatar avatar-status-online rounded-pill">
                        <img src="{{$user_profile_picture}}" class="rounded-circle" alt="{{$user->full_name}}">
                    </div>
                @else
                <div class="avatar rounded-pill">
                    <div class="avatar-text bg-label-danger">{{$user_profile_picture}}</div>
                </div>
                @endisset
                <span>{{ $user->full_name }}</span>
            </div>
        </li>
        <li>
            {{ $user->email }}
        </li>
        <li>
            @foreach ($user->roles as $role)
                <span class="badge badge-label-success">{{ucwords(Str::replaceFirst('_', ' ', $role->name))}}</span>
                <br />
            @endforeach
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
</div>

@else
    {{__('users.user_not_found')}}
@endisset
