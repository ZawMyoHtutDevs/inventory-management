@extends('agency.layouts.app', ['page_action' => 'Sale Dashboard'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')


@endsection
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="page-header no-gutters">
            <div class="row align-items-md-center">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Total Product : {{count($products)}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-right m-v-10">
                        
                        <button class="btn btn-success m-r-5 ml-2 btn-sm" data-toggle="modal" data-target="#filter" >
                            <i class="anticon anticon-filter"></i>
                            <span class="m-l-5">Filter</span>
                        </button>
                        
                        
                    </div>
                </div>
            </div>
        </div> 
        
        
        <div class="container-fluid">
            
            <div id="card-view">
                <div class="row">
                    
                    @foreach ($products as $data)
                    <div class="col-lg-3 col-md-6 col-6" style="padding-right: 5px;
                    padding-left: 3px;">
                    
                    <div class="card" style="max-width: 370px; border-radius: 20px;">
                        <button class="btn btn-icon btn-success btn-rounded btn-tone add-to-cart" style="display: block; position: absolute; top: 8px; right: 8px;"
                        data-id="{{$data->id}}" data-name="{{$data->name}}" data-price="{{$data->sale_price}}"
                        >
                        <i class="anticon anticon-plus-circle"></i>
                    </button>
                    <div class="card_image" style="background-image: url({{asset('agencies/'.auth()->user()->agency->unit_id.'/products/'.$data->asset)}});"></div>
                    <div class="card-body" style="padding: 10px;">
                        <h5 class="m-t-10">{{$data->name}}</h5>
                        <span class="p font-weight-bold text-success m-0">{{$data->sale_price}} {{auth()->user()->agency->currency}}</span> <span class="p">({{$data->quantity}} Left)</span>
                        
                    </div>
                </div>
                
            </div>
            @endforeach
            
        </div>
    </div>
    
    
    {!! $products->appends(array("name" => request()->get('name',''),"brand_id" => request()->get('brand_id',''),"category_id" => request()->get('category_id',''),"supplier_id" => request()->get('supplier_id',''),"status" => request()->get('status','') ))->links() !!}
</div>


</div>

<div class="col-md-4">
    <div class="card" style="margin-top: -25px; margin-right: -25px; ">
        <div class="card-header">
            <h4 class="mt-3">Current Order</h4>
        </div>
        <div class="card-body pb-0">
            
            <div class="table-responsive">
                <table class="table">
                    <tbody class="show-cart">

                    </tbody>
                </table>
            </div>
            
            
                      
            <div class="table-responsive mt-3 ">
                <table class="table checkout_table">
                    
                    <tbody>
                        
                        <tr>
                            <th scope="row"><h4>Total : </h4></th>
                            <td><h4><span class="total-cart"></span> {{auth()->user()->agency->currency}}</h4></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        
        <div class="card-footer">
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-icon btn-warning btn-tone flot"><i class="anticon anticon-delete"></i></button>
                </div>
                <div class="col-10">
                    <button class="btn btn-success btn-block" data-toggle="modal" data-target="#checkout_form">Continue to Payment <i class="anticon anticon-arrow-right"></i></button>
                </div>
            </div>
            
        </div>
    </div>
</div>

</div>




{{-- Add Form Blade --}}
@include('agency.sales.parts.checkout_form')

{{-- Filter Form Blade --}}
@include('agency.sales.parts.filter_form')

@endsection

@section('script')

@include('agency.sales.parts.cart_script')

@endsection