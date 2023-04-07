<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $customers = Customer::when($request->has("name"),function($q)use($request){
                        return $q->where("name","like","%".$request->get("name")."%");})
                        ->when($request->has("phone"),function($q)use($request){
                            return $q->where("phone","like","%".$request->get("phone")."%");})
                        ->where('agency_id', '=', auth()->user()->agency->id)
                        ->orderby('created_at', 'desc')
                        ->paginate(20);
        return view('agency.customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        // Brnad Create Limit
        $count_customer = Customer::where('agency_id', '=', auth()->user()->agency->id)->count();

        if(auth()->user()->agency->plan->customer <= $count_customer){
            return redirect()->route('agency.customers.index')->with('customer_limit', 'Customer ဖန်တီးသည့် အရေအတွက် ပြည့်သွားပါပြီး။ Plan တိုးမြှင့်ခြင်းဖြင့် ဆက်လက်အသုံးပြုနိုင်ပါသည်။');
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'max:255',
            'phone' => 'regex:/(0)[0-9]/|not_regex:/[a-z]/',
        ]
        ,[
            'name.required' => 'Customer နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->user_id = auth()->user()->id;
        $customer->agency_id = auth()->user()->agency->id;
        $customer->save();

        return redirect()->back()->with('success', 'Customer အသစ်တစ်ခုထပ်မံထည့်သွင်းပြီးပါပြီ။');
    }

    public function show($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $customer = Customer::findOrFail($id);

        if(auth()->user()->agency->id != $customer->agency_id){
            return redirect()->route('dashboard');
        }
            
        return view('agency.customers.detail', compact('customer'));
    }

    public function edit($id)
    {

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }


        $customer = Customer::findOrFail($id);

        if(auth()->user()->agency->id != $customer->agency_id){
            return redirect()->route('dashboard');
        }
            
        return view('agency.customers.edit', compact('customer'));
    }


    public function update(Request $request, $id)
    {

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $customer = Customer::findOrFail($id);

        if(auth()->user()->agency->id != $customer->agency_id){
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'max:255',
            'phone' => 'regex:/(0)[0-9]/|not_regex:/[a-z]/',
        ]
        ,[
            'name.required' => 'Customer နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->user_id = auth()->user()->id;
        $customer->save();

        return redirect()->back()->with('success', 'Customer - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    public function destroy($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $customer = Customer::findOrFail($id);

        if(auth()->user()->agency->id != $customer->agency_id){
            return redirect()->route('dashboard');
        }
        
        $customer->delete();
        return redirect()->back()->with('success', 'Customer - ပယ်ဖျက်ပြီးပါပြီ။');
    }

}
