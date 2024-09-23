<!-- app header start -->
<div class="app-header bg-card py-2 px-4 px-md-6 d-flex align-items-center">
    <div class="row align-items-center w-100 gx-0">
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-4 col-3">
            <div class="app-header-left d-flex align-items-center">
                <button type="button" class="app-header-bar-btn app-sidebar-open-btn me-4">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="app-header-search position-relative d-none d-md-block">
                    <form action="#">
                        <input type="text" class="app-header-search-input" placeholder="Search for results...">
                        <button type="submit" class="app-header-search-btn">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.22221 13.4444C10.6586 13.4444 13.4444 10.6586 13.4444 7.22221C13.4444 3.78578 10.6586 1 7.22221 1C3.78578 1 1 3.78578 1 7.22221C1 10.6586 3.78578 13.4444 7.22221 13.4444Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15 15L11.6167 11.6166" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-8 col-9">


            <ul class="navbar-nav flex-row align-items-center justify-content-end">

                <!-- search button -->
                <li class="header-nav-item header-language me-2 d-md-none">
                    <a class="header-nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.22221 13.4444C10.6586 13.4444 13.4444 10.6586 13.4444 7.22221C13.4444 3.78578 10.6586 1 7.22221 1C3.78578 1 1 3.78578 1 7.22221C1 10.6586 3.78578 13.4444 7.22221 13.4444Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15 15L11.6167 11.6166" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2">
                        <div class="app-header-search position-relative">
                            <form action="#">
                                <input type="text" class="app-header-search-input" placeholder="Search for results...">
                                <button type="submit" class="app-header-search-btn">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.22221 13.4444C10.6586 13.4444 13.4444 10.6586 13.4444 7.22221C13.4444 3.78578 10.6586 1 7.22221 1C3.78578 1 1 3.78578 1 7.22221C1 10.6586 3.78578 13.4444 7.22221 13.4444Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15 15L11.6167 11.6166" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </ul>
                </li>
                <!-- search button -->

                @include('core::layouts.partials._headerLang')

                <!-- Style switcher -->
                <li class="header-nav-item header-style-switcher me-2">
                    <a class="header-nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.99844 15.8499C13.2293 15.8499 15.8484 13.2308 15.8484 9.9999C15.8484 6.76904 13.2293 4.1499 9.99844 4.1499C6.76757 4.1499 4.14844 6.76904 4.14844 9.9999C4.14844 13.2308 6.76757 15.8499 9.99844 15.8499Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path opacity="0.4" d="M16.426 16.426L16.309 16.309M16.309 3.691L16.426 3.574L16.309 3.691ZM3.574 16.426L3.691 16.309L3.574 16.426ZM10 1.072V1V1.072ZM10 19V18.928V19ZM1.072 10H1H1.072ZM19 10H18.928H19ZM3.691 3.691L3.574 3.574L3.691 3.691Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" data-bs-theme-value="light">
                                Light
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" data-bs-theme-value="dark">
                                Dark
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Style switcher -->

                @include('core::layouts.partials._headerProfile')

            </ul>
        </div>
    </div>
</div>
<!-- app header end -->