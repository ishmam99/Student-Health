<!-- Brand Logo -->
<a href="{{ url('/') }}" class="brand-link bg-white">
    <span class="brand-text font-weight-light">Project</span>
</a>

<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ setImage(null, 'user') }}" class="img-circle elevation-1"
                style="height: 2.1rem" alt="User Image">
        </div>
        <div class="info">
           
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview {{ isActive(['/', 'dashboard*']) }}">
                <a href="{{ url('/') }}" class="nav-link {{ isActive(['dashboard*', '/']) }}">
                    <i class="fas fa-tachometer-alt nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.index') }}"
                    class="nav-link {{ request()->routeIs('student.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>একক শিক্ষার্থীর স্বাস্থ্য তথ্য রিপোর্ট</p>
                </a>
                
            </li> 
              <li class="nav-item">
                <a href="{{ route('upazila.view') }}"
                    class="nav-link {{ request()->routeIs('upazila.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>উপজেলা ভিত্তিক </p>
                </a>
                
            </li> 
             <li class="nav-item">
                <a href="{{ route('calendar.view') }}"
                    class="nav-link {{ request()->routeIs('calendar.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>ক্যালেন্ডার বর্ষ ভিত্তিক </p>
                </a>
                
            </li> 
             <li class="nav-item">
                <a href="{{ route('school.view') }}"
                    class="nav-link {{ request()->routeIs('school.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>শিক্ষা প্রতিষ্ঠান ভিত্তিক </p>
                </a>
                
            </li> 
             <li class="nav-item">
                <a href="{{ route('age.view') }}"
                    class="nav-link {{ request()->routeIs('age.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>বয়স ভিত্তিক </p>
                </a>
                
            </li> 
             <li class="nav-item">
                <a href="#"
                    class="nav-link  menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>অন্যান্য রিপোর্ট</p>
                </a>
                
            </li> 
        </ul>
    </nav>
         {{--   <li class="nav-item {{ request()->routeIs('package.*') ? 'active menu-open' : null }}">
                <a href="#" class="nav-link {{ request()->routeIs('package.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>
                        Packages
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('package.index') }}"
                            class="nav-link {{ request()->routeIs('package.index') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Packages</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('package.create') }}"
                            class="nav-link {{ request()->routeIs('package.create') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Package</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item {{ request()->routeIs('user-package.*') ? 'active menu-open' : null }}">
                <a href="#" class="nav-link {{ request()->routeIs('user-package.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>
                        Package Requests
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('user-package.index') }}"
                            class="nav-link {{ request()->routeIs('user-package.index') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pending List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user-package.accept') }}"
                            class="nav-link {{ request()->routeIs('user-package.accept') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Accept/cancel history</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ request()->routeIs('invest.*') ? 'active menu-open' : null }}">
                <a href="#" class="nav-link {{ request()->routeIs('invest.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>
                        Invest Package
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('invest.index') }}"
                            class="nav-link {{ request()->routeIs('invest.index') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Package List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('invest.create') }}"
                            class="nav-link {{ request()->routeIs('invest.create') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>New Invest Package</p>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- start 
            <li class="nav-item {{ request()->routeIs('withdraw.*') ? 'active menu-open' : null }}">
                <a href="#" class="nav-link {{ request()->routeIs('withdraw.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>
                        Withdraw
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('withdraw.index') }}"
                            class="nav-link {{ request()->routeIs('withdraw.index') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Withdraws</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ request()->routeIs('withdraw-limit.*') ? 'active menu-open' : null }}">
                <a href="#"
                    class="nav-link {{ request()->routeIs('withdraw-limit.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>
                        Withdraw Limit
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('withdraw-limit.index') }}"
                            class="nav-link {{ request()->routeIs('withdraw-limit.index') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- end 
            <li class="nav-item {{ request()->routeIs('user-invest.*') ? 'active menu-open' : null }}">
                <a href="#" class="nav-link {{ request()->routeIs('user-invest.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>
                        User Invest
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('user-invest.request.list') }}"
                            class="nav-link {{ request()->routeIs('user-invest.request.list') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Invest Request</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user-invest.withdraw.list') }}"
                            class="nav-link {{ request()->routeIs('user-invest.withdraw.list') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Withdraw Request</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user-invest.approve.list') }}"
                            class="nav-link {{ request()->routeIs('user-invest.approve.list') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Active Invest</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ request()->routeIs('objection.*') ? 'active menu-open' : null }}">
                <a href="#" class="nav-link {{ request()->routeIs('objection.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>
                        Objection
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('objection.index') }}"
                            class="nav-link {{ request()->routeIs('objection.index') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Objection Request</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('objection.approve') }}"
                            class="nav-link {{ request()->routeIs('objection.approve') ? 'active' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Objection Approve</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ request()->routeIs('user.*') ? 'active menu-open' : null }}">
                <a href="#" class="nav-link {{ request()->routeIs('user.*') ? 'active menu-open' : null }}">
                    <i class="far fa-folder nav-icon"></i>
                    <p>
                        User
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}"
                            class="nav-link {{ request()->routeIs('user.*') ? 'active menu-open' : null }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Users</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav> --}}
</div>
