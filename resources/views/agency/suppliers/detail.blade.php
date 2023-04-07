@extends('agency.layouts.app', ['page_action' => 'Edit Supplier'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header mb-3">
    <h2 class="header-title">View Supplier</h2>
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

<div class="row ">
    <div class="col-md-8">
        
        <div class="card">
            <div class="card-body">
                <table class="table table table-bordered">
                    
                    <tbody>
                        <tr>
                            <td scope="row">Supplier Name</td>
                            <td>{{$supplier->name}}</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>{{$supplier->phone}}</td>
                        </tr>
                        <tr>
                            <td>Supplier Address</td>
                            <td>{{$supplier->address}}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{$supplier->description}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <p>Total Product : {{$supplier->products->count()}}</p><br>

                <button type="submit" class="btn btn-danger">
                    {{ __('Delete Supplier') }}
                </button>
            </div>
            
        </div>
    </div>
</div>
</div>

@endsection

@section('script')

@endsection