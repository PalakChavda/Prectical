<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Response;

class MailController extends Controller
{
  
    public static function reset_password_email_send($request)
    {
        try {
            $to_name = $request['to_name'];
            $to_email = $request['to_email'];
           
            $welcome_mail = ($request['email_type'] == 'welcome' ) ? "emails\WelcomeMail" :"emails\ForgotPasswordMail";

            $details = array(
                'token' => $request['token'],
                'to_name' => $to_name,
            );

            Mail::send($welcome_mail, $details, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('Password Notification');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            return Response::json(['code' => 200, 'message' => 'Sent successfully']);
        } catch (Exception $e) {
            return Response::json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }
}
