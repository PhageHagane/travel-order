<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            @if ($logged_in_user->isAdmin())
                    <li class="nav-title">
                        @lang('menus.backend.sidebar.system')
                    </li>

                    <li class="nav-item nav-dropdown {{
                active_class(Route::is('admin/auth*'), 'open')
                        }}">
                        <a class="nav-link nav-dropdown-toggle {{
                active_class(Route::is('admin/auth*'))
                            }}" href="#">
                            <i class="nav-icon fa fa-bars"></i>
                            @lang('menus.backend.access.title')

                            @if ($pending_approval > 0)
                                <span class="badge badge-danger">{{ $pending_approval }}</span>
                            @endif
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link {{
                active_class(Route::is('admin/offices'))
                        }}" href="{{ route('admin.offices.index') }}">
                                    <i class="nav-icon fas fa-building"></i>
                                    Offices
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{
                active_class(Route::is('admin/divisions'))
                        }}" href="{{ route('admin.divisions.index') }}">
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    Divisions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{
                active_class(Route::is('admin/client_types'))
                        }}" href="{{ route('admin.client_types.index') }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    Client Types
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{
                active_class(Route::is('admin/auth/user*'))
                                    }}" href="{{ route('admin.auth.user.index') }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    Users

                                    @if ($pending_approval > 0)
                                        <span class="badge badge-danger">{{ $pending_approval }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{
                active_class(Route::is('admin/auth/role*'))
                                    }}" href="{{ route('admin.auth.role.index') }}">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    Roles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{
                active_class(Route::is('admin/permissions*'))
                                    }}" href="{{ route('admin.permissions.index') }}">
                                    <i class="nav-icon fas fa-key"></i>
                                    Permissions
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="divider"></li>

                    <!-- <li class="nav-item nav-dropdown {{
                            active_class(Route::is('admin/log-viewer*'), 'open')
                        }}">
                                <a class="nav-link nav-dropdown-toggle {{
                                    active_class(Route::is('admin/log-viewer*'))
                                }}" href="#">
                                <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
                            </a>

                            <ul class="nav-dropdown-items">
                                <li class="nav-item">
                                    <a class="nav-link {{
                                    active_class(Route::is('admin/log-viewer'))
                                }}" href="{{ route('log-viewer::dashboard') }}">
                                        @lang('menus.backend.log-viewer.dashboard')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{
                                    active_class(Route::is('admin/log-viewer/logs*'))
                                }}" href="{{ route('log-viewer::logs.list') }}">
                                        @lang('menus.backend.log-viewer.logs')
                                    </a>
                                </li>
                            </ul>
                        </li> -->
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->