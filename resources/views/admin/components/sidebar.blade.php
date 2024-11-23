<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{url('admin/dashboard')}}"><img src="{{asset('assets/images/logo.png')}}" height="85px" alt="Logo" srcset=""></a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                        role="img" class="iconify iconify--system-uicons" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                        role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-item {{(Request::path() == "admin/dashboard")? "active":""}}'>
                    <a href="{{url('admin/dashboard')}}" class='sidebar-link '>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{-- <li class='sidebar-item {{(Request::path() == "admin/academic_years")? "active":""}}'>
                    <a href="{{url('admin/academic_years')}}" class='sidebar-link '>
                        <i class="bi bi-list"></i>
                        <span>Academic Years</span>
                    </a>
                </li> --}}
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Academics</span>
                    </a>
                    <ul class="submenu {{(Request::path() == 'admin/academic_years' || Request::path() == 'admin/classes' || Request::path() == 'admin/sections' || Request::path() == 'admin/subjects' || Request::path() == 'admin/assign-class-teacher' || Request::path() == 'admin/assign-subject-teacher')? 'submenu-open':'submenu-closed'}}">
                        <li class="submenu-item  {{(Request::path() == 'admin/academic_years')? 'active':''}}">
                            <a href="{{url('admin/academic_years')}}" class="submenu-link ">Acdemic Years</a>
                        </li>
                        <li class="submenu-item  {{(Request::path() == 'admin/classes')? 'active':''}}">
                            <a href="{{url('admin/classes')}}" class="submenu-link ">Class</a>
                        </li>
                        <li class="submenu-item  {{(Request::path() == 'admin/sections')? 'active':''}}">
                            <a href="{{url('admin/sections')}}" class="submenu-link ">Sections</a>
                        </li>
                        <li class="submenu-item  {{(Request::path() == 'admin/subjects')? 'active':''}}">
                            <a href="{{url('admin/subjects')}}" class="submenu-link ">Subjects</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/assign-class-teacher')? 'active':''}}">
                            <a href="{{url('admin/assign-class-teacher')}}" class="submenu-link ">Assign Class Teacher</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/assign-subject-teacher')? 'active':''}}">
                            <a href="{{url('admin/assign-subject-teacher')}}" class="submenu-link ">Assign Subject</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-volume-up"></i>
                        <span>Communicate</span>
                    </a>
                    <ul class="submenu {{(Request::path() == 'admin/notice-list')? 'submenu-open':'submenu-closed'}}">
                        <li class="submenu-item  {{(Request::path() == 'admin/notice-list')? 'active':''}}">
                            <a href="{{url('admin/notice-list')}}" class="submenu-link ">Notice Board</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>Students Info</span>
                    </a>
                    <ul class="submenu {{(Request::path() == 'admin/student_category' || Request::path() == 'admin/students' || Request::path() == 'admin/students/create' || Request::path() == 'admin/doc-info') ? 'submenu-open':'submenu-closed'}}">
                        <li class="submenu-item {{(Request::path() == 'admin/students/create')? 'active':''}}">
                            <a href="{{url('admin/students/create')}}" class="submenu-link ">Add Student</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/students')? 'active':''}}">
                            <a href="{{url('admin/students')}}" class="submenu-link ">Student</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/student_category')? 'active':''}}">
                            <a href="{{url('admin/student_category')}}" class="submenu-link">Student Category</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/student_category')? 'active':''}}">
                            <a href="{{url('admin/student-promote')}}" class="submenu-link">Student Promote</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-cash"></i>
                        <span>Fees</span>
                    </a>
                    <ul class="submenu {{(Request::path() == 'admin/fees-group' || Request::path() == 'admin/fees-type' || Request::path() == 'admin/fees-invoice-list')? 'submenu-open':'submenu-closed'}}">
                        <li class="submenu-item {{(Request::path() == 'admin/fees-group')? 'active':''}}">
                            <a href="{{url('admin/fees-group')}}" class="submenu-link ">Fees Group</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/fees-type')? 'active':''}}">
                            <a href="{{url('admin/fees-type')}}" class="submenu-link ">Fees Type</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/fees-invoice-list')? 'active':''}}">
                            <a href="{{url('admin/fees-invoice-list')}}" class="submenu-link ">Fees Invoice</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-book"></i>
                        <span>HomeWork</span>
                    </a>
                    <ul class="submenu {{(Request::path() == 'admin/homework')? 'submenu-open':'submenu-closed'}}">
                        <li class="submenu-item  {{(Request::path() == 'admin/homework')? 'active':''}}">
                            <a href="{{url('admin/homework')}}" class="submenu-link ">HomeWork</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file"></i>
                        <span>Student Report</span>
                    </a>
                    <ul class="submenu {{(Request::path() == 'admin/class-report' || Request::path() == 'admin/guardian-report')? 'submenu-open':'submenu-closed'}}">
                        <li class="submenu-item {{(Request::path() == 'admin/class-report')? 'active':''}}">
                            <a href="{{url('admin/class-report')}}" class="submenu-link {{(Request::path() == 'admin/class-report')? 'active':''}}">Class Report</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/guardian-report')? 'active':''}}">
                            <a href="{{url('admin/guardian-report')}}" class="submenu-link {{(Request::path() == 'admin/guardian-report')? 'active':''}}">Guardian Report</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>Role & Permission</span>
                    </a>
                    <ul class="submenu {{(Request::path() == 'admin/roles' || Request::path() == 'admin/login-permission')? 'submenu-open':'submenu-closed'}}">
                        <li class="submenu-item {{(Request::path() == 'admin/roles')? 'active':''}}">
                            <a href="{{url('admin/roles')}}" class="submenu-link ">Roles</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/login-permission')? 'active':''}}">
                            <a href="{{url('admin/login-permission')}}" class="submenu-link ">Login Permission</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Administrator</span>
                    </a>
                    <ul class="submenu {{(Request::path() == 'admin/departments' || Request::path() == 'admin/designations' || Request::path() == 'admin/staffs' || Request::path() == 'admin/staff-attendance' || Request::path() == 'admin/staff-attendance-report' || Request::path() == 'admin/staff-payroll')? 'submenu-open':'submenu-closed'}}">
                        
                        <li class="submenu-item  {{(Request::path() == 'admin/departments')? 'active':''}}">
                            <a href="{{url('admin/departments')}}" class="submenu-link ">Department</a>
                        </li>
                        <li class="submenu-item  {{(Request::path() == 'admin/designations')? 'active':''}}">
                            <a href="{{url('admin/designations')}}" class="submenu-link ">Designation</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/staffs')? 'active':''}} ">
                            <a href="{{url('admin/staffs')}}" class="submenu-link ">Staff</a>
                        </li>
                        <li class="submenu-item  {{(Request::path() == 'admin/staff-attendance')? 'active':''}}">
                            <a href="{{url('admin/staff-attendance')}}" class="submenu-link ">Staff Attendance</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/staff-attendance-report')? 'active':''}} ">
                            <a href="{{url('admin/staff-attendance-report')}}" class="submenu-link ">Staff Attendance Report</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/staff-payroll')? 'active':''}} ">
                            <a href="{{url('admin/staff-payroll')}}" class="submenu-link ">Payroll</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Leave</span>
                    </a>
                    <ul class="submenu {{(Request::path() == 'admin/apply-leave' || Request::path() == 'admin/approve-leave' || Request::path() == 'admin/pending-leave' || Request::path() == 'admin/leaves' || Request::path() == 'admin/l-define')? 'submenu-open':'submenu-closed'}}">
                        <li class="submenu-item {{(Request::path() == 'admin/apply-leave')? 'active':''}}">
                            <a href="{{url('admin/apply-leave')}}" class="submenu-link">Applied Leaves</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/approve-leave')? 'active':''}}">
                            <a href="{{url('admin/approve-leave')}}" class="submenu-link">Approved Leaves</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/pending-leave')? 'active':''}}">
                            <a href="{{url('admin/pending-leave')}}" class="submenu-link">Pending Leaves</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/leaves')? 'active':''}}">
                            <a href="{{url('admin/leaves')}}" class="submenu-link">Leave Types</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/l-define')? 'active':''}}">
                            <a href="{{url('admin/l-define')}}" class="submenu-link">Leave Define</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Settings </span>
                    </a>
                    <ul class="submenu {{(Request::path() == 'admin/holiday' || Request::path() == 'admin/profile-settings' || Request::path() == 'admin/db-backup')? 'submenu-open':'submenu-closed'}}">
                        <li class="submenu-item {{(Request::path() == 'admin/holiday')? 'active':''}}">
                            <a href="{{url('admin/holiday')}}" class="submenu-link ">Holiday</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/profile-settings')? 'active':''}}">
                            <a href="{{url('admin/profile-settings')}}" class="submenu-link ">Profile Settings</a>
                        </li>
                        <li class="submenu-item {{(Request::path() == 'admin/profile-settings')? 'active':''}}">
                            <a href="{{url('admin/db-backup')}}" class="submenu-link ">DB Backup</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>