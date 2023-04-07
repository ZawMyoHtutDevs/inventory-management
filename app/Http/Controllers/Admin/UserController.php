<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    public function index(){
        $users_data = User::select('id','name','email','phone', 'agency_id', 'is_admin')->get();
        // $department_data = Department::all();
        return view('admin.users.index', compact('users_data'));
    }

    public function create(){
        $agencies = Agency::select('id', 'name')->get();
        return view('admin.users.create', compact('agencies'));
    }

    public function create_user(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'max:255',
            'is_admin' => 'required',
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
        $user->agency_id = $request->agency_id;
        $user->password = Hash::make($request->password_confirmation);
        $user->is_admin = $request->is_admin;
        $user->save();

        return redirect()->route('users')->with('success', 'အကောင့် အသစ်ကိုထည့်သွင်းပြီးပါပြီ။');

    }

    public function show($id){
        $user_data = User::find($id);
        $agencies = Agency::select('id', 'name')->get();
        return view('admin.users.detail', compact('user_data', 'agencies'));
        
    }

    // update Detail
    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'max:255',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|unique:users,phone,'.$id,
            'is_admin' => 'required',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'phone.required' => 'Phone No ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'email.email' => 'သင်ထည့်ထားသော အီးမေးကို ပြန်စစ်ပေးပါ။',
        ]);


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->agency_id = $request->agency_id;
        $user->is_admin = $request->is_admin;
        $user->save();

        return redirect()->back()->with('success', $request->name .'- ၏ အချက်အလက်များကို ပြင်ဆင်ပြီးပါပြီ။');

    }


    public function change_password(Request $request, $id){

        $user = User::find($id);

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
}
