@extends('agency.layouts.app', ['page_action' => 'Edit Product'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header mb-3">
    <h2 class="header-title">{{$product->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('dashboard')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('agency.products.index')}}">Products</a>
            <span class="breadcrumb-item active">Edit Product</span>
        </nav>
    </div>
    
</div>

@endsection
@section('content')

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

<form method="POST" action="{{ route('agency.products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
<div class="row ">
    <div class="col-md-8">
        
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <div class="avatar avatar-image" style="width: 80px; height: 80px; border: 1px solid gray;">
                            <img src="
                            @if (!empty($product->asset))
                            {{asset('agencies/'.auth()->user()->agency->unit_id.'/products/'.$product->asset)}}
                            @else
                                {{asset('backend/images/product_s.png')}}
                            @endif
                            " alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="asset">Select Product Photo</label>
                            <input id="asset" type="file" class="form-control @error('asset') is-invalid @enderror" name="asset" value="{{ old('asset') }}" autocomplete="asset" >
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $product->name }}" required autocomplete="name" autofocus>
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>
                <h3 class="mb-4">Supplier Detail</h3>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="supplier_id">Select Supplier <span  data-toggle="modal" data-target="#add_supplier"  class="badge badge-pill badge-blue"> <i class="anticon   font-size-12 anticon-plus"></i> Add New</span></label>
                            <select class="form-control" name="supplier_id" id="supplier_id" style="text-transform:capitalize;" >
                                @if ($product->supplier_id)
                                    <option value="{{$product->supplier->id ?? ''}}" checked>{{$product->supplier->name ?? 'It Deleted'}}</option>
                                @else
                                    <option value="" checked>Select Supplier</option>
                                @endif                               
                                @foreach ($suppliers as $data)
                                    <option value="{{$data->id}}">{{$data->name}} (Supplier)</option>
                                @endforeach
                            </select>
                          </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') ?? $product->quantity }}" autocomplete="quantity">
                            @error('quantity')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="time">Supplier Price</label>
                        <div class="input-group mb-3">
                            
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror " value="{{ old('price') ?? $product->price }}" required placeholder="15000" aria-label="15000" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">{{auth()->user()->agency->currency}}</span>
                            </div>
                        </div>

                        @error('price')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="time">Sale Price</label>
                        <div class="input-group mb-3">
                            
                            <input type="number" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror " value="{{ old('sale_price') ?? $product->sale_price }}" required placeholder="20000" aria-label="20000" aria-describedby="basic-addon3">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon3">{{auth()->user()->agency->currency}}</span>
                            </div>
                        </div>

                        @error('sale_price')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


            </div>
            
        </div>
        
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="category_id">Select Category <span  data-toggle="modal" data-target="#add_category"  class="badge badge-pill badge-blue"><i class="anticon   font-size-12 anticon-plus"></i> Add New</span></label>
                    <select class="form-control" name="category_id" id="category_id" style="text-transform:capitalize;" >
                        @if ($product->category_id)
                            <option value="{{$product->category->id ?? ''}}" checked>{{$product->category->name ?? 'It Deleted'}}</option>
                        @else
                            <option value="" checked>Select Category</option>
                        @endif        

                        @foreach ($categories as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group pt-4">
                    <label for="brand_id">Select Brand <span  data-toggle="modal" data-target="#add_brand"  class="badge badge-pill badge-blue"><i class="anticon   font-size-12 anticon-plus"></i> Add New</span></label>
                    <select class="form-control" name="brand_id" id="brand_id" style="text-transform:capitalize;" >

                        @if ($product->brand_id)
                            <option value="{{$product->brand->id ?? ''}}" checked>{{$product->brand->name ?? 'It Deleted'}}</option>
                        @else
                            <option value="" checked>Select Brand</option>
                        @endif
                             
                        @foreach ($brands as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                  </div>


                  {{-- Is Active --}}
                <div class="form-group d-flex align-items-center mt-4">
                    <div class="switch m-r-10">
                        <input type="checkbox" name="status" id="status" 
                        @if ($product->status)
                        checked
                        @endif
                        >
                        <label for="status"></label>
                    </div>
                    <label>Status</label>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">
                    <i class="anticon anticon-save"></i> Save
                </button>
            </div>
            
        </div>
    </div>
</div>

</div>
</form>
{{-- Add Form Blade --}}
@include('agency.suppliers.parts.add_form')
@include('agency.categories.parts.add_form')
@include('agency.brands.parts.add_form')

@endsection

@section('script')
@if (Session::has('error_supplier'))
<script>
    $('#add_supplier').modal('show')
</script>
@elseif (Session::has('error_category'))
<script>
    $('#add_category').modal('show')
</script>
@elseif (Session::has('error_brand'))
<script>
    $('#add_brand').modal('show')
</script>
@endif
@endsection