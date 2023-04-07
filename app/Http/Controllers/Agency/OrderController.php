<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Plan;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::where('agency_id', '=', auth()->user()->agency->id)->get();

            
        return view('agency.orders.index', compact('orders'));
    }

    public function create($id)
    {

        $plan = Plan::findOrFail($id);

            
        return view('agency.orders.create', compact('plan'));
    }

    public function store(Request $request, $id){
        

        $request->validate([
            'name' => 'required|max:255',
            'payment_type' => 'required|max:255',
            'asset' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10200',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]
        );

        // edit Main image
        if($request->asset != ''){
            // insert Main Image to local file
            $asset_file = $request->file('asset');
                    
            $asset_file->move(public_path().'/agencies/'.auth()->user()->agency->unit_id.'/payment/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());
        }

        $plan = Plan::find($id);

        $order = new Order();
        $order->user_name = $request->name;
        $order->payment_type = $request->payment_type;
        $order->total_price = $plan->price;
        $order->asset = $asset_name;
        $order->status = 'pending';
        $order->user_id = auth()->user()->id;
        $order->agency_id = auth()->user()->agency->id;
        $order->plan_id = $id;

        $order->save();

        
        return redirect()->route('agency.plans.order.index')->with('success', 'Plan Order တင်ပြီးပါပြီ၊ Admin Team မှ ပြန်လည်ဆက်သွယ်ပေးပါမည်။');
        
        
    }

    public function show($id)
    {
                
        $order = Order::findOrFail($id);

        if(auth()->user()->agency->id != $order->agency_id){
            return redirect()->route('dashboard');
        }

        return view('agency.orders.detail', compact('order'));
    }

}
