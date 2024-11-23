<div class="mb-5">
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="{{url('parent/index')}}"><img src="{{asset('assets/images/logo.png')}}" alt="Logo"></a>
            </div>
            <div class="header-top-right">

                <div class="dropdown">
                    <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            <img src="{{asset('public/guardian/default.png')}}" alt="first_name">
                        </div>
                        <div class="text">
                            <h6 class="user-dropdown-name">{{session()->get('guardian_name')}}</h6>
                            <!-- <p class="user-dropdown-status text-sm text-muted">Member</p> -->
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                        {{-- <li><a class="dropdown-item" href="#">My Account</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="#">Settings</a></li> --}}
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{url('parent/logout')}}">Logout</a></li>
                    </ul>
                </div>
                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    @php $children = yb_get_parent_child(session()->get('id')); @endphp
    <nav class="main-navbar">
        <div class="container">
            <ul>
                <li class="menu-item">
                    <a href="{{url('parent/index')}}" class='menu-link'>
                        <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                    </a>
                </li>
                <li class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <span><i class="bi bi-person"></i> Child Profile</span>
                    </a>
                    <div class="submenu ">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                @foreach($children as $child)
                                <li class="submenu-item">
                                    <a href="{{url('parent/child-profile/'.$child->id)}}" class='submenu-link'>{{$child->full_name}} Profile</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <span><i class="bi bi-stack"></i> Leaves</span>
                    </a>
                    <div class="submenu ">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                @foreach($children as $child)
                                <li class="submenu-item">
                                    <a href="{{url('parent/child-leaves/'.$child->id)}}" class='submenu-link'>{{$child->full_name}} Leaves</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <span><i class="bi bi-cash"></i> Fees</span>
                    </a>
                    <div class="submenu ">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                @foreach($children as $child)
                                <li class="submenu-item">
                                    <a href="{{url('parent/child-fees/'.$child->id)}}" class='submenu-link'>{{$child->full_name}} Fees</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="menu-item  has-sub">
                    <a href="#" class='menu-link'>
                        <span><i class="bi bi-calendar3-week"></i> Attendance</span>
                    </a>
                    <div class="submenu ">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                @foreach($children as $child)
                                <li class="submenu-item">
                                    <a href="{{url('parent/child-attendance/'.$child->id)}}" class='submenu-link'>{{$child->full_name}} Attendance</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>