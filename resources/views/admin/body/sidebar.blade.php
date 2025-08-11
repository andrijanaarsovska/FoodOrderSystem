<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                @if(Auth::guard('admin')->user()->can('category.menu'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="grid"></i>
                            <span data-key="t-apps">Category</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if(Auth::guard('admin')->user()->can('category.all'))
                                <li>
                                    <a href="{{ route('all.category') }}">
                                        <span data-key="t-calendar">All Category</span>
                                    </a>
                                </li>
                            @endif

                            @if(Auth::guard('admin')->user()->can('category.add'))
                                <li>
                                    <a href="{{ route('add.category') }}">
                                        <span data-key="t-chat">Add Category</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(Auth::guard('admin')->user()->can('city.menu'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="grid"></i>
                            <span data-key="t-apps">City</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if(Auth::guard('admin')->user()->can('city.all'))

                                <li>
                                    <a href="{{ route('all.cities') }}">
                                        <span data-key="t-calendar">All Cities</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(Auth::guard('admin')->user()->can('city.menu'))

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="grid"></i>
                            <span data-key="t-apps">Manage Product</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('admin.all.product') }}">
                                    <span data-key="t-calendar">All Products</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.add.product') }}">
                                    <span data-key="t-chat">Add Product</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(Auth::guard('admin')->user()->can('city.menu'))

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="grid"></i>
                            <span data-key="t-apps">Manage Restaurant</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('pending.restaurant') }}">
                                    <span data-key="t-calendar">Pending Restaurant</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('active.restaurant') }}">
                                    <span data-key="t-chat">Active Restaurant</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                @endif
                @if(Auth::guard('admin')->user()->can('city.menu'))

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="grid"></i>
                            <span data-key="t-apps">Manage Banner</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('all.banner') }}">
                                    <span data-key="t-calendar">All Banner</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                @endif
                @if(Auth::guard('admin')->user()->can('city.menu'))

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="grid"></i>
                            <span data-key="t-apps">Manage Orders</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('pending.order') }}">
                                    <span data-key="t-calendar">Pending Orders</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('confirm.order') }}">
                                    <span data-key="t-calendar">Confirmed Orders</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('processing.order') }}">
                                    <span data-key="t-calendar">Processing Orders</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('delivered.order') }}">
                                    <span data-key="t-calendar">Delivered Orders</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(Auth::guard('admin')->user()->can('city.menu'))  @endif

                <li class="menu-title mt-2" data-key="t-components">Elements</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-components">Manage Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.all.reports') }}" data-key="t-alerts">All
                                Reports</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-components">Role & Permission</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.all.permissions') }}" data-key="t-alerts">All
                                Permissions</a></li>
                        <li><a href="{{ route('admin.all.roles') }}" data-key="t-alerts">All Roles</a>
                        </li>
                        <li><a href="{{ route('admin.add.roles.permission') }}" data-key="t-alerts">Role
                                In
                                Permission</a></li>
                        <li><a href="{{ route('admin.all.roles.permission') }}" data-key="t-alerts">All
                                Role In
                                Permission</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-components">Manage Admin</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.admin') }}" data-key="t-alerts">All Admin List</a>
                        </li>
                        <li><a href="{{ route('add.admin') }}" data-key="t-alerts">Add New Admin</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
