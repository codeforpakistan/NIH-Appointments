<?php

namespace App\Http\Controllers;

use App\Appointment;
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
        return view('welcome', [
            'appointments' => Appointment::with('hospital','user')->paginate()
            // 'appointments' => Appointment::where('user_id', \Auth::user()->id)->with('hospital')->get()
        ]);
    }
}
