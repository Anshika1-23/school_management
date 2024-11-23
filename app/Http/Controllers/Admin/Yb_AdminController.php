<?php

namespace App\Http\Controllers\Admin;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Staff;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\ParentDetail;
use Illuminate\Http\Request;

class Yb_AdminController extends Controller
{
    //
    public function yb_index(Request $request){
        if($request->input()){

			$request->validate([
				'username'=>'required',
				'password'=>'required',
			]);
		// return Hash::make($request->input('password'));
			$login = Admin::where(['username'=>$request->username])->pluck('password')->first();

			if(empty($login)){
				return response()->json(['username'=>'Username Does not Exists']);
			}else{
				if(Hash::check($request->password,$login)){
					$admin = Admin::first();
					$request->session()->put('admin','1');
					$request->session()->put('admin_name',$admin->admin_name);
					return '1';
				}else{
					return response()->json(['password'=>'Username and Password does not matched']);
				}
			}
	    }else{
			return view('admin.admin');
		}
    }

    public function yb_dashboard(){
		// return 'dashbord';
		$students = Student::count();
		$teachers = Staff::where('role','1')->count();
		$staff = Staff::count();
		$parents = ParentDetail::count();
		$notices = Notice::with('message_user:id,title')->limit(5)->get();
        return view('admin.dashboard',compact('students','teachers','parents','staff','notices'));
    }

    public function yb_logout(Request $req){
		Auth::logout();
		session()->forget('admin');
		session()->forget('username');
		return '1';
	}
}
