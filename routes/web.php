<?php

use Faker\Extension\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Yb_AdminController;
use App\Http\Controllers\Admin\Yb_SessionController;
use App\Http\Controllers\Admin\Yb_ClassController;
use App\Http\Controllers\Admin\Yb_SectionController;
use App\Http\Controllers\Admin\Yb_SubjectController;
use App\Http\Controllers\Admin\Yb_RoleController;
use App\Http\Controllers\Admin\Yb_DepartmentController;
use App\Http\Controllers\Admin\Yb_DesignationController;
use App\Http\Controllers\Admin\Yb_StaffController;
use App\Http\Controllers\Admin\Yb_AcademicYearController;
use App\Http\Controllers\Admin\Yb_StudentCategoryController;
use App\Http\Controllers\Admin\Yb_StudentController;
use App\Http\Controllers\Admin\Yb_LeaveTypeController;
use App\Http\Controllers\Admin\Yb_LeaveDefineController;
use App\Http\Controllers\Admin\Yb_ApplyLeaveController;
use App\Http\Controllers\Admin\Yb_ParentDetailController;
use App\Http\Controllers\Admin\Yb_StaffAttendanceController;
use App\Http\Controllers\Admin\Yb_StuDocumentInfoController;
use App\Http\Controllers\Admin\Yb_AssignClassTeacherController;
use App\Http\Controllers\Admin\Yb_AssignSubjectTeacherController;
use App\Http\Controllers\Admin\Yb_SettingController;
use App\Http\Controllers\Admin\Yb_NoticeController;
use App\Http\Controllers\Admin\Yb_HolidayController;
use App\Http\Controllers\Admin\Yb_HomeWorkController;
use App\Http\Controllers\Admin\Yb_ClassRoutineController;
use App\Http\Controllers\Admin\Yb_StaffPayrollController;
use App\Http\Controllers\Admin\Yb_FeesGroupController;
use App\Http\Controllers\Admin\Yb_FeesTypeController;
use App\Http\Controllers\Admin\Yb_FeesInvoiceController;

use App\Http\Controllers\Staff\Yb_StaffController as Yb_Staff;
use App\Http\Controllers\Staff\Yb_StudentCategoryController as Yb_Category;
use App\Http\Controllers\Staff\Yb_StudentController as Yb_Username;
use App\Http\Controllers\Staff\Yb_StuDocumentInfoController as Yb_UserDocument;
use App\Http\Controllers\Staff\Yb_ParentDetailController as Yb_UserParent;
use App\Http\Controllers\Staff\Yb_StudentAttendanceController;
use App\Http\Controllers\Staff\Yb_StdApplyLeaveController;

use App\Http\Controllers\Student\Yb_StudentController as Yb_Student;

