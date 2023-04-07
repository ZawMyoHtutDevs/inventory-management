<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Gate::allows('is_active')) {
            return redirect()->route('agency.plans.index');
        }

        $products = Product::where('agency_id', '=', auth()->user()->agency->id)
                        ->orderby('created_at', 'desc')
                        ->get();
        $customers = Customer::where('agency_id', '=', auth()->user()->agency->id)
                            ->orderby('created_at', 'desc')
                            ->get();
        $sales = Sale::where('agency_id', '=', auth()->user()->agency->id)
                            ->orderby('created_at', 'desc')
                            ->get();
        $sales_10 = Sale::where('agency_id', '=', auth()->user()->agency->id)
                            ->orderby('created_at', 'desc')
                            ->limit(10)
                            ->get();
        $suppliers = Supplier::where('agency_id', '=', auth()->user()->agency->id)
                                ->orderby('created_at', 'desc')
                                ->get();
        $agency = Agency::where('id', '=', auth()->user()->agency->id)
                            ->first();
        return view('agency.index', compact('agency','products', 'customers', 'sales', 'suppliers', 'sales_10'));
    }
}
