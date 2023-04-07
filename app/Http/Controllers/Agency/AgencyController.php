<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AgencyController extends Controller
{
    public function index(){
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $agency = Agency::findOrFail(auth()->user()->agency->id);
        return view('agency.agencies.index', compact('agency'));
    }

    public function show(){
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $agency = Agency::findOrFail(auth()->user()->agency->id);

        return view('agency.agencies.edit', compact('agency'));
    }

    public function update(Request $request){
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $request->validate([
            'name' => 'required|max:255',
            'business_type' => 'max:255',
            'currency' => 'required',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg|max:10200',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]
        );

        $agency = Agency::findOrFail(auth()->user()->agency->id);
        
        // edit Main image
        if($request->asset != ''){
            // insert Main Image to local file
            $asset_file = $request->file('asset');
                    
            $asset_file->move(public_path().'/agencies/'.$agency->unit_id.'/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());

            // Delete old main image
            if ($agency->asset != '') {
                $del_main_image_path = public_path().'/agencies/'.$agency->unit_id.'/'.$agency->asset;
            unlink($del_main_image_path);
            }

        }else{
            $asset_name = $agency->asset;
        }

        
        $agency->name = $request->name;
        $agency->business_type = $request->business_type;
        $agency->asset = $asset_name;
        $agency->currency = $request->currency;
        $agency->description = $request->description;
        $agency->phone = $request->phone;
        $agency->save();

        return redirect()->route('agency.agencies.show')->with('success', 'Agency - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }
}
