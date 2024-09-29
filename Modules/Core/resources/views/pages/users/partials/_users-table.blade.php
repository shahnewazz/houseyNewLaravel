
@isset($users)
@php
    $init_classes = ['danger', 'success', 'warning', 'info', 'primary'];
@endphp
@forelse ($users as $user)
    @php
        $user_profile_picture = $user->profile_picture != null ? asset('storage/'.$user->profile_picture) : $user->getInitialsAttribute();
    @endphp

    <tr>
        <td>
            <div class="d-flex align-items-center">               

                @isset($user->profile_picture)
                <div class="avatar avatar-md me-2">
                    <img src="{{$user_profile_picture}}" class="rounded-circle" alt="{{$user->full_name}}">
                </div>
                @else
                <div class="avatar avatar-md rounded-pill me-2">
                    <div class="avatar-text bg-label-{{$init_classes[array_rand($init_classes)]}}">{{$user_profile_picture}}</div>
                </div>
                @endisset
                
                <span class="text-decoration-none text-black">{{ $user->full_name }}</span>
            </div>
        </td>
        <td>
            {{ $user->email }}
        </td>
        <td>
            <div class="">
                @foreach ($user->roles as $role)
                    <span class="text-dark mb-2 me-2">{{ucwords(Str::replaceFirst('_', ' ', $role->name))}}</span>
                    <br />
                @endforeach
            </div>
        </td>
        <td>
            {{ $user->created_at->format('F j, Y') }}
        </td>
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

        <td>
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-icon btn-icon-secondary rounded-pill show-user-btn" data-username={{$user->username}} type="button">
                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 7.00001C1 7.00001 3.90909 1.18182 9 1.18182C14.0909 1.18182 17 7.00001 17 7.00001C17 7.00001 14.0909 12.8182 9 12.8182C3.90909 12.8182 1 7.00001 1 7.00001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.00018 9.18181C10.2052 9.18181 11.182 8.20498 11.182 6.99999C11.182 5.79501 10.2052 4.81818 9.00018 4.81818C7.79519 4.81818 6.81836 5.79501 6.81836 6.99999C6.81836 8.20498 7.79519 9.18181 9.00018 9.18181Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="btn btn-sm btn-icon btn-icon-secondary rounded-pill" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit">
                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.9516 2.31982C10.4732 1.75466 10.734 1.47208 11.0112 1.30725C11.6799 0.909531 12.5034 0.897164 13.1833 1.27463C13.465 1.43106 13.7339 1.70568 14.2715 2.25493C14.8092 2.80418 15.078 3.07881 15.2312 3.36665C15.6007 4.06118 15.5886 4.90235 15.1992 5.58549C15.0379 5.86861 14.7613 6.13504 14.208 6.66791L7.62544 13.008C6.57701 14.0178 6.0528 14.5227 5.39764 14.7786C4.74248 15.0345 4.02224 15.0157 2.58176 14.978L2.38576 14.9729C1.94723 14.9614 1.72797 14.9557 1.60051 14.811C1.47305 14.6664 1.49045 14.443 1.52526 13.9963L1.54415 13.7538C1.64211 12.4965 1.69108 11.8678 1.9366 11.3028C2.18211 10.7377 2.6056 10.2788 3.4526 9.36115L9.9516 2.31982Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                        <path d="M9.19922 2.39996L14.0992 7.29996" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                        <path d="M9.89941 15L15.4994 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
                <button class="btn btn-sm btn-icon btn-icon-secondary rounded-pill" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.0508 3.44995L12.617 10.4675C12.5061 12.2605 12.4507 13.1569 12.0013 13.8015C11.7791 14.1201 11.493 14.3891 11.1613 14.5912C10.4903 15 9.59207 15 7.7957 15C5.99696 15 5.09759 15 4.42612 14.5904C4.09414 14.3879 3.80798 14.1185 3.58586 13.7993C3.13659 13.1538 3.0824 12.256 2.97401 10.4606L2.55078 3.44995" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M14.1 3.44998H1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M10.6371 3.45L10.1592 2.46421C9.84181 1.80938 9.6831 1.48197 9.40931 1.27776C9.34858 1.23247 9.28428 1.19218 9.21703 1.15729C8.91385 1 8.54999 1 7.82228 1C7.07629 1 6.7033 1 6.39509 1.16388C6.32678 1.20021 6.2616 1.24213 6.20022 1.28922C5.92326 1.50169 5.76855 1.84109 5.45913 2.51988L5.03516 3.45" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M6.05078 11.15L6.05078 6.95003" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M9.55078 11.15L9.55078 6.94995" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </button>
            </div>
        </td>
    </tr>

    @empty
    <tr>
        <td colspan="6">
            <div class="alert alert-danger">
                {{__('users.user_not_found')}}
            </div>
        </td>
    </tr>
    @endforelse

    <tr>
        <td colspan="6">
            <div class="d-flex justify-content-end">
                {!! $users->links('core::components.pagination') !!}

            </div>
        </td>
    </tr>
@endisset