@extends('agency.layouts.app', ['page_action' => 'View Product'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header no-gutters ">
      

    <div class="d-md-flex m-b-15 align-items-center justify-content-between">
        <div class="media align-items-center m-b-15">
            <div class="avatar avatar-image rounded" style="height: 70px; width: 70px">
                <img src="{{asset('agencies/'.auth()->user()->agency->unit_id.'/products/'.$product->asset)}}" alt="">
            </div>
            <div class="m-l-15">
                <h4 class="m-b-0">{{$product->name}}</h4>
                <p class="text-muted m-b-0">
                    @if ($product->status)
                        <span class="badge badge-pill badge-cyan">Active</span>
                    @else
                        <span class="badge badge-pill badge-red">In Active</span>
                    @endif
                </p>
            </div>
        </div>
        <div class="m-b-15">
            <a href="{{route('agency.products.edit', $product->id)}}" class="btn btn-primary">
                <i class="anticon anticon-edit"></i>
                <span>Edit</span>
            </a>
        </div>
    </div>

</div>

@endsection
@section('content')

<div class="row">

    
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-shopping-cart"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">Sales</p>
                        <h3 class="m-b-0 ls-1">1,521</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-shopping"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">Quantity</p>
                        <h3 class="m-b-0 ls-1">{{$product->quantity}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-stock"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">Available Stock</p>
                        <h3 class="m-b-0 ls-1">152</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-solution"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">Supplier Name</p>
                        <h6 class="m-b-0 ">{{$product->supplier->name}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<div class="card">

    <div class="card-body">
        <h4 class="card-title">Basic Info</h4>
        <div class="table-responsive">
            <table class="product-info-table m-t-20">
                <tbody>
                    <tr>
                        <td>Supplier Price:</td>
                        <td class="text-dark font-weight-semibold">{{$product->price .' '.auth()->user()->agency->currency}}</td>
                    </tr>
                    <tr>
                        <td>Supplier Price:</td>
                        <td class="text-dark font-weight-semibold">{{$product->sale_price .' '.auth()->user()->agency->currency}}</td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>{{$product->category->name}}</td>
                    </tr>
                    <tr>
                        <td>Brand:</td>
                        <td>{{$product->brand->name}}</td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>
                            @if ($product->status)
                            <span class="badge badge-pill badge-cyan">Active</span>
                            @else
                            <span class="badge badge-pill badge-red">In Active</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </div>

</div>

@endsection

@section('script')

@endsection