@extends('agency.layouts.app', ['page_action' => 'Edit Customer'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header mb-3">
    <h2 class="header-title">View Customer</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('dashboard')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('agency.customers.index')}}">Customers</a>
            <span class="breadcrumb-item active">{{$customer->name}}</span>
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
                            <td scope="row">Customer Name</td>
                            <td>{{$customer->name}}</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>{{$customer->phone}}</td>
                        </tr>
                        <tr>
                            <td>Customer Address</td>
                            <td>{{$customer->address}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                {{-- <p>Total Product : {{$customer->products->count()}}</p><br> --}}

                <button type="submit" class="btn btn-danger">
                    {{ __('Delete Customer') }}
                </button>
            </div>
            
        </div>
    </div>
</div>
</div>

@endsection

@section('script')

@endsection