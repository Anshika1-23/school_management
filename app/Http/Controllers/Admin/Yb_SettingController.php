<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class Yb_SettingController extends Controller
{
    //
    public function yb_profile_settings(Request $request){
    
        if($request->input()){
            $request->validate([
                'admin_name'=> 'required',
                'admin_email'=> 'required|email:rfc',
                'username'=> 'required',
                'phone'=> 'required',
            ]);

            $update = DB::table('admin')->update([
                'admin_name'=>$request->admin_name,
                'admin_email'=>$request->admin_email,
                'username'=>$request->username,
                'admin_phone'=>$request->phone,
            ]);
            return $update;

        }else{
            $settings = DB::table('admin')->get();
            return view('admin.settings.profile',['data'=>$settings]);
        }
    }

    public function yb_change_password(Request $request){
        if($request->input()){
            $request->validate([
                'password'=> 'required',
                'new'=> 'required',
                'new_confirm'=> 'required',
            ]);

            $get_admin = DB::table('admin')->first();

            if(Hash::check($request->password,$get_admin->password)){
                DB::table('admin')->update([
                    'password'=>Hash::make($request->new)
                ]);
                return '1';
            }else{
                return 'Please Enter Correct Current Password';
            }
        }
    }


    public function yb_db_backup(){
        Artisan::call('backup:run --only-db');
        $latest_ctime = 0;
        $latest_filename = '';
        $files = glob(storage_path('app/'.env('APP_NAME').'/*'));
        foreach($files as $file)
        {
                if (is_file($file) && filectime($file) > $latest_ctime)
                {
                        $latest_ctime = filectime($file);
                        $latest_filename = $file;
                }
        }
        return response()->download($latest_filename)->deleteFileAfterSend(true);
    }

}
