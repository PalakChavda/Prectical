<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
Use Exception;
use Illuminate\Support\Facades\Lang;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function getPassword($token, Request $request)
    {
        $check_valid_token = User::where('token', $token)->first();
        if(empty($check_valid_token)){
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.background', '#e7515a');
            $request->session()->flash('message.content', "Your password reset link has expired");
            return redirect('/login');
        }else{
            // 30 min expired token
            $expired_token_date = strtotime($check_valid_token->expired_token);
            $add_half_hour= strtotime("+30 minutes", strtotime($expired_token_date));
            $expired_token_time = $expired_token_date + $add_half_hour;
            $current_time= strtotime("now");
            
            if($expired_token_time <= $current_time){
                $user = User::where('token', $token)
                ->update(['token' => null, "expired_token" => null]);
            
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content', "Your password reset link has expired");
                return redirect('/login');
            }

            return view('auth.reset', ['token' => $token]);
        }

    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required',
                'cpassword' => 'required',
            ]);
            
            if ($request->password != $request->cpassword){
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content', Lang::get('alert.password_does_not_match'));
                return redirect()->route('login');
            }

            $check_valid_token = User::where('token', $request->token)->first();
            
            if (!$check_valid_token || $check_valid_token == NULL) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content', Lang::get('alert.somthing_wrong'));
                return redirect()->route('login');
               
            }
            
            $user = User::where('email', $check_valid_token->email)
                ->update(['password' => Hash::make($request->password),'token' => null, "expired_token" => null]);
            
            if (!empty($user)) {
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.background', '#8dbf42');
                $request->session()->flash('message.content',Lang::get("alert.password_change_successfully"));
            } else {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content', Lang::get('alert.somthing_wrong'));
            }
        
            return redirect('/login');
        } catch (Exception $e) {
            $request->session()->flash('error_message', $e->getMessage());
            return redirect()->route('login');
        }
    }
}
