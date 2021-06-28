<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Lang;
use App\Mail\TestEmail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function getEmail()
    {
        return view('auth.forgotpassword');
    }

  


    // public function postEmail(Request $request)
    // {
    //     $data = ['message' => 'This is a test!'];

    //     Mail::to('palak@honeycombsoftwares.com')->send(new TestEmail($data));
    // }


    public function postEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);
            
      
            if (empty($request->email)) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content', Lang::get("alert.email_not_empty"));
            }
      
            //check exist
            $check_exist = User::where('email', $request->email)->first();
          
            if (empty($check_exist)) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content', Lang::get("alert.email_not_exist"));
            }
      
            $token = Str::random(12);
            $mail_data = array(
                "to_name" => ucfirst($check_exist->first_name),
                "to_email" => $request->email,
                "token" => $token,
                "email_type" => "forgot_password",
            );
            
            $mail_send = MailController::reset_password_email_send($mail_data);
            $return = $mail_send->getData();
            
            if ($return->code == 200) {
                
                $user = User::find($check_exist->id);
                $user->token=$token;
                $user->expired_token=date("Y-m-d H:i:s");
                $user->save();
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.background', '#8dbf42');
                $request->session()->flash('message.content', Lang::get("alert.reset_password_mail_sent_check_email"));
                
                return redirect()->route('login');
            }else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.background', '#e7515a');
                $request->session()->flash('message.content',Lang::get('alert.somthing_wrong'));
            }
            return redirect()->route('login');
          
        } catch (Exception $ex) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.background', '#e7515a');
            $request->session()->flash('message.content', $ex->getMessage());
        }
    }

}
