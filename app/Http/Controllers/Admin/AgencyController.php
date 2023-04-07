<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Plan;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index(){
        $agencies = Agency::all();
        return view('admin.agencies.index', compact('agencies'));
    }

    public function create(){
        $plans = Plan::select('id', 'name')->get();
        return view('admin.agencies.create', compact('plans'));
    }

    public function store(Request $request){
        

        $request->validate([
            'name' => 'required|max:255',
            'business_type' => 'max:255',
            'status' => 'required',
            'currency' => 'required',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg|max:10200',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]
        );

        // Create Unit Id
        $unit = rand(1, 1000).time();

        // edit Main image
        if($request->asset != ''){
            // insert Main Image to local file
            $asset_file = $request->file('asset');
                    
            $asset_file->move(public_path().'/agencies/'.$unit.'/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());
        }else{
            $asset_name = '';
        }

        $agency = new Agency();
        $agency->name = $request->name;
        $agency->unit_id = $unit;
        $agency->business_type = $request->business_type;
        $agency->asset = $asset_name;
        $agency->status = $request->status;
        $agency->plan_id = $request->plan_id;
        $agency->start_date = $request->start_date;
        $agency->end_date = $request->end_date;
        $agency->currency = $request->currency;
        $agency->description = $request->description;
        $agency->phone = $request->phone;
        $agency->save();

        return redirect()->route('admin.agencies.index')->with('success', 'Agency အသစ်ကိုထည့်သွင်းပြီးပါပြီ။');
    }


    public function edit($id)
    {
        $agency = Agency::find($id);
        $plans = Plan::select('id', 'name')->get();
        return view('admin.agencies.edit', compact('agency','plans'));
    }


    public function update(Request $request, $id){
        

        $request->validate([
            'name' => 'required|max:255',
            'business_type' => 'max:255',
            'status' => 'required',
            'currency' => 'required',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg|max:10200',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]
        );

        $agency = Agency::find($id);
        
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
        $agency->status = $request->status;
        $agency->plan_id = $request->plan_id;
        $agency->start_date = $request->start_date;
        $agency->end_date = $request->end_date;
        $agency->currency = $request->currency;
        $agency->description = $request->description;
        $agency->phone = $request->phone;
        $agency->save();

        return redirect()->route('admin.agencies.index')->with('success', 'Agency - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }
}
