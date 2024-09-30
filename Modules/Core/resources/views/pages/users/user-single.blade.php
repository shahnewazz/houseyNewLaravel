
@isset($user)
<div class="modal-header">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    @php
        $user_profile_picture = $user->profile_picture ? asset('storage/'.$user->profile_picture) : $user->getInitialsAttribute();
    @endphp
    
    <div class="d-flex justify-content-center mb-3">
        @isset($user->profile_picture)
            <div class="avatar avatar-lg rounded-pill">
                <img src="{{$user_profile_picture}}" class="rounded-circle" alt="{{$user->full_name}}">
            </div>
        @else
        <div class="avatar avatar-lg rounded-pill">
            <div class="avatar-text bg-label-danger">{{$user_profile_picture}}</div>
        </div>
        @endisset
    </div>
    <h4 class="text-center mb-6">{{ $user->full_name }}</h4>
    
    <table class="table table-striped">
        <tbody>
            <tr>
                <th>Name:</th>
                <td>{{ $user->full_name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role:</th>
                <td>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($user->roles as $role)
                            <span>{{ucwords(Str::replaceFirst('_', ' ', $role->name))}}</span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <th>Joined:</th>
                <td>{{ $user->created_at->format('F j, Y') }}</td>
            </tr>
            <tr>
                <th>Type:</th>
                <td>
                    {{ ucwords($user->user_type) }}
                </td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>
                    @if ($user->status == 'active')
                        <span class="badge badge-success">
                            {{__('users.active')}}
                        </span>
                    @else
                        <span class="badge badge-danger">
                            {{__('users.inactive')}}
                        </span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>

@else
    {{__('users.user_not_found')}}
@endisset
