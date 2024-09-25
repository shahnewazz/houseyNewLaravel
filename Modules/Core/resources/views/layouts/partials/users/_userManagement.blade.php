<li class="app-sidebar-menu-heading">
    <span>
        <span class="app-sidebar-menu-heading-line"></span>
        {{__('sidebar.users_heading')}}
    </span>
</li>
<li class="app-sidebar-menu-item has-dropdown">
    <a href="javascript:void(0);" class="menu-link d-flex align-items-center">
        <span class="menu-icon flex-shrink-0">
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 9.78475C1 5.5615 1.4605 5.85625 3.93925 3.5575C5.02375 2.6845 6.71125 1 8.1685 1C9.625 1 11.3462 2.67625 12.4405 3.5575C14.9192 5.85625 15.379 5.5615 15.379 9.78475C15.379 16 13.9098 16 8.1895 16C2.46925 16 1 16 1 9.78475Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path opacity="0.4" d="M6.13539 11.6016H10.4966" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
        <span class="menu-title flex-grow-1">{{__('sidebar.users')}}</span>
        <span class="menu-arrow flex-shrink-0 d-flex align-items-center justify-content-center">
            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
    </a>

    <ul class="app-sidebar-submenu">
        <li class="app-sidebar-menu-item">
            <a href="{{route('admin.users.index')}}" class="menu-link d-flex align-items-center">
                <span class="menu-title flex-grow-1">{{__('sidebar.users_list')}}</span>
            </a>
        </li>
        <li class="app-sidebar-menu-item">
            <a href="{{route('admin.users.create')}}" class="menu-link d-flex align-items-center">
                <span class="menu-title flex-grow-1">{{__('sidebar.users_create')}}</span>
            </a>
        </li>
    </ul>
</li>
<li class="app-sidebar-menu-item">
    <a href="{{route('admin.roles.index')}}" class="menu-link d-flex align-items-center">
        <span class="menu-icon flex-shrink-0">
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 9.78475C1 5.5615 1.4605 5.85625 3.93925 3.5575C5.02375 2.6845 6.71125 1 8.1685 1C9.625 1 11.3462 2.67625 12.4405 3.5575C14.9192 5.85625 15.379 5.5615 15.379 9.78475C15.379 16 13.9098 16 8.1895 16C2.46925 16 1 16 1 9.78475Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path opacity="0.4" d="M6.13539 11.6016H10.4966" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
        <span class="menu-title flex-grow-1">{{__('sidebar.roles_permission')}}</span>
        
    </a>
</li>