<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        // $products = Product::when($request->has("name"),function($q)use($request){
        //                 return $q->where("name","like","%".$request->get("name")."%");})
        //                 ->when($request->has("brand_id"),function($q)use($request){
        //                     return $q->where("brand_id","=",$request->get("brand_id"));})
        //                 ->when($request->has("category_id"),function($q)use($request){
        //                     return $q->where("category_id","=",$request->get("category_id"));})
        //                 ->when($request->has("supplier_id"),function($q)use($request){
        //                     return $q->where("supplier_id","=",$request->get("supplier_id"));})
        //                 ->when($request->has("status"),function($q)use($request){
        //                     return $q->where("status","like","%".$request->get("status")."%");})
        //                 ->where('agency_id', '=', auth()->user()->agency->id)
        //                 ->orderby('created_at', 'desc')
        //                 ->paginate(20);
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
            ->orderby('created_at', 'desc')
            ->paginate(20);

        $brands = Brand::where('agency_id', '=', auth()->user()->agency->id)->get();
        $categories = Category::where('agency_id', '=', auth()->user()->agency->id)->get();
        $suppliers = Supplier::where('agency_id', '=', auth()->user()->agency->id)->get();
        return view('agency.products.index', compact('products', 'brands', 'categories','suppliers' ));
    }

    public function create(){

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $categories = Category::select('name', 'id')->orderby('created_at', 'asc')->get();
        $brands = Brand::select('name', 'id')->orderby('created_at', 'asc')->get();
        $suppliers = Supplier::select('name', 'id')->orderby('created_at', 'asc')->get();
        
        return view('agency.products.add', compact('categories', 'brands', 'suppliers'));
    }


    public function store(Request $request)
    {

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }


        // Products Create Limit
        $count_supplier = Supplier::where('agency_id', '=', auth()->user()->agency->id)->count();

        if(auth()->user()->agency->plan->supplier <= $count_supplier){
            return redirect()->route('agency.suppliers.index')->with('product_limit', 'Supplier ဖန်တီးသည့် အရေအတွက် ပြည့်သွားပါပြီး။ Plan တိုးမြှင့်ခြင်းဖြင့် ဆက်လက်အသုံးပြုနိုင်ပါသည်။');
        }

        $request->validate([
            'name' => 'required|max:255',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg|max:10200',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]
        );

        // edit Main image
        if($request->asset != ''){
            // insert Main Image to local file
            $asset_file = $request->file('asset');
                    
            $asset_file->move(public_path().'/agencies/'.auth()->user()->agency->unit_id.'/products/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());
        }else{
            $asset_name = '';
        }
    
        $product = new Product();
        $product->name = $request->name;
        $product->asset = $asset_name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->status = $request->status == 'on' ? 1 : 0;
        $product->user_id = auth()->user()->id;
        $product->agency_id = auth()->user()->agency->id;
        $product->save();

        return redirect()->route('agency.products.index')->with('success', 'Product ('.$request->name.') အသစ်တစ်ခု ထပ်မံ ထည့်သွင်းပြီးပါပြီ။');
    }

    public function edit($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $product = Product::findOrFail($id);

        if(auth()->user()->agency->id != $product->agency_id){
            return redirect()->route('dashboard');
        }
        $categories = Category::select('name', 'id')->orderby('created_at', 'asc')->get();
        $brands = Brand::select('name', 'id')->orderby('created_at', 'asc')->get();
        $suppliers = Supplier::select('name', 'id')->orderby('created_at', 'asc')->get();

        return view('agency.products.edit', compact('product', 'categories', 'brands', 'suppliers'));
    }

    public function update(Request $request, $id){
        
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $product = Product::findOrFail($id);

        if(auth()->user()->agency->id != $product->agency_id){
            return redirect()->route('dashboard');
        }

        $request->validate([
            'name' => 'required|max:255',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg|max:10200',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]
        );
        
        // edit Main image
        if($request->asset != ''){
            // insert Main Image to local file
            $asset_file = $request->file('asset');
                    
            $asset_file->move(public_path().'/agencies/'.auth()->user()->agency->unit_id.'/products/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());

            // Delete old main image
            if ($product->asset != '') {
                $del_main_image_path = public_path().'/agencies/'.auth()->user()->agency->unit_id.'/products/'.$product->asset;
            unlink($del_main_image_path);
            }

        }else{
            $asset_name = $product->asset;
        }

        $product->name = $request->name;
        $product->asset = $asset_name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->status = $request->status == 'on' ? 1 : 0;
        $product->user_id = auth()->user()->id;
        $product->save();

        return redirect()->route('agency.products.index')->with('success', 'Product - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    public function show($id)
    {

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }
        
        $product = Product::findOrFail($id);

        if(auth()->user()->agency->id != $product->agency_id){
            return redirect()->route('dashboard');
        }

        return view('agency.products.detail', compact('product'));
    }

    public function destroy($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $product = Product::findOrFail($id);

        if(auth()->user()->agency->id != $product->agency_id){
            return redirect()->route('dashboard');
        }

        if($product->asset != ''){
            // Delete image
            $del_main_image_path = public_path().'/agencies/'.auth()->user()->agency->unit_id.'/products/'.$product->asset;
            unlink($del_main_image_path);
        }
        
        
        $product->delete();
        return redirect()->back()->with('success', 'Product - ပယ်ဖျက်ပြီးပါပြီ။');
    }
}
