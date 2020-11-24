<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">Navigation</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ active(['home'], 'active') }}">
                    <a href="{{ route('home') }}" class="waves-effect pcoded-trigger waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
            </ul>
            <div class="pcoded-navigation-label">Human Resources Management</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu {{ active(['employee/*'], 'active pcoded-trigger') }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-gitlab"></i>
                        </span>
                        <span class="pcoded-mtext">Employee</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ active(['employee.list'], 'active') }}">
                            <a href="{{ route('employee.list') }}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">List</span>
                            </a>
                        </li>
                        <li class="{{ active(['employee.create'], 'active') }}">
                            <a href="{{ route('employee.create') }}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">Create employee</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="pcoded-navigation-label">Settings</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu {{ active(['branches/*'], 'active pcoded-trigger') }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-gitlab"></i>
                        </span>
                        <span class="pcoded-mtext">Branches</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ active(['branches.list'], 'active') }}">
                            <a href="{{ route('branches.list') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">List</span>
                            </a>
                        </li>
                        <li class="{{ active(['branches.create'], 'active') }}">
                            <a href="{{ route('branches.create') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Create</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ active(['settings.password'], 'active') }}">
                    <a href="{{ route('settings.password') }}" class="waves-effect pcoded-trigger waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Change Password</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->