@extends('agency.layouts.app', ['page_action' => 'Order View'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

<div class="page-header">
    <h2 class="header-title">{{$order->plan->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <span class="breadcrumb-item active">Order View</span>
        </nav>
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


<div class="row">
    
    <div class="col-md-8">
        <div class="card">
            
            
            <div class="card-body">
                <table id="data-table" class="table" class="table table-inverse ">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>@switch($order->status)
                                @case('active')
                                    <span class="badge badge-success">Active</span>
                                    @break
                                @case('pending')
                                    <span class="badge badge-warning">Pending</span>
                                    @break
                                @default
                                    <span class="badge badge-danger">Cancelled</span>
                            @endswitch</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>
                                {{$order->user_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>Payment Type</td>
                            <td>
                                {{$order->payment_type}}
                            </td>
                        </tr>
                        <tr>
                            <td>Plan</td>
                            <td>
                                {{$order->plan->name}}
                            </td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>
                                {{$order->total_price}} {{auth()->user()->agency->currency}}
                            </td>
                        </tr>
                    </tbody>
                    
                    
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <img src="{{asset('agencies/'.auth()->user()->agency->unit_id.'/payment/'.$order->asset)}}" class="img-fluid " alt="">
    </div>
</div>

@endsection

@section('script')

@endsection