<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class DashboardController extends Controller
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
   public function index(Request $request)
    {
        try {
            $data = [
                'page_name' => __('global.dashboard'),
                'category_name' => 'dashboard',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
            ];
            return view('dashboard')->with($data);
        } catch (Exception $e) {
            $this->session()->flash('error_message', $e->getMessage());
            return route('dashboard.index');
        }
    }

    
}
