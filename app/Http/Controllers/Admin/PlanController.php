<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class PlanController extends Controller
{
    public function index(){
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function create(){
        return view('admin.plans.create');
    }

    public function store(Request $request){
        

        $request->validate([
            'name' => 'required|max:255',
            'time' => 'required|numeric',
            'product' => 'required|numeric',
            'user' => 'required|numeric',
            'supplier' => 'required|numeric',
            'category' => 'required|numeric',
            'brand' => 'required|numeric',
            'customer' => 'required|numeric',
            'pricing' => 'required|numeric',
            'currency_type' => 'required|max:255',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'time.required' => 'Limit Time ထည့်ပေးရန်လိုအပ်သည်။',
            'product.required' => 'product Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'user.required' => 'User Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'supplier.required' => 'Supplier Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'category.required' => 'Category Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'brand.required' => 'Brand Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'customer.required' => 'Customer Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'pricing.required' => 'Pricing ထည့်ပေးရန်လိုအပ်သည်။',
            'currency_type.required' => 'Currency Type ထည့်ပေးရန်လိုအပ်သည်။',

            'time.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'product.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'user.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'supplier.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'category.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'brand.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'customer.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'pricing.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            
        ]
        );

        $plan = new Plan();
        $plan->name = $request->name;
        $plan->time = $request->time;
        $plan->product = $request->product;
        $plan->user = $request->user;
        $plan->supplier = $request->supplier;
        $plan->category = $request->category;
        $plan->brand = $request->brand;
        $plan->customer = $request->customer;
        $plan->pricing = $request->pricing;
        $plan->currency_type = $request->currency_type;
        $plan->save();

        return redirect()->route('admin.plans.index')->with('success', 'Plan အသစ်ကိုထည့်သွင်းပြီးပါပြီ။');
    }

    public function edit($id)
    {
        $plan = Plan::find($id);
            
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'time' => 'required|numeric',
            'product' => 'required|numeric',
            'user' => 'required|numeric',
            'supplier' => 'required|numeric',
            'category' => 'required|numeric',
            'brand' => 'required|numeric',
            'customer' => 'required|numeric',
            'pricing' => 'required|numeric',
            'currency_type' => 'required|max:255',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'time.required' => 'Limit Time ထည့်ပေးရန်လိုအပ်သည်။',
            'product.required' => 'product Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'user.required' => 'User Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'supplier.required' => 'Supplier Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'category.required' => 'Category Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'brand.required' => 'Brand Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'customer.required' => 'Customer Limit ထည့်ပေးရန်လိုအပ်သည်။',
            'pricing.required' => 'Pricing ထည့်ပေးရန်လိုအပ်သည်။',
            'currency_type.required' => 'Currency Type ထည့်ပေးရန်လိုအပ်သည်။',

            'time.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'product.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'user.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'supplier.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'category.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'brand.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'customer.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            'pricing.numeric' => 'Number ထည့်ပေးရန်လိုအပ်သည်။',
            
        ]
        );

        $plan = Plan::find($id);

        $plan->name = $request->name;
        $plan->time = $request->time;
        $plan->product = $request->product;
        $plan->user = $request->user;
        $plan->supplier = $request->supplier;
        $plan->category = $request->category;
        $plan->brand = $request->brand;
        $plan->customer = $request->customer;
        $plan->pricing = $request->pricing;
        $plan->currency_type = $request->currency_type;
        $plan->save();

        return redirect()->back()->with('success', 'Plan - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }
}
