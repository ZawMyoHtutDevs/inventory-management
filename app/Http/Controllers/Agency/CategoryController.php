<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $categories = Category::when($request->has("name"),function($q)use($request){
                        return $q->where("name","like","%".$request->get("name")."%");})
                        ->where('agency_id', '=', auth()->user()->agency->id)
                        ->orderby('created_at', 'desc')
                        ->paginate(20);
        return view('agency.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        // Category Create Limit
        $count_category = Category::where('agency_id', '=', auth()->user()->agency->id)->count();

        if(auth()->user()->agency->plan->category <= $count_category){
            return redirect()->route('agency.categories.index')->with('category_limit', 'Category ဖန်တီးသည့် အရေအတွက် ပြည့်သွားပါပြီး။ Plan တိုးမြှင့်ခြင်းဖြင့် ဆက်လက်အသုံးပြုနိုင်ပါသည်။');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error_category', 'Error')->withErrors($validator)
            ->withInput();
        }
    
        $categories = new Category();
        $categories->name = $request->name;
        $categories->description = $request->description;
        $categories->user_id = auth()->user()->id;
        $categories->agency_id = auth()->user()->agency->id;
        $categories->save();

        return redirect()->back()->with('success', 'Category အသစ်တစ်ခုထပ်မံထည့်သွင်းပြီးပါပြီ။');
    }

    public function edit($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }


        $category = Category::findOrFail($id);

        if(auth()->user()->agency->id != $category->agency_id){
            return redirect()->route('dashboard');
        }
            
        return view('agency.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {

        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }
        
        $category = Category::findOrFail($id);

        if(auth()->user()->agency->id != $category->agency_id){
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]
        ,[
            'name.required' => 'Category နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $category->name = $request->name;
        $category->description = $request->description;
        $category->user_id = auth()->user()->id;
        $category->save();

        return redirect()->back()->with('success', 'Category - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    
    public function destroy($id)
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $category = Category::findOrFail($id);

        if(auth()->user()->agency->id != $category->agency_id){
            return redirect()->route('dashboard');
        }
        
        $category->delete();
        return redirect()->back()->with('success', 'Category - ပယ်ဖျက်ပြီးပါပြီ။');
    }

    
}