use App\Http\Controllers\Parent\Yb_ParentController;
use App\Http\Controllers\Parent\Yb_ParentApplyLeaveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 Route::group(['middleware'=>'installed'], function(){
    Route::group(['middleware'=>'adminprotectedPage'],function(){
        Route::any('/admin',[Yb_AdminController::class,'yb_index']);
        Route::get('admin/logout',[Yb_AdminController::class,'yb_logout']);
        Route::get('admin/dashboard', [Yb_AdminController::class,'yb_dashboard']);
        Route::resource('admin/sessions',Yb_SessionController::class);
        Route::resource('admin/classes',Yb_ClassController::class);
        Route::resource('admin/sections',Yb_SectionController::class);
        Route::resource('admin/assign-class-teacher',Yb_AssignClassTeacherController::class);
        Route::resource('admin/subjects',Yb_SubjectController::class);
        Route::resource('admin/roles',Yb_RoleController::class);
        Route::resource('admin/departments',Yb_DepartmentController::class);
        Route::resource('admin/designations',Yb_DesignationController::class);
        Route::resource('admin/staffs',Yb_StaffController::class);
        Route::resource('admin/academic_years',Yb_AcademicYearController::class);
        Route::resource('admin/student_category',Yb_StudentCategoryController::class);
        Route::resource('admin/students',Yb_StudentController::class);
        Route::resource('admin/leaves',Yb_LeaveTypeController::class);
        Route::resource('admin/l-define',Yb_LeaveDefineController::class);
        Route::resource('admin/apply-leave',Yb_ApplyLeaveController::class);
        Route::resource('admin/parents',Yb_ParentDetailController::class);
        Route::resource('admin/doc-info',Yb_StuDocumentInfoController::class);
        Route::resource('admin/notice-list',Yb_NoticeController::class);
        Route::resource('admin/holiday',Yb_HolidayController::class);
        Route::post('admin/get-class-subjects',[Yb_HomeWorkController::class,'yb_get_class_subjects']);
        Route::resource('admin/homework',Yb_HomeWorkController::class);
        Route::resource('admin/fees-group',Yb_FeesGroupController::class);
        Route::resource('admin/fees-type',Yb_FeesTypeController::class);
        Route::post('admin/show-fees-type-markup',[Yb_FeesInvoiceController::class,'yb_fees_type_markup']);
        Route::post('admin/get-section-students',[Yb_FeesInvoiceController::class,'yb_get_section_students']);
        Route::resource('admin/fees-invoice-list',Yb_FeesInvoiceController::class);
        Route::get('admin/db-backup',[Yb_SettingController::class,'yb_db_backup']);
        Route::any('admin/student-promote',[Yb_StudentController::class,'yb_promote_students']);
        Route::post('admin/save-student-promote',[Yb_StudentController::class,'yb_submit_promote_students']);

        Route::post('admin/show-assigned-subjects',[Yb_AssignSubjectTeacherController::class,'show']);
        Route::resource('admin/assign-subject-teacher',Yb_AssignSubjectTeacherController::class);
        Route::get('admin/staff-attendance',[Yb_StaffAttendanceController::class,'index']);
        Route::post('admin/staff-attendance/create',[Yb_StaffAttendanceController::class,'create']);
        Route::post('admin/staff-attendance/store',[Yb_StaffAttendanceController::class,'store']);
        Route::get('admin/staff-attendance-report',[Yb_StaffAttendanceController::class,'staff_AttendanceReport']);
        Route::get('admin/class-routine',[Yb_ClassRoutineController::class,'index']);
        Route::any('admin/class-report',[Yb_ClassController::class,'yb_ClassReport']);
        Route::any('admin/guardian-report',[Yb_ParentDetailController::class,'yb_GuardianReport']);
        Route::get('admin/guardian-report/{id}',[Yb_ParentDetailController::class,'yb_getSingle_guardianDetail']);
        Route::get('admin/staff-payroll/create/{id}/{month}/{year}',[Yb_StaffPayrollController::class,'create']);
        Route::any('admin/staff-payroll/pay/{id}',[Yb_StaffPayrollController::class,'yb_pay_payroll_amount']);
        Route::any('admin/staff-payroll/print/{id}',[Yb_StaffPayrollController::class,'yb_print_payroll']);
        Route::resource('admin/staff-payroll',Yb_StaffPayrollController::class);
        Route::any('admin/login-permission',[Yb_RoleController::class,'yb_login_permission']);
        Route::post('admin/reset-all-staff-password',[Yb_RoleController::class,'yb_resetAll_staffPassword']);
        Route::post('admin/reset-all-students-password',[Yb_RoleController::class,'yb_reset_allStudentsPassword']);
        Route::post('admin/reset-all-parents-password',[Yb_RoleController::class,'yb_reset_allParentsPassword']);

        Route::post('admin/set-staff-login-permission',[Yb_RoleController::class,'yb_set_staff_loginPermission']);
        Route::post('admin/set-all-students-login-permission',[Yb_RoleController::class,'yb_set_allStudentsLoginPermission']);
        Route::post('admin/set-all-parents-login-permission',[Yb_RoleController::class,'yb_set_allParentsLoginPermission']);


        Route::post('admin/reset-login-permission',[Yb_RoleController::class,'yb_set_loginPermission']);
        Route::post('admin/set-logsin-password',[Yb_RoleController::class,'yb_set_loginPassword']);
        Route::post('admin/reset-login-password',[Yb_RoleController::class,'yb_reset_loginPassword']);
        Route::post('admin/staff-attendance/create',[Yb_StaffAttendanceController::class,'create']);
        Route::get('admin/approve-leave',[Yb_LeaveDefineController::class,'yb_approve_leave']);
        Route::get('admin/pending-leave',[Yb_LeaveDefineController::class,'yb_pending_leave']);

        Route::post('admin/change-leave-status',[Yb_ApplyLeaveController::class,'yb_changeLeave_status']);
        Route::any('admin/profile-settings',[Yb_SettingController::class,'yb_profile_settings']);
        Route::post('admin/change-password',[Yb_SettingController::class,'yb_change_password']);
        Route::post('get-sibling-parent-info',[Yb_StudentController::class,'yb_getSibling_parentInfo']);

    });

    Route::post('get-class-section',function(Request $request){
        $sections = null;
        if($request->sections){
            $sections = $request->sections;
        }
        return  yb_get_class_section($request->class_id,$sections);
    });
    Route::post('get-section-students',function(Request $request){
        $class = $request->class;
        $section = $request->section;
        return  yb_get_section_students($class,$section);
    });
    Route::post('staff',[Yb_Staff::class,'yb_login']);
    Route::post('staff',[Yb_Staff::class,'yb_login']);
    Route::group(['middleware'=>'userProtectedPage'],function(){
        Route::get('staff/login',[Yb_Staff::class,'yb_login']);
        Route::get('staff/logout',[Yb_Staff::class,'yb_logout']);
        Route::get('staff/index',[Yb_Staff::class,'yb_dashboard']);
        Route::get('staff/my-profile',[Yb_Staff::class,'yb_profile']);
        Route::get('staff/leaves/{id}',[Yb_ApplyLeaveController::class,'yb_getSingle_leave']);


        Route::get('staff/assign-class',[Yb_Staff::class,'yb_assignClass']);
        Route::get('staff/assigned-subjects',[Yb_Staff::class,'yb_assignedSubjects']);
        Route::any('staff/student-list',[Yb_Staff::class,'yb_student_list']);
        Route::resource('staff/student_category',Yb_Category::class);
        Route::resource('staff/students',Yb_Username::class);
        Route::resource('staff/parents',Yb_UserParent::class);
        Route::resource('staff/doc-info',Yb_UserDocument::class);
        Route::resource('staff/std-apply-leave',Yb_StdApplyLeaveController::class);
        Route::get('staff/student-attendance',[Yb_StudentAttendanceController::class,'index']);
        Route::post('staff/student-attendance/create',[Yb_StudentAttendanceController::class,'create']);
        Route::post('staff/student-attendance/store',[Yb_StudentAttendanceController::class,'store']);
        Route::get('staff/student-attendance-report',[Yb_StudentAttendanceController::class,'std_AttendanceReport']);

        Route::post('staff/change-leave-status',[Yb_StdApplyLeaveController::class,'yb_changeLeave_status']);


        Route::get('staff/leaves',[Yb_Staff::class,'yb_my_leaves']);
        Route::post('staff/leaves',[Yb_Staff::class,'yb_add_leave']);
        Route::get('staff/leaves',[Yb_ApplyLeaveController::class,'yb_view']);

    });
    Route::post('student',[Yb_Student::class,'yb_login']);
    Route::post('student',[Yb_Student::class,'yb_login']);
    Route::group(['middleware'=>'studentProtectedPage'],function(){
        Route::get('student/leaves/{id}',[Yb_StdApplyLeaveController::class,'yb_getSingle_leave']);
        Route::get('student/leaves',[Yb_Student::class,'yb_my_leaves']);
        Route::post('student/leaves',[Yb_Student::class,'yb_add_leave']);
        Route::get('student/leaves',[Yb_StdApplyLeaveController::class,'yb_view']);
        Route::get('student/fees',[Yb_Student::class,'yb_fees_detail']);
        Route::get('student/homework',[Yb_Student::class,'yb_homework_detail']);
        Route::get('student/homework/{id}/view',[Yb_Student::class,'yb_view_homework_detail']);
        Route::any('student/attendance',[Yb_Student::class,'yb_attendance']);
        Route::get('student/index',[Yb_Student::class,'yb_profile']);
        Route::get('student/login',[Yb_Student::class,'yb_login']);
        Route::get('student/logout',[Yb_Student::class,'yb_logout']);
    });

    Route::post('parent',[Yb_ParentController::class,'yb_login']);
    Route::post('parent',[Yb_ParentController::class,'yb_login']);
    Route::group(['middleware'=>'parentProtectedPage'],function(){
        Route::get('parent/index',[Yb_ParentController::class,'yb_index']);
        Route::get('parent/my-child-profile',[Yb_ParentController::class,'yb_profile']);
        Route::get('parent/child-profile/{id}',[Yb_ParentController::class,'yb_child_profile']);
        Route::get('parent/child-fees/{id}',[Yb_ParentController::class,'yb_child_fees']);
        Route::any('parent/child-attendance/{id}',[Yb_ParentController::class,'yb_child_attendance']);
        Route::get('parent/child-leaves/{id}',[Yb_ParentController::class,'yb_child_leaves']);
        Route::get('parent/parent-apply-leaves/{id}',[Yb_ParentApplyLeaveController::class,'yb_getSingle_leave']);
        Route::get('parent/parent-apply-leaves',[Yb_ParentController::class,'yb_Student_leaves']);
        Route::post('parent/parent-apply-leaves',[Yb_ParentController::class,'yb_addStudent_leave']);
        Route::get('parent/parent-apply-leaves',[Yb_ParentApplyLeaveController::class,'yb_view']);
        Route::get('parent/login',[Yb_ParentController::class,'yb_login']);
        Route::get('parent/logout',[Yb_ParentController::class,'yb_logout']);
    });
});

