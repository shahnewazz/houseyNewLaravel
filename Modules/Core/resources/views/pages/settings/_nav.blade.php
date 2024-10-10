@php
    $navItems = [
        [
            'route' => 'admin.settings',
            'label' => 'General'
        ],
        [
            'route' => 'admin.email.index',
            'label' => 'Email'
        ],
        [
            'route' => 'admin.roles.index',
            'label' => 'Roles & Permission'
        ],
        [
            'route' => 'admin.payment.index',
            'label' => 'Payment Gateways'
        ],
        [
            'route' => 'admin.currency.index', 
            'label' => 'Currency'
        ],
    ];
@endphp

<x-core::card>
    <ul class="nav nav-pills">
        @foreach ($navItems as $item)
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}" href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
            </li>
        @endforeach
    </ul>
</x-core::card>