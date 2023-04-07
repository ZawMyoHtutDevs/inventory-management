<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $suppliers = Supplier::when($request->has("name"),function($q)use($request){
                        return $q->where("name","like","%".$request->get("name")."%");})
                        ->when($request->has("phone"),function($q)use($request){
                        return $q->where("phone","like","%".$request->get("phone")."%");})
                        ->where('agency_id', '=', auth()->user()->agency->id)
                        ->orderby('created_at', 'desc')
                        ->paginate(20);
        return view('agency.suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        // Brnad Create Limit
        $count_supplier = Supplier::where('agency_id', '=', auth()->user()->agency->id)->count();

        if(auth()->user()->agency->plan->supplier <= $count_supplier){
            return redirect()->route('agency.suppliers.index')->with('supplier_limit', 'Supplier ဖန်တီးသည့် အရေအတွက် ပြည့်သွားပါပြီး။ Plan တိုးမြှင့်ခြင်းဖြင့် ဆက်လက်အသုံးပြုနိုင်ပါသည်။');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'max:255',
            'address' => 'max:255',
            'phone' => 'regex:/(0)[0-9]/|not_regex:/[a-z]/',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error_supplier', 'Error')->withErrors($validator)
            ->withInput();
        }
    
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->description = $request->description;
        $supplier->user_id = auth()->user()->id;
        $supplier->agency_id = auth()->user()->agency->id;
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier အသစ်တစ်ခုထပ်မံထည့်သွင်းပြီးပါပြီ။');
    }

    public function show($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $supplier = Supplier::findOrFail($id);

        if(auth()->user()->agency->id != $supplier->agency_id){
            return redirect()->route('dashboard');
        }
            
        return view('agency.suppliers.detail', compact('supplier'));
    }

    public function edit($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $supplier = Supplier::findOrFail($id);

        if(auth()->user()->agency->id != $supplier->agency_id){
            return redirect()->route('dashboard');
        }
            
        return view('agency.suppliers.edit', compact('supplier'));
    }


    public function update(Request $request, $id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $supplier = Supplier::findOrFail($id);

        if(auth()->user()->agency->id != $supplier->agency_id){
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
            'address' => 'max:255',
            'phone' => 'regex:/(0)[0-9]/|not_regex:/[a-z]/',
        ]
        ,[
            'name.required' => 'Supplier နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->description = $request->description;
        $supplier->user_id = auth()->user()->id;
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    public function destroy($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $suppliers = Supplier::findOrFail($id);

        if(auth()->user()->agency->id != $suppliers->agency_id){
            return redirect()->route('dashboard');
        }
        
        $suppliers->delete();
        return redirect()->back()->with('success', 'Supplier - ပယ်ဖျက်ပြီးပါပြီ။');
    }
}
