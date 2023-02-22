<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <a href="{{ route('home') }}">
            <img alt="Logo" src="{{ asset('theme/media/logos/logo-1-dark.svg') }}" class="h-25px logo" />
        </a>
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize">
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
        </div>
    </div>
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                    <div class="menu-item">
                        <a class="menu-link @if (Route::currentRouteName() == 'home') active @endif" href="{{ route('home') }}"
                            title="Build your layout and export HTML for server side integration"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="2" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                            rx="2" fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                            rx="2" fill="currentColor" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                            rx="2" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>
                </div>
                @superadmin
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'admin-users.index' ||
                            Route::currentRouteName() == 'admin-users.create' ||
                            Route::currentRouteName() == 'admin-users.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M4.05424 15.1982C8.34524 7.76818 13.5782 3.26318 20.9282 2.01418C21.0729 1.98837 21.2216 1.99789 21.3618 2.04193C21.502 2.08597 21.6294 2.16323 21.7333 2.26712C21.8372 2.37101 21.9144 2.49846 21.9585 2.63863C22.0025 2.7788 22.012 2.92754 21.9862 3.07218C20.7372 10.4222 16.2322 15.6552 8.80224 19.9462L4.05424 15.1982ZM3.81924 17.3372L2.63324 20.4482C2.58427 20.5765 2.5735 20.7163 2.6022 20.8507C2.63091 20.9851 2.69788 21.1082 2.79503 21.2054C2.89218 21.3025 3.01536 21.3695 3.14972 21.3982C3.28408 21.4269 3.42387 21.4161 3.55224 21.3672L6.66524 20.1802L3.81924 17.3372ZM16.5002 5.99818C16.2036 5.99818 15.9136 6.08615 15.6669 6.25097C15.4202 6.41579 15.228 6.65006 15.1144 6.92415C15.0009 7.19824 14.9712 7.49984 15.0291 7.79081C15.0869 8.08178 15.2298 8.34906 15.4396 8.55884C15.6494 8.76862 15.9166 8.91148 16.2076 8.96935C16.4986 9.02723 16.8002 8.99753 17.0743 8.884C17.3484 8.77046 17.5826 8.5782 17.7474 8.33153C17.9123 8.08486 18.0002 7.79485 18.0002 7.49818C18.0002 7.10035 17.8422 6.71882 17.5609 6.43752C17.2796 6.15621 16.8981 5.99818 16.5002 5.99818Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M4.05423 15.1982L2.24723 13.3912C2.15505 13.299 2.08547 13.1867 2.04395 13.0632C2.00243 12.9396 1.9901 12.8081 2.00793 12.679C2.02575 12.5498 2.07325 12.4266 2.14669 12.3189C2.22013 12.2112 2.31752 12.1219 2.43123 12.0582L9.15323 8.28918C7.17353 10.3717 5.4607 12.6926 4.05423 15.1982ZM8.80023 19.9442L10.6072 21.7512C10.6994 21.8434 10.8117 21.9129 10.9352 21.9545C11.0588 21.996 11.1903 22.0083 11.3195 21.9905C11.4486 21.9727 11.5718 21.9252 11.6795 21.8517C11.7872 21.7783 11.8765 21.6809 11.9402 21.5672L15.7092 14.8442C13.6269 16.8245 11.3061 18.5377 8.80023 19.9442ZM7.04023 18.1832L12.5832 12.6402C12.7381 12.4759 12.8228 12.2577 12.8195 12.032C12.8161 11.8063 12.725 11.5907 12.5653 11.4311C12.4057 11.2714 12.1901 11.1803 11.9644 11.1769C11.7387 11.1736 11.5205 11.2583 11.3562 11.4132L5.81323 16.9562L7.04023 18.1832Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Users</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link  @if (Route::currentRouteName() == 'admin-users.create') active @endif"
                                    href="{{ route('admin-users.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (Route::currentRouteName() == 'admin-users.index' || Route::currentRouteName() == 'admin-users.edit') active @endif"
                                    href="{{ route('admin-users.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endsuperadmin

                @permission('address-types')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'address-types.index' ||
                            Route::currentRouteName() == 'address-types.create' ||
                            Route::currentRouteName() == 'address-types.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Address Types</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @permission('address-types', 'create')
                                <div class="menu-item">
                                    <a class="menu-link  @if (Route::currentRouteName() == 'address-types.create') active @endif"
                                        href="{{ route('address-types.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Add</span>
                                    </a>
                                </div>
                            @endpermission
                            @permission('address-types', 'index')
                                <div class="menu-item">
                                    <a class="menu-link @if (Route::currentRouteName() == 'address-types.index' || Route::currentRouteName() == 'address-types.edit') active @endif"
                                        href="{{ route('address-types.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">List</span>
                                    </a>
                                </div>
                            @endpermission
                        </div>
                    </div>
                @endpermission
                @permission('peoples')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'peoples.index' ||
                            Route::currentRouteName() == 'peoples.create' ||
                            Route::currentRouteName() == 'peoples.edit' ||
                            Route::currentRouteName() == 'people-addresses.index' ||
                            Route::currentRouteName() == 'people-addresses.create' ||
                            Route::currentRouteName() == 'people-addresses.edit' ||
                            Route::currentRouteName() == 'people-phones.index' ||
                            Route::currentRouteName() == 'people-phones.create' ||
                            Route::currentRouteName() == 'people-phones.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                            fill="currentColor" />
                                        <path
                                            d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('Peoples') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @permission('peoples', 'create')
                                <div class="menu-item">
                                    <a class="menu-link  @if (Route::currentRouteName() == 'peoples.create') active @endif"
                                        href="{{ route('peoples.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Add') }}</span>
                                    </a>
                                </div>
                            @endpermission
                            @permission('peoples', 'index')
                                <div class="menu-item">
                                    <a class="menu-link @if (Route::currentRouteName() == 'peoples.index' ||
                                        Route::currentRouteName() == 'peoples.edit' ||
                                        Route::currentRouteName() == 'people-addresses.index' ||
                                        Route::currentRouteName() == 'people-addresses.create' ||
                                        Route::currentRouteName() == 'people-addresses.edit' ||
                                        Route::currentRouteName() == 'people-phones.index' ||
                                        Route::currentRouteName() == 'people-phones.create' ||
                                        Route::currentRouteName() == 'people-phones.edit') active @endif"
                                        href="{{ route('peoples.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('List') }}</span>
                                    </a>
                                </div>
                            @endpermission
                        </div>
                    </div>
                @endpermission
                @permission('customers')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'customers.index' ||
                            Route::currentRouteName() == 'customers.create' ||
                            Route::currentRouteName() == 'customers.edit' ||
                            Route::currentRouteName() == 'customer-addresses.index' ||
                            Route::currentRouteName() == 'customer-addresses.create' ||
                            Route::currentRouteName() == 'customer-addresses.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="14" y="4" width="4"
                                            height="4" rx="2" fill="currentColor" />
                                        <path
                                            d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="6" y="5" width="6"
                                            height="6" rx="3" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('Customers') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @permission('customers', 'create')
                                <div class="menu-item">
                                    <a class="menu-link  @if (Route::currentRouteName() == 'customers.create') active @endif"
                                        href="{{ route('customers.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Add') }}</span>
                                    </a>
                                </div>
                            @endpermission
                            @permission('customers', 'index')
                                <div class="menu-item">
                                    <a class="menu-link @if (Route::currentRouteName() == 'customers.index' ||
                                        Route::currentRouteName() == 'customers.edit' ||
                                        Route::currentRouteName() == 'customer-addresses.index' ||
                                        Route::currentRouteName() == 'customer-addresses.create' ||
                                        Route::currentRouteName() == 'customer-addresses.edit') active @endif"
                                        href="{{ route('customers.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('List') }}</span>
                                    </a>
                                </div>
                            @endpermission
                        </div>
                    </div>
                @endpermission
                @permission('crop-commodity-types')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'crop-commodity-types.index' ||
                            Route::currentRouteName() == 'crop-commodity-types.create' ||
                            Route::currentRouteName() == 'crop-commodity-types.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M19 18C20.7 18 22 16.7 22 15C22 13.3 20.7 12 19 12C18.9 12 18.9 12 18.8 12C18.9 11.7 19 11.3 19 11C19 9.3 17.7 8 16 8C15.4 8 14.8 8.2 14.3 8.5C13.4 7 11.8 6 10 6C7.2 6 5 8.2 5 11C5 11.3 5.00001 11.7 5.10001 12H5C3.3 12 2 13.3 2 15C2 16.7 3.3 18 5 18H19Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('Crop Commodity Types') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @permission('crop-commodity-types', 'create')
                                <div class="menu-item">
                                    <a class="menu-link  @if (Route::currentRouteName() == 'crop-commodity-types.create') active @endif"
                                        href="{{ route('crop-commodity-types.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Add') }}</span>
                                    </a>
                                </div>
                            @endpermission
                            @permission('crop-commodity-types', 'index')
                                <div class="menu-item">
                                    <a class="menu-link @if (Route::currentRouteName() == 'crop-commodity-types.index' ||
                                        Route::currentRouteName() == 'crop-commodity-types.edit') active @endif"
                                        href="{{ route('crop-commodity-types.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('List') }}</span>
                                    </a>
                                </div>
                            @endpermission
                        </div>
                    </div>
                @endpermission
              

              
                @permission('crop-commodities')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'crop-commodities.index' ||
                            Route::currentRouteName() == 'crop-commodities.create' ||
                            Route::currentRouteName() == 'crop-commodities.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z"
                                            fill="currentColor" />
                                        <path
                                            d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('Crop Commodities') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @permission('crop-commodities', 'create')
                                <div class="menu-item">
                                    <a class="menu-link  @if (Route::currentRouteName() == 'crop-commodities.create') active @endif"
                                        href="{{ route('crop-commodities.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Add') }}</span>
                                    </a>
                                </div>
                            @endpermission
                            @permission('crop-commodities', 'index')
                                <div class="menu-item">
                                    <a class="menu-link @if (Route::currentRouteName() == 'crop-commodities.index' ||
                                        Route::currentRouteName() == 'crop-commodities.edit') active @endif"
                                        href="{{ route('crop-commodities.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('List') }}</span>
                                    </a>
                                </div>
                            @endpermission
                        </div>
                    </div>
                @endpermission
                @permission('crop-commodity-varieties')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'crop-commodity-varieties.index' ||
                            Route::currentRouteName() == 'crop-commodity-varieties.create' ||
                            Route::currentRouteName() == 'crop-commodity-varieties.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M8.7 4.19995L4 6.30005V18.8999L8.7 16.8V19L3.1 21.5C2.6 21.7 2 21.4 2 20.8V6C2 5.4 2.3 4.89995 2.9 4.69995L8.7 2.09998V4.19995Z"
                                            fill="currentColor" />
                                        <path
                                            d="M15.3 19.8L20 17.6999V5.09992L15.3 7.19989V4.99994L20.9 2.49994C21.4 2.29994 22 2.59989 22 3.19989V17.9999C22 18.5999 21.7 19.1 21.1 19.3L15.3 21.8998V19.8Z"
                                            fill="currentColor" />
                                        <path opacity="0.3" d="M15.3 7.19995L20 5.09998V17.7L15.3 19.8V7.19995Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M8.70001 4.19995V2L15.4 5V7.19995L8.70001 4.19995ZM8.70001 16.8V19L15.4 22V19.8L8.70001 16.8Z"
                                            fill="currentColor" />
                                        <path opacity="0.3" d="M8.7 16.8L4 18.8999V6.30005L8.7 4.19995V16.8Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('Crop Commodity Varieties') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @permission('crop-commodity-varieties', 'create')
                                <div class="menu-item">
                                    <a class="menu-link  @if (Route::currentRouteName() == 'crop-commodity-varieties.create') active @endif"
                                        href="{{ route('crop-commodity-varieties.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Add') }}</span>
                                    </a>
                                </div>
                            @endpermission
                            @permission('crop-commodity-varieties', 'index')
                                <div class="menu-item">
                                    <a class="menu-link @if (Route::currentRouteName() == 'crop-commodity-varieties.index' ||
                                        Route::currentRouteName() == 'crop-commodity-varieties.edit') active @endif"
                                        href="{{ route('crop-commodity-varieties.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('List') }}</span>
                                    </a>
                                </div>
                            @endpermission
                        </div>
                    </div>
                @endpermission
                @permission('crop-locations')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'crop-locations.index' ||
                            Route::currentRouteName() == 'crop-locations.create' ||
                            Route::currentRouteName() == 'crop-locations.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M18.0624 15.3454L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3454C4.56242 13.6454 3.76242 11.4452 4.06242 8.94525C4.56242 5.34525 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24525 19.9624 9.94525C20.0624 12.0452 19.2624 13.9454 18.0624 15.3454ZM13.0624 10.0453C13.0624 9.44534 12.6624 9.04534 12.0624 9.04534C11.4624 9.04534 11.0624 9.44534 11.0624 10.0453V13.0453H13.0624V10.0453Z"
                                            fill="currentColor" />
                                        <path
                                            d="M12.6624 5.54531C12.2624 5.24531 11.7624 5.24531 11.4624 5.54531L8.06241 8.04531V12.0453C8.06241 12.6453 8.46241 13.0453 9.06241 13.0453H11.0624V10.0453C11.0624 9.44531 11.4624 9.04531 12.0624 9.04531C12.6624 9.04531 13.0624 9.44531 13.0624 10.0453V13.0453H15.0624C15.6624 13.0453 16.0624 12.6453 16.0624 12.0453V8.04531L12.6624 5.54531Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('Crop Locations') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @permission('crop-locations', 'create')
                                <div class="menu-item">
                                    <a class="menu-link  @if (Route::currentRouteName() == 'crop-locations.create') active @endif"
                                        href="{{ route('crop-locations.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Add') }}</span>
                                    </a>
                                </div>
                            @endpermission
                            @permission('crop-locations', 'index')
                                <div class="menu-item">
                                    <a class="menu-link @if (Route::currentRouteName() == 'crop-locations.index' || Route::currentRouteName() == 'crop-locations.edit') active @endif"
                                        href="{{ route('crop-locations.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('List') }}</span>
                                    </a>
                                </div>
                            @endpermission
                        </div>
                    </div>
                @endpermission
                @permission('crop-location-blocks')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'crop-location-blocks.index' ||
                            Route::currentRouteName() == 'crop-location-blocks.create' ||
                            Route::currentRouteName() == 'crop-location-blocks.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M19 10C18.9 10 18.9 10 18.8 10C18.9 9.7 19 9.3 19 9C19 7.3 17.7 6 16 6C15.4 6 14.8 6.2 14.3 6.5C13.4 5 11.8 4 10 4C7.2 4 5 6.2 5 9C5 9.3 5.00001 9.7 5.10001 10H5C3.3 10 2 11.3 2 13C2 14.7 3.3 16 5 16H9L13.4 20.4C14 21 15 20.6 15 19.8V16H19C20.7 16 22 14.7 22 13C22 11.3 20.7 10 19 10Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('Crop Location Blocks') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @permission('crop-location-blocks', 'create')
                                <div class="menu-item">
                                    <a class="menu-link  @if (Route::currentRouteName() == 'crop-location-blocks.create') active @endif"
                                        href="{{ route('crop-location-blocks.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Add') }}</span>
                                    </a>
                                </div>
                            @endpermission
                            @permission('crop-location-blocks', 'index')
                                <div class="menu-item">
                                    <a class="menu-link @if (Route::currentRouteName() == 'crop-location-blocks.index' ||
                                        Route::currentRouteName() == 'crop-location-blocks.edit') active @endif"
                                        href="{{ route('crop-location-blocks.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('List') }}</span>
                                    </a>
                                </div>
                            @endpermission
                        </div>
                    </div>
                @endpermission
                @permission('vendors')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'vendors.index' ||
                            Route::currentRouteName() == 'vendors.create' ||
                            Route::currentRouteName() == 'vendors.edit' ||
                            Route::currentRouteName() == 'vendor-addresses.index' ||
                            Route::currentRouteName() == 'vendor-addresses.create' ||
                            Route::currentRouteName() == 'vendor-addresses.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                            fill="currentColor" />
                                        <path
                                            d="M12.0006 11.1542C13.1434 11.1542 14.0777 10.22 14.0777 9.0771C14.0777 7.93424 13.1434 7 12.0006 7C10.8577 7 9.92348 7.93424 9.92348 9.0771C9.92348 10.22 10.8577 11.1542 12.0006 11.1542Z"
                                            fill="currentColor" />
                                        <path
                                            d="M15.5652 13.814C15.5108 13.6779 15.4382 13.551 15.3566 13.4331C14.9393 12.8163 14.2954 12.4081 13.5697 12.3083C13.479 12.2993 13.3793 12.3174 13.3067 12.3718C12.9257 12.653 12.4722 12.7981 12.0006 12.7981C11.5289 12.7981 11.0754 12.653 10.6944 12.3718C10.6219 12.3174 10.5221 12.2902 10.4314 12.3083C9.70578 12.4081 9.05272 12.8163 8.64456 13.4331C8.56293 13.551 8.49036 13.687 8.43595 13.814C8.40875 13.8684 8.41781 13.9319 8.44502 13.9864C8.51759 14.1133 8.60828 14.2403 8.68991 14.3492C8.81689 14.5215 8.95295 14.6757 9.10715 14.8208C9.23413 14.9478 9.37925 15.0657 9.52439 15.1836C10.2409 15.7188 11.1026 15.9999 11.9915 15.9999C12.8804 15.9999 13.7421 15.7188 14.4586 15.1836C14.6038 15.0748 14.7489 14.9478 14.8759 14.8208C15.021 14.6757 15.1661 14.5215 15.2931 14.3492C15.3838 14.2312 15.4655 14.1133 15.538 13.9864C15.5833 13.9319 15.5924 13.8684 15.5652 13.814Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('Vendors') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @permission('vendors', 'create')
                                <div class="menu-item">
                                    <a class="menu-link  @if (Route::currentRouteName() == 'vendors.create') active @endif"
                                        href="{{ route('vendors.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Add') }}</span>
                                    </a>
                                </div>
                            @endpermission
                            @permission('vendors', 'index')
                                <div class="menu-item">
                                    <a class="menu-link @if (Route::currentRouteName() == 'vendors.index' ||
                                        Route::currentRouteName() == 'vendors.edit' ||
                                        Route::currentRouteName() == 'vendor-addresses.index' ||
                                        Route::currentRouteName() == 'vendor-addresses.create' ||
                                        Route::currentRouteName() == 'vendor-addresses.edit') active @endif"
                                        href="{{ route('vendors.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('List') }}</span>
                                    </a>
                                </div>
                            @endpermission
                        </div>
                    </div>
                @endpermission

                @permission('scout-report-categories')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (Route::currentRouteName() == 'scout-report-categories.index' ||
                            Route::currentRouteName() == 'scout-report-categories.create' ||
                            Route::currentRouteName() == 'scout-report-categories.edit') here hover show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs017.svg-->
                                <span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M2.07664 11.85L2.87663 10.05C3.07663 9.55003 3.67665 9.35003 4.17665 9.55003L5.07664 9.95002C7.17664 10.85 9.17662 10.85 11.2766 9.95002C14.3766 8.55002 17.4766 8.55002 20.5766 9.95002L21.4766 10.35C21.9766 10.55 22.1766 11.15 21.9766 11.65L21.1766 13.45C20.9766 13.95 20.3766 14.15 19.8766 13.95L18.9766 13.55C16.8766 12.65 14.8766 12.65 12.7766 13.55C9.67662 14.95 6.57663 14.95 3.47663 13.55L2.57664 13.15C2.07664 12.95 1.87664 12.35 2.07664 11.85ZM2.57664 20.05L3.47663 20.45C6.57663 21.85 9.67662 21.85 12.7766 20.45C14.8766 19.55 16.8766 19.55 18.9766 20.45L19.8766 20.85C20.3766 21.05 20.9766 20.85 21.1766 20.35L21.9766 18.55C22.1766 18.05 21.9766 17.45 21.4766 17.25L20.5766 16.85C17.4766 15.45 14.3766 15.45 11.2766 16.85C9.17662 17.75 7.17664 17.75 5.07664 16.85L4.17665 16.45C3.67665 16.25 3.07663 16.45 2.87663 16.95L2.07664 18.75C1.87664 19.25 2.07664 19.85 2.57664 20.05Z"
                                            fill="currentColor" />
                                        <path
                                            d="M2.07664 4.94999L2.87663 3.15C3.07663 2.65 3.67665 2.45 4.17665 2.65L5.07664 3.05C7.17664 3.95 9.17662 3.95 11.2766 3.05C14.3766 1.65 17.4766 1.65 20.5766 3.05L21.4766 3.44999C21.9766 3.64999 22.1766 4.25 21.9766 4.75L21.1766 6.55C20.9766 7.05 20.3766 7.25 19.8766 7.05L18.9766 6.65C16.8766 5.75 14.8766 5.75 12.7766 6.65C9.67662 8.05 6.57663 8.05 3.47663 6.65L2.57664 6.25C2.07664 6.05 1.87664 5.44999 2.07664 4.94999Z"
                                            fill="currentColor" />
                                    </svg></span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Scout Report Categories') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @permission('scout-report-categories', 'create')
                                <div class="menu-item">
                                    <a class="menu-link  @if (Route::currentRouteName() == 'scout-report-categories.create') active @endif"
                                        href="{{ route('scout-report-categories.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Add') }}</span>
                                    </a>
                                </div>
                            @endpermission
                            @permission('scout-report-categories', 'index')
                                <div class="menu-item">
                                    <a class="menu-link @if (Route::currentRouteName() == 'scout-report-categories.index' ||
                                        Route::currentRouteName() == 'scout-report-categories.edit') active @endif"
                                        href="{{ route('scout-report-categories.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('List') }}</span>
                                    </a>
                                </div>
                            @endpermission
                        </div>
                    </div>
                @endpermission
                @permission('questions') 
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion @if (Route::currentRouteName() == 'questions.index' ||
                        Route::currentRouteName() == 'questions.create' ||
                        Route::currentRouteName() == 'questions.edit') here hover show @endif">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M19 10C18.9 10 18.9 10 18.8 10C18.9 9.7 19 9.3 19 9C19 7.3 17.7 6 16 6C15.4 6 14.8 6.2 14.3 6.5C13.4 5 11.8 4 10 4C7.2 4 5 6.2 5 9C5 9.3 5.00001 9.7 5.10001 10H5C3.3 10 2 11.3 2 13C2 14.7 3.3 16 5 16H9L13.4 20.4C14 21 15 20.6 15 19.8V16H19C20.7 16 22 14.7 22 13C22 11.3 20.7 10 19 10Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">{{ __('Questions') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                         @permission('questions', 'create') 
                            <div class="menu-item">
                                <a class="menu-link  @if (Route::currentRouteName() == 'questions.create') active @endif"
                                    href="{{ route('questions.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Add') }}</span>
                                </a>
                            </div>
                         @endpermission 
                         @permission('questions', 'index') 
                            <div class="menu-item">
                                <a class="menu-link @if (Route::currentRouteName() == 'questions.index' ||
                                    Route::currentRouteName() == 'questions.edit') active @endif"
                                    href="{{ route('questions.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('List') }}</span>
                                </a>
                            </div>
                         @endpermission 
                    </div>
                </div>
             @endpermission
             {{-- @permission('questions')  --}}
             <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion @if (Route::currentRouteName() == 'scout-reports.index' ||
                     Route::currentRouteName() == 'scout-reports.create' ||
                     Route::currentRouteName() == 'scout-reports.edit') here hover show @endif">
                 <span class="menu-link">
                     <span class="menu-icon">
                         <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="currentColor"></path>
                                <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="currentColor"></path>
                            </svg>
                         </span>
                     </span>
                     <span class="menu-title">{{ __('Scout Reports') }}</span>
                     <span class="menu-arrow"></span>
                 </span>
                 <div class="menu-sub menu-sub-accordion">
                      {{-- @permission('questions', 'index')  --}}
                         <div class="menu-item">
                             <a class="menu-link @if (Route::currentRouteName() == 'scout-reports.index' ||
                                 Route::currentRouteName() == 'scout-reports.edit') active @endif"
                                 href="{{ route('scout-reports.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('List') }}</span>
                             </a>
                         </div>
                      {{-- @endpermission  --}}
                 </div>
             </div>
          {{-- @endpermission --}}
                @superadmin
                    <div class="menu-item">
                        <a class="menu-link @if (Route::currentRouteName() == 'laravel-backup-panel.index') active @endif"
                            href="{{ route('laravel-backup-panel.index') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Backup Panel</span>
                        </a>
                    </div>
                @endsuperadmin
            </div>
        </div>
    </div>
</div>
