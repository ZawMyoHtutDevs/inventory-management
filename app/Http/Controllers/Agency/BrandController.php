<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }


        $brands = Brand::when($request->has("name"),function($q)use($request){
                        return $q->where("name","like","%".$request->get("name")."%");})
                        ->where('agency_id', '=', auth()->user()->agency->id)
                        ->orderby('created_at', 'desc')
                        ->paginate(20);
        return view('agency.brands.index', compact('brands'));
    }

    public function store(Request $request)
    {

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        // Brnad Create Limit
        $count_brand = Brand::where('agency_id', '=', auth()->user()->agency->id)->count();

        if(auth()->user()->agency->plan->brand <= $count_brand){
            return redirect()->route('agency.brands.index')->with('brand_limit', 'Brand ဖန်တီးသည့် အရေအတွက် ပြည့်သွားပါပြီး။ Plan တိုးမြှင့်ခြင်းဖြင့် ဆက်လက်အသုံးပြုနိုင်ပါသည်။');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error_brand', 'Error')->withErrors($validator)
            ->withInput();
        }
    
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->user_id = auth()->user()->id;
        $brand->agency_id = auth()->user()->agency->id;
        $brand->save();

        return redirect()->back()->with('success', 'Brand အသစ်တစ်ခုထပ်မံထည့်သွင်းပြီးပါပြီ။');
    }

    public function edit($id)
    {

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $brand = Brand::findOrFail($id);

        if(auth()->user()->agency->id != $brand->agency_id){
            return redirect()->route('dashboard');
        }
            
        return view('agency.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $brand = Brand::findOrFail($id);

        if(auth()->user()->agency->id != $brand->agency_id){
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]
        ,[
            'name.required' => 'Brand နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->user_id = auth()->user()->id;
        $brand->save();

        return redirect()->back()->with('success', 'Brand - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    public function destroy($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $brand = Brand::findOrFail($id);

        if(auth()->user()->agency->id != $brand->agency_id){
            return redirect()->route('dashboard');
        }
        
        $brand->delete();
        return redirect()->back()->with('success', 'Brand - ပယ်ဖျက်ပြီးပါပြီ။');
    }
}
