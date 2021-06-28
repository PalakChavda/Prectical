<?php

use App\Http\Controllers\MailController;
use App\Followup_log;
use App\User;
use App\Followup_move;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

if (!function_exists('test')) {
    function test($test)
    {
        dd($test);
    }
}


// Set current loging and related users id  
if (!function_exists('get_users_and_report_to_user')) {
    function get_users_and_report_to_user()
    {
        $user = Auth::user();
        if ( !empty($user) && ($user->user_role_id == 2) ) {
            $user_data = User::where('report_to', $user->id)->get();
            $report_to_user = array($user->id);
            foreach ($user_data as $val) {
                $report_to_user[] = $val->id;
            }
            session()->put('report_to_users', implode(",", $report_to_user));
        }else{
            Session::put('report_to_users',"");
        }
    }
}


if (!function_exists('last_exist_query')) {
    function last_exist_query($request)
    {
        if(!empty($request)){
            DB::enableQueryLog();
          
        }        
    }
}