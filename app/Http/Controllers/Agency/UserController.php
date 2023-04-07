<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $accounts = User::when($request->has("name"),function($q)use($request){
                        return $q->where("name","like","%".$request->get("name")."%");})
                        ->where('agency_id', '=', auth()->user()->agency->id)
                        ->orderby('created_at', 'desc')
                        ->paginate(20);
        return view('agency.users.index', compact('accounts'));
    }

    public function store(Request $request){

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }


        // user Create Limit
        $count_account = User::where('agency_id', '=', auth()->user()->agency->id)->count();

        if(auth()->user()->agency->plan->user <= $count_account){
            return redirect()->route('agency.accounts.index')->with('account_limit', 'အကောင့် ဖန်တီးသည့် အရေအတွက် ပြည့်သွားပါပြီး။ Plan တိုးမြှင့်ခြင်းဖြင့် ဆက်လက်အသုံးပြုနိုင်ပါသည်။');
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'max:255',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'phone.unique' => 'သင်ထည့်ထားသော Phone No ကို အသုံးပြုပြီးဖြစ်သည်။',
            'phone.required' => 'Phone ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'phone.not_regex' => 'Phone အမှန် ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'password.required' => 'စကားဝှက်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'password_confirmation.required' => 'အတည်ပြုစကားဝှက်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'password_confirmation.same' => 'စကားဝှက် နှင့် အတည်ပြုစကားဝှက် ထပ်တူကျရန် လိုအပ်ပါသည်။',
            
        ]
    );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;        
        $user->password = Hash::make($request->password_confirmation);
        $user->is_admin = 0;
        $user->agency_id = auth()->user()->agency->id;
        $user->save();

        return redirect()->route('agency.accounts.index')->with('success', 'အကောင့် အသစ်ဖန်တီးပြီးပါပြီ။');

    }

    public function edit($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $user = User::findOrFail($id);

        if(auth()->user()->id != $user->id){
            return redirect()->route('dashboard');
        }
        
        return view('agency.users.detail', compact('user'));
        
    }

    // update Detail
    public function update(Request $request, $id){

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $user = User::findOrFail($id);

        if(auth()->user()->id != $user->id){
            return redirect()->route('dashboard');
        }


        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'max:255',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|unique:users,phone,'.$id,
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'phone.required' => 'Phone No ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'email.email' => 'သင်ထည့်ထားသော အီးမေးကို ပြန်စစ်ပေးပါ။',
        ]);


        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with('success', $request->name .'- ၏ အချက်အလက်များကို ပြင်ဆင်ပြီးပါပြီ။');

    }

    public function change($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $user = User::findOrFail($id);

        if(auth()->user()->id != $user->id){
            return redirect()->route('dashboard');
        }
        
        return view('agency.users.change', compact('user'));
        
    }

    public function change_password(Request $request, $id){

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }
        
        $user = User::findOrFail($id);

        if(auth()->user()->id != $user->id){
            return redirect()->route('dashboard');
        }

        if (!(Hash::check($request->current_password, $user->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->current_password, $request->new_password) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        //Change Password
        
        $user->password = Hash::make($request->new_password_confirmation);
       
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

    // Delete User
    // public function delete($id){

    //     $user = User::find($id);
    //     $user->delete();
    //     return redirect()->back()->with('success', "Deleted account successfully !");

    // }
}
