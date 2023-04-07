<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PDF;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $products = Product::where(function($q) {
                            $request = app()->make('request');

                            if($request->get('name') != '') {
                                $q->where("name","like","%".$request->get("name")."%");
                                dd('error');
                            }

                            if($request->get('brand_id') != '') {
                                $q->where("brand_id","=",$request->get("brand_id"));
                            }

                            if($request->get('category_id') != '') {
                                $q->where("category_id","=",$request->get("category_id"));
                            }

                            if($request->get('supplier_id') != '') {
                                $q->where("supplier_id","=",$request->get("supplier_id"));
                            }

                            if($request->get('status') != '') {
                                $q->where("status","like","%".$request->get("status")."%");
                            }

                        })
                        
                        ->where('agency_id', '=', auth()->user()->agency->id)
                        ->where('status', '=', 1)
                        ->orderby('created_at', 'desc')
                        ->paginate(20);
        $customers = Customer::where('agency_id', '=', auth()->user()->agency->id)
                            ->orderby('created_at', 'desc')
                            ->paginate(20);

        $brands = Brand::where('agency_id', '=', auth()->user()->agency->id)->get();
        $categories = Category::where('agency_id', '=', auth()->user()->agency->id)->get();
        $suppliers = Supplier::where('agency_id', '=', auth()->user()->agency->id)->get();
        return view('agency.sales.index', compact('products', 'customers', 'brands', 'categories','suppliers' ));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        

        $validator = Validator::make($request->all(), [
            'data_cart' => 'required',
            'payment_type' => 'required|max:255',
            'status' => 'required|max:255'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error_checkout', 'Error')->withErrors($validator)
            ->withInput();
        }

        $json_arry = json_decode($request->data_cart);
        
        $total_price = 0;
        foreach($json_arry as $key => $json) { 
            $total_price += $json->total;

        }

        $random_no = strtoupper(Str::random(10));

        $sales = new Sale();
        $sales->order_number = $random_no;
        $sales->products_data = $request->data_cart;
        $sales->status = $request->status;
        $sales->payment_type = $request->payment_type;
        $sales->discount_price = $request->discount;
        $sales->total_price = $total_price - $request->discount;
        $sales->delivery_note = $request->delivery_note;
        $sales->customer_id = $request->customer_id;
        $sales->user_id = auth()->user()->id;
        $sales->agency_id = auth()->user()->agency->id;
        $sales->save();

        return redirect()->route('agency.sales.show', $random_no)->with('success', 'Supplier အသစ်တစ်ခုထပ်မံထည့်သွင်းပြီးပါပြီ။');
    }


    public function list(Request $request)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $sales = Sale::where(function($q) {
                            $request = app()->make('request');

                            if($request->get('name') != '') {
                                $q->where("name","like","%".$request->get("name")."%");
                                dd('error');
                            }

                            if($request->get('status') != '') {
                                $q->where("status","like","%".$request->get("status")."%");
                            }

                        })
                        
                        ->where('agency_id', '=', auth()->user()->agency->id)
                        ->orderby('created_at', 'desc')
                        ->paginate(20);
        $customers = Customer::where('agency_id', '=', auth()->user()->agency->id)
                            ->orderby('created_at', 'desc')
                            ->paginate(20);
        return view('agency.sales.list', compact('sales', 'customers'));
    }

    public function invoice($no)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $sale = Sale::where('order_number', '=', $no)->first();
            
        $pdf = PDF::loadView('agency.sales.templates.pdf1', compact('sale'));


        return $pdf->download($sale->order_number.'-invoice.pdf');
    }

    public function show($no)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $sale = Sale::where('order_number', '=', $no)->first();

        return view('agency.sales.detail', compact('sale'));
    }

}
