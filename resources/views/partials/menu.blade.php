<div class="sidebar">
    <nav class="sidebar-nav sidenav-s">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("dashboard.home") }}" class="nav-link ">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("dashboard.permissions.index") }}" class="nav-link {{ request()->is('dashboard/permissions') || request()->is('dashboard/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("dashboard.roles.index") }}" class="nav-link {{ request()->is('dashboard/roles') || request()->is('dashboard/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("dashboard.users.index") }}" class="nav-link {{ request()->is('dashboard/users') || request()->is('dashboard/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("dashboard.users.index") }}?role=3" class="nav-link {{ request()->is('dashboard/users') || request()->is('dashboard/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    Teachers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("dashboard.users.index") }}?role=4" class="nav-link {{ request()->is('dashboard/users') || request()->is('dashboard/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    Students
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('school_class_access')
                <li class="nav-item">
                    <a href="{{ route("dashboard.school-classes.index") }}" class="nav-link {{ request()->is('dashboard/school-classes') || request()->is('dashboard/school-classes/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-school nav-icon">

                        </i>
                        {{ trans('cruds.schoolClass.title') }}
                    </a>
                </li>
            @endcan
            @can('lesson_grade_access')
                <li class="nav-item">
                    <a href="{{ route("dashboard.grades.index") }}" class="nav-link {{ request()->is('dashboard/grades') || request()->is('dashboard/grades/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-check nav-icon">

                        </i>
                        {{ trans('cruds.grades.title') }}
                    </a>
                </li>
            @endcan
            @can('lesson_access')
                <li class="nav-item">
                    <a href="{{ route("dashboard.lessons.index") }}" class="nav-link {{ request()->is('dashboard/lessons') || request()->is('dashboard/lessons/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-clock nav-icon">

                        </i>
                        {{ trans('cruds.lesson.title') }}
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route("dashboard.calendar.index") }}" class="nav-link {{ request()->is('dashboard/calendar') || request()->is('dashboard/calendar/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-calendar nav-icon">

                    </i>
                    Calendar
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
