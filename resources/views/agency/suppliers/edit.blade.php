@extends('agency.layouts.app', ['page_action' => 'Edit Supplier'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header mb-3">
    <h2 class="header-title">Edit Supplier</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('dashboard')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('agency.suppliers.index')}}">Suppliers</a>
            <span class="breadcrumb-item active">{{$supplier->name}}</span>
        </nav>
    </div>
    
</div>

@endsection
@section('content')

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
        
        <form method="POST" action="{{ route('agency.suppliers.update', $supplier->id) }}">
            @csrf @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $supplier->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="phone" class="text-md-right">{{ __('Phone') }}</label>
                                
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone') ?? $supplier->phone }}" required autocomplete="phone">
                                
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $supplier->address }}" required autocomplete="address" autofocus>
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
    
                        <div class="col-12">
                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description') ?? $supplier->description }}</textarea>
                              @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
    
                    
                    <a name="" id="" class="btn btn-outline-primary float-right ml-1" href="{{ route('agency.suppliers.index')}}" role="button">Close</a>
                    
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="anticon anticon-save"></i> Save
                    </button>
                </div>
                
                
                
            </div>
            
        </div>
    </form>
</div>
</div>

@endsection

@section('script')

@endsection