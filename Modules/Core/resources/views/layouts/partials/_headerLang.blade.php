<!-- Language -->
<li class="header-nav-item header-language me-2">
    <a class="header-nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
        <img src="" alt="">
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        @foreach ($languages as $language)

            <li>
                <a class="dropdown-item lang-btn @if (session('lang') == $language->code) @endif  " data-lang="{{$language->code}}" href="javascript:void(0);">
                   {{$language->name}}
                </a>
            </li>
        @endforeach
        
    </ul>
</li>
<!-- Language -->

