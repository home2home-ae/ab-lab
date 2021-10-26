<aside
    class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <div class="navbar-brand-wrapper justify-content-between">
                <!-- Logo -->


                <a class="navbar-brand" href="{{ route('dashboard')  }}" aria-label="Front">
                    <img class="navbar-brand-logo"
                         src="{{ asset('/assets/img/icon-pack/logo.png')  }}?_={{env('LOGO_VERSION')}}" alt="Logo">
                    <img class="navbar-brand-logo-mini"
                         src="{{ asset('/assets/img/icon-pack/logo-short.png')  }}?_={{env('LOGO_VERSION')}}"
                         alt="Logo">
                </a>

                <!-- End Logo -->

                <!-- Navbar Vertical Toggle -->
                <button type="button"
                        class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                    <i class="tio-clear tio-lg"></i>
                </button>
                <!-- End Navbar Vertical Toggle -->
            </div>

            <!-- Content -->
            <div class="navbar-vertical-content">
                <ul class="navbar-nav navbar-nav-lg nav-tabs">

                    <li class="nav-item">
                        <small class="nav-subtitle" title="Pages">Pages</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="nav-item ">
                        <a class="js-nav-tooltip-link nav-link " href="{{ route('dashboard')  }}" title="Dashboard"
                           data-placement="left">
                            <i class="tio-home nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="js-nav-tooltip-link nav-link " href="{{ route('applications')  }}"
                           title="Applications"
                           data-placement="left">
                            <i class="tio-apps nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Applications</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="js-nav-tooltip-link nav-link " href="{{ route('features')  }}" title="Features"
                           data-placement="left">
                            <i class="tio-lab nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Features</span>
                        </a>
                    </li>

                    @if(Auth::user()->isRoot())
                        <li class="nav-item ">
                            <a class="js-nav-tooltip-link nav-link " href="{{ route('users.index')  }}" title="Users"
                               data-placement="left">
                                <i class="tio-user nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Users</span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item ">
                        <a class="js-nav-tooltip-link nav-link " href="{{ route('ab-lab-setting')  }}"
                           title="Integration"
                           data-placement="left">
                            <i class="tio-documents nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Integration</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <div class="nav-divider"></div>
                    </li>

                </ul>
            </div>
            <!-- End Content -->

        </div>
    </div>
</aside>
