<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(){
        $plans = Plan::orderby('id', 'asc')->get();
        return view('agency.plans.index', compact('plans'));
    }
    
}
