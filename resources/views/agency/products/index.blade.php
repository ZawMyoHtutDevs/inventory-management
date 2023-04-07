@extends('agency.layouts.app', ['page_action' => 'Product List'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

<div class="page-header no-gutters">
    <div class="row align-items-md-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h3>Product List</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right m-v-10">
                <span class="text-muted pr-3 pt-2 p">Total Result: {{count($products)}}</span>
                
                <button class="btn btn-default m-r-5 ml-2 btn-sm" data-toggle="modal" data-target="#filter" >
                    <i class="anticon anticon-filter"></i>
                    <span class="m-l-5">Filter</span>
                </button>
                
                
                <a href="{{route('agency.products.create')}}" class="btn btn-primary m-r-5 ml-2 btn-sm">
                    <i class="anticon anticon-plus"></i>
                    <span class="m-l-5">New</span>
                </a>
                
            </div>
        </div>
    </div>
</div> 


@endsection
@section('content')

{{-- Success message --}}
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('success') }}
</div>
@endif

{{-- Limit message --}}
@if (Session::has('product_limit'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('product_limit') }} - <a href="{{route('agency.plans.index')}}">Upgrade Plan</a>
</div>
@endif

<div class="container-fluid">
    
    <div id="card-view">
        <div class="row">
            
            @foreach ($products as $data)
            <div class="col-lg-3 col-md-6 col-6" style="padding-right: 5px;
            padding-left: 3px;">
            <div class="card" style="margin-bottom: 10px;">
                <div class="card-body" style="padding-top: 0.7em; padding-left: 0.3em; padding-right: 0.3em;">
                    
                    <div class="d-flex align-items-center p-2">
                        
                        @if ($data->asset)
                        <div class="avatar avatar-image avatar-badge avatar-square">
                            <img src="{{asset('agencies/'.auth()->user()->agency->unit_id.'/products/'.$data->asset)}}" alt="">
                            @if ($data->status)
                                <span class="badge badge-indicator badge-success"></span>
                            @else
                                <span class="badge badge-indicator badge-danger"></span>
                            @endif
                        </div>
                        @else
                        <div class="avatar avatar-icon avatar-blue avatar-badge avatar-square">
                            <i class="anticon anticon-picture"></i>
                            @if ($data->status)
                                <span class="badge badge-indicator badge-success"></span>
                            @else
                                <span class="badge badge-indicator badge-danger"></span>
                            @endif
                        </div>
                        @endif
                        
                        
                        
                        <div class="m-l-10">
                            <div class="m-b-0 text-dark font-weight-semibold">{{$data->price}} {{auth()->user()->agency->currency}}</div>
                            <div class="m-b-0 opacity-07 font-size-13">({{$data->quantity}}) left</div>
                        </div>
                    </div>
                    <hr style="margin-top: 5px; margin-bottom: 12px;">
                    <div class="d-flex align-items-center" style="word-wrap: break-word;
                    display: block !important;
                    height: 57px;">
                    
                    <div class="m-l-10">
                        <div class="m-b-0 text-dark font-weight-semibold">{{$data->name}}</div>
                        <div class="m-b-0 opacity-07 font-size-13 mt-2">
                            @if ($data->category)
                            <span class="badge badge-pill badge-green">{{$data->category->name}}</span>
                            @endif
                            @if ($data->brand)
                            <span class="badge badge-pill badge-blue">{{$data->brand->name}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="card-footer" style="padding: 0.7rem;">
                <div class="text-right">
                    
                    <a class="btn btn-default btn-xs" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$data->id}}').submit(); }">Delete</a>
                    
                    <a href="{{route('agency.products.edit', $data->id)}}" class="btn btn-primary btn-xs">Edit</a>
                    <a href="{{route('agency.products.view', $data->id)}}" class="btn btn-info btn-xs">View</a>

                    <form style="display: none;" id="delete-form{{$data->id}}" method="POST" action="{{route('agency.products.destroy', $data->id)}}" >
                        @csrf @method('DELETE')
                    </form>
                    
                </div>
            </div>
        </div>
        
    </div>
    @endforeach
    
</div>
</div>


{!! $products->appends(array("name" => request()->get('name',''),"brand_id" => request()->get('brand_id',''),"category_id" => request()->get('category_id',''),"supplier_id" => request()->get('supplier_id',''),"status" => request()->get('status','') ))->links() !!}
</div>


{{-- Filter Form Blade --}}
@include('agency.products.parts.filter_form')

@endsection

@section('script')



@endsection