<?php

namespace App\Http\Controllers;

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
        return view('admin.index');
    }


    public function dashboard()
    {
        // if (!auth()->user()->can('is_active')){
        //     return redirect()->route('dashboard.renew');
        // }
        return view('agency.index');
    }

    public function renew(){
        return view('agency.plans.renew');
    }
}
