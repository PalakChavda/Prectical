<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }


    public function mail(Request $request)
    {
        $data = DB::select("CALL GetTodayTomorrowFollowup()");
        
        $to_name = 'Palak chavada';
        $to_email = array('palak@honeycombsoftwares.com','sapan@honeycombsoftwares.com','palakhoneycomb@gmail.com','nikhil@honeycombsoftwares.com','nikhilthakar@honeycombsoftwares.com');
        
        $data = array('name' => "Palak chavada", "body" => "Test mail From palak chavda when you read this mail ping me in Hangout");

        // Mail::send('emails\FollowupMail', $data, function ($message) use ($to_name, $to_email) {
        //     $message->to($to_email, $to_name)
        //         ->subject('Honeycomb Web Testing Mail');
        //     $message->from('palakhoneycomb@gmail.com', 'Testing mail');
        // });
        // echo "Mail send successfully!";
        // return view('dashboard');
    }
}
