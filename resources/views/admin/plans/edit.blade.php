@extends('admin.layouts.app')
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">{{$plan->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('admin.plans.index')}}">Plans</a>
            <span class="breadcrumb-item active">Edit Plan</span>
        </nav>
    </div>
    
</div>

@endsection
@section('content')

{{-- Error message --}}
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('error') }}
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

<div class="row justify-content-center">
    <div class="col-md-8">
        
        <form method="POST" action="{{ route('admin.plans.update', $plan->id) }}">
            @csrf @method('PUT')
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Plan Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $plan->name}}" required autocomplete="name" autofocus>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="time">Plan Duration</label>
                            <div class="input-group mb-3">
                                
                                <input type="number" name="time" class="form-control @error('time') is-invalid @enderror " value="{{ old('time') ?? $plan->time }}" required placeholder="365" aria-label="365" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Days</span>
                                </div>
                            </div>

                            @error('time')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        
                    </div>
                    
                    <h4>Plan Limitation</h4>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="product" class="text-md-right">{{ __('Product Limit') }}</label>
                                
                                <input id="product" type="number" class="form-control @error('product') is-invalid @enderror" name="product" value="{{old('product') ?? $plan->product }}" required autocomplete="product">
                                
                                @error('product')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="user" class="text-md-right">{{ __('User Limit') }}</label>
                                
                                <input id="user" type="number" class="form-control @error('user') is-invalid @enderror" name="user" value="{{old('user') ?? $plan->user}}" required autocomplete="user">
                                
                                @error('user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="supplier" class="text-md-right">{{ __('Supplier Limit') }}</label>
                                
                                <input id="supplier" type="number" class="form-control @error('supplier') is-invalid @enderror" name="supplier" value="{{old('supplier') ?? $plan->supplier }}" required autocomplete="supplier">
                                
                                @error('supplier')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label for="category" class="text-md-right">{{ __('Category Limit') }}</label>
                                
                                <input id="category" type="number" class="form-control @error('category') is-invalid @enderror" name="category" value="{{old('category') ?? $plan->category }}" required autocomplete="category">
                                
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="brand" class="text-md-right">{{ __('Brand Limit') }}</label>
                                
                                <input id="brand" type="number" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{old('brand') ?? $plan->brand}}" required autocomplete="category">
                                
                                @error('brand')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="customer" class="text-md-right">{{ __('Customer Limit') }}</label>
                                
                                <input id="customer" type="number" class="form-control @error('customer') is-invalid @enderror" name="customer" value="{{old('customer') ?? $plan->customer }}" required autocomplete="customer">
                                
                                @error('customer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    <h4>Pricing</h4>
                    <br>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group ">
                                <label for="pricing" class="text-md-right">{{ __('Pricing') }}</label>
                                
                                
                                <input id="pricing" type="number" class="form-control @error('pricing') is-invalid @enderror" name="pricing" value="{{old('pricing') ?? $plan->pricing}}" required autocomplete="pricing">
                                
                                @error('pricing')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group ">
                                <label for="currency_type">Currency Type</label>
                                <input id="currency_type" type="text" class="form-control @error('currency_type') is-invalid @enderror" name="currency_type" value="{{ old('currency_type') ?? $plan->currency_type }}" required autocomplete="currency_type" autofocus>
                                @error('currency_type')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                   
                    
                    <a name="" id="" class="btn btn-outline-primary float-right ml-1" href="{{ route('admin.plans.index')}}" role="button">Close</a>
                    
                    <button type="submit" class="btn btn-primary float-right">
                        {{ __('Update') }}
                    </button>
                </div>
                
            </div>
            
    </form>
</div>
</div>

@endsection

@section('script')

@endsection