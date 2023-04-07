<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.home_page');
    }
    public function about(){
        return view('frontend.about_page');
    }
    public function pricing(){
        return view('frontend.pricing_page');
    }
    public function policy(){
        return view('frontend.policy_page');
    }
    public function contact(){
        return view('frontend.contact_page');
    }
    public function register(){
        return view('frontend.register_agency_page');
    }

    public function store(Request $request){
        

        $request->validate([
            'shopname' => 'required|max:255',
            'username' => 'required|max:255',
            'logo' => 'mimes:jpeg,png,jpg,gif,svg|max:10200',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]
        );

        // Create Unit Id
        $unit = rand(1, 1000).time();

        // edit Main image
        if($request->logo != ''){
            // insert Main Image to local file
            $asset_file = $request->file('logo');
                    
            $asset_file->move(public_path().'/agencies/'.$unit.'/', $asset_name = rand(1, 1000).time().'.'.$request->logo->extension());
        }else{
            $asset_name = '';
        }

        $agency = new Agency();
        $agency->name = $request->shopname;
        $agency->unit_id = $unit;
        $agency->asset = $asset_name;
        $agency->status = 'pending';
        $agency->currency = 'Ks';
        $agency->phone = $request->phone;
        $agency->save();

        $user = new User();
        $user->name = $request->username;
        $user->phone = $request->phone;
        $user->agency_id = $agency->id;
        $user->password = Hash::make($request->password_confirmation);
        $user->is_admin = 0;
        $user->save();

        $userdata = array(
            'phone' => $request->phone,
            'password' => $request->password_confirmation
          );

        if (Auth::attempt($userdata))
          {
            return redirect()->route('agency.plans.index')->with('login_success', 'Shop အသစ်ကိုထည့်သွင်းပြီးပါပြီ။ Plan ရွေးပေးရန် လိုအပ်သည်။');
        }

        
    }
    
}
