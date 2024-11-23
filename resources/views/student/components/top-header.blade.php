<div class="mb-5">
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="{{url('student/index')}}"><img src="{{asset('assets/images/logo.png')}}" alt="Logo"></a>
            </div>
            <div class="header-top-right">

                <div class="dropdown">
                    <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            <img src="{{asset('public/student/default.png')}}" alt="first_name">
                        </div>
                        <div class="text">
                            <h6 class="user-dropdown-name">{{session()->get('first_name')}}</h6>
                            <!-- <p class="user-dropdown-status text-sm text-muted">Member</p> -->
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                        {{-- <li><a class="dropdown-item" href="#">My Account</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="#">Settings</a></li> --}}
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{url('student/logout')}}">Logout</a></li>
                    </ul>
                </div>

                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container">
            <ul>
                <li class="menu-item">
                    <a href="{{url('student/index')}}" class='menu-link'>
                        <span><i class="bi bi-grid-fill"></i> My Profile</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{url('student/fees')}}" class='menu-link'>
                        <span><i class="bi bi-cash"></i>Fees</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{url('student/homework')}}" class='menu-link'>
                        <span><i class="bi bi-book-fill"></i>Homework</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{url('student/attendance')}}" class='menu-link'>
                        <span><i class="bi bi-calendar3-week"></i>Attendance</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{url('student/leaves')}}" class='menu-link'>
                        <span><i class="bi bi-stack"></i>Leaves</span>
                    </a>
                </li>
                
                {{-- <li
                    class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <span><i class="bi bi-stack"></i> Components</span>
                    </a>
                    <div
                        class="submenu ">
                        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <li class="submenu-item">
                                    <a href="component-alert.html" class='submenu-link'>Alert</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li> --}}
            </ul>
        </div>
    </nav>
</div>