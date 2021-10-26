<header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
    <div class="navbar-nav-wrap">
        <div class="navbar-brand-wrapper">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('dashboard')  }}" aria-label="Front">
                <img class="navbar-brand-logo" src="{{ asset('/assets/img/icon-pack/logo.png')  }}?_={{env('LOGO_VERSION')}}" alt="Logo">
                <img class="navbar-brand-logo-mini" src="{{ asset('/assets/img/icon-pack/logo-short.png')  }}?_={{env('LOGO_VERSION')}}" alt="Logo">
            </a>
            <!-- End Logo -->
        </div>

        <div class="navbar-nav-wrap-content-left">
            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3">
                <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip" data-placement="right" title="Collapse"></i>
                <i class="tio-last-page navbar-vertical-aside-toggle-full-align" data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-toggle="tooltip" data-placement="right" title="Expand"></i>
            </button>
            <!-- End Navbar Vertical Toggle -->
        </div>

        <!-- Secondary Content -->
        <div class="navbar-nav-wrap-content-right">
            <!-- Navbar -->
            <ul class="navbar-nav align-items-center flex-row">
                <li class="nav-item">
                    <!-- Account -->
                    <div class="hs-unfold">
                        <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper" href="javascript:;"
                           data-hs-unfold-options='{"target": "#accountNavbarDropdown","type": "css-animation"}'>
                            <div class="avatar avatar-sm avatar-circle">
                                <img class="avatar-img" src="{{ asset('/assets/img/icon-pack/logo-short.png')  }}?_={{env('LOGO_VERSION')}}" alt="{{ env('APP_NAME') }}">
                                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                            </div>
                        </a>

                        <div id="accountNavbarDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account" style="width: 16rem;">
                            <div class="dropdown-item">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-sm avatar-circle mr-2">
                                        <img class="avatar-img" src="{{ asset('/assets/img/avatar/img1.jpg')  }}?_={{env('LOGO_VERSION')}}" alt="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="media-body">
                                        <span class="card-title h5">{{ Auth::user()->name  }}</span>
                                        <span class="card-text">{{ Auth::user()->email  }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('change-password')  }}">
                                <span class="text-truncate pr-2" title="Settings">Change Password</span>
                            </a>

                            <a class="dropdown-item" href="#" onclick="$('#logout-form').submit()">
                                <form action="{{ route('logout')  }}" method="POST" id="logout-form">
                                    @csrf
                                </form>
                                <span class="text-truncate pr-2" title="Settings">Sign Out</span>
                            </a>

                        </div>
                    </div>
                    <!-- End Account -->
                </li>
            </ul>
            <!-- End Navbar -->
        </div>
        <!-- End Secondary Content -->
    </div>
</header>
