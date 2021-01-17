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
            @if (in_array('project_view', \Auth::user()->permission))
            <div class="pcoded-navigation-label">Project Management</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu {{ active(['project/*'], 'active pcoded-trigger') }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-gitlab"></i>
                        </span>
                        <span class="pcoded-mtext">Project</span>
                    </a>
                    <ul class="pcoded-submenu">
                        @if (in_array('project_view', \Auth::user()->permission))
                        <li class="{{ active(['project.list'], 'active') }}">
                            <a href="{{ route('project.list') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">List</span>
                            </a>
                        </li>
                        @endif
                        @if (in_array('project_create', \Auth::user()->permission))
                        <li class="{{ active(['project.create'], 'active') }}">
                            <a href="{{ route('project.create') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Create project</span>
                            </a>
                        </li>
                        @endif
                        @if (in_array('client_view', \Auth::user()->permission))
                        <li class="{{ active(['project.list.client'], 'active') }}">
                            <a href="{{ route('project.list.client') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Project client</span>
                            </a>
                        </li>
                        @endif
                        @if (in_array('project_expenses', \Auth::user()->permission))
                        <li class="{{ active(['project.expenses.create'], 'active') }}">
                            <a href="{{ route('project.expenses.create') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Expenses</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
            @endif
            <div class="pcoded-navigation-label">Store Management</div>
            <ul class="pcoded-item pcoded-left-item">
                @if (in_array('store_view', \Auth::user()->permission))
                <li class="pcoded-hasmenu {{ active(['store/*'], 'active pcoded-trigger') }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-gitlab"></i>
                        </span>
                        <span class="pcoded-mtext">Store</span>
                    </a>
                    <ul class="pcoded-submenu">
                        @if (in_array('store_view', \Auth::user()->permission))
                        <li class="{{ active(['store.list'], 'active') }}">
                            <a href="{{ route('store.list', ['type' => 'light']) }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Light duty equipments</span>
                            </a>
                        </li>
                        @endif
                        @if (in_array('store_view', \Auth::user()->permission))
                        <li class="{{ active(['store.list'], 'active') }}">
                            <a href="{{ route('store.list', ['type' => 'heavy']) }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Heavy duty equipments</span>
                            </a>
                        </li>
                        @endif
                        @if (in_array('store_request', \Auth::user()->permission))
                        <li class="{{ active(['store.request.list'], 'active') }}">
                            <a href="{{ route('store.request.list') }}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">Request</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (in_array('supplier_view', \Auth::user()->permission))
                <li class="{{ active(['supplier/*'], 'active') }}">
                    <a href="{{ route('supplier.list') }}" class="waves-effect pcoded-trigger waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">List of Suppliers</span>
                    </a>
                </li>
                @endif
            </ul>
            <div class="pcoded-navigation-label">Human Resources Management</div>
            <ul class="pcoded-item pcoded-left-item">
                @if (in_array('employee_view', \Auth::user()->permission))
                <li class="pcoded-hasmenu {{ active(['employee/*'], 'active pcoded-trigger') }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-gitlab"></i>
                        </span>
                        <span class="pcoded-mtext">Employee</span>
                    </a>
                    <ul class="pcoded-submenu">
                        @if (in_array('employee_view', \Auth::user()->permission))
                        <li class="{{ active(['employee.list'], 'active') }}">
                            <a href="{{ route('employee.list') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">List</span>
                            </a>
                        </li>
                        @endif
                        @if (in_array('employee_create', \Auth::user()->permission))
                        <li class="{{ active(['employee.create'], 'active') }}">
                            <a href="{{ route('employee.create') }}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">Create employee</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (in_array('progress_view', \Auth::user()->permission))
                <li class="pcoded-hasmenu {{ active(['progress/*'], 'active pcoded-trigger') }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-gitlab"></i>
                        </span>
                        <span class="pcoded-mtext">Progress report</span>
                    </a>
                    <ul class="pcoded-submenu">
                        @if (in_array('progress_view', \Auth::user()->permission))
                        <li class="{{ active(['progress.report.list'], 'active') }}">
                            <a href="{{ route('progress.report.list') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">List</span>
                            </a>
                        </li>
                        @endif
                        @if (in_array('progress_create', \Auth::user()->permission))
                        <li class="{{ active(['progress.report.create'], 'active') }}">
                            <a href="{{ route('progress.report.create') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Upload report</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
            </ul>
            <div class="pcoded-navigation-label">Admin Module</div>
            <ul class="pcoded-item pcoded-left-item">
                @if (in_array('letter_view', \Auth::user()->permission))
                <li class="{{ active(['secretary.letter.list'], 'active') }}">
                    <a href="{{ route('secretary.letter.list') }}" class="waves-effect pcoded-trigger waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Letters</span>
                    </a>
                </li>
                @endif
                @if (in_array('minute_view', \Auth::user()->permission))
                <li class="{{ active(['secretary.minute.list'], 'active') }}">
                    <a href="{{ route('secretary.minute.list') }}" class="waves-effect pcoded-trigger waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Minutes</span>
                    </a>
                </li>
                @endif
                @if (\Auth::user()->branch_id === NULL)
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
                @endif
                @if (in_array('notification_view', \Auth::user()->permission))
                <li class="{{ active(['notification.list'], 'active') }}">
                    <a href="{{ route('notification.list') }}" class="waves-effect pcoded-trigger waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-unlock"></i>
                    </span>
                    <span class="pcoded-mtext">Notification/Events</span>
                    </a>
                </li>
                @endif
                <li class="{{ active(['settings.password'], 'active') }}">
                    <a href="{{ route('settings.password') }}" class="waves-effect pcoded-trigger waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-unlock"></i>
                    </span>
                    <span class="pcoded-mtext">Change Password</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->