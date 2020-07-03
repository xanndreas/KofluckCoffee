<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/user-alerts') || request()->is('admin/user-alerts/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @can('transaksi_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.transaksis.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/transaksis') || request()->is('admin/transaksis/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-credit-card c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.transaksi.title') }}
                </a>
            </li>
        @endcan
        @can('product_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fab fa-product-hunt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.product.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('product_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-categories.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/product-categories') || request()->is('admin/product-categories/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-stream c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_stuff_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-stuffs.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/product-stuffs') || request()->is('admin/product-stuffs/*') ? 'active' : '' }}">
                                <i class="fa-fw fab fa-accusoft c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productStuff.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('outlet_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.outlets.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/outlets') || request()->is('admin/outlets/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-university c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.outlet.title') }}
                </a>
            </li>
        @endcan
        @can('training_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.training.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('training_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.training-categories.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/training-categories') || request()->is('admin/training-categories/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-stream c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.trainingCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('training_class_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.training-classes.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/training-classes') || request()->is('admin/training-classes/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-dumbbell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.trainingClass.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('training_candidate_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.training-candidates.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/training-candidates') || request()->is('admin/training-candidates/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.trainingCandidate.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('gallery_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.galleries.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/galleries') || request()->is('admin/galleries/*') ? 'active' : '' }}">
                    <i class="fa-fw far fa-images c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.gallery.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>