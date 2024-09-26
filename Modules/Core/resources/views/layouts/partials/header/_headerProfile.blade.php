<!-- User Options -->
@php
    $user_profile_picture = auth()->user()?->profile_picture == null ? auth()->user()?->getInitialsAttribute() : asset('storage/'.auth()->user()->profile_picture);
@endphp

<li class="header-nav-item header-user me-2">
    <a class="header-nav-link has-avater header-nav-link-toggle" href="javascript:void(0);" data-bs-toggle="dropdown">

        @isset(auth()->user()?->profile_picture)
        <div class="avatar avatar-sm rounded-pill">
            <img src="{{$user_profile_picture}}" alt="{{auth()->user()?->full_name}}">
        </div>
        @else
        <div class="avatar avatar-sm rounded-pill">
            <div class="avatar-text bg-label-success">{{$user_profile_picture}}</div>
        </div>
        @endisset

        <div class="header-nav-link-toggle-icon">
            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.5 1L5 4.5L1.5 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{route('profile.edit')}}">
                Profile
            </a>
        </li>
        <li>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                    Logout
                </a>
            </form>
        </li>
    </ul>
</li>
<!-- User Options -->