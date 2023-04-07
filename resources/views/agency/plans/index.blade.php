@extends('agency.layouts.app', ['page_action' => 'Pricing Plan'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

<div class="page-header no-gutters">
    <div class="row align-items-md-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h3>Pricing Plans</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right m-v-10">
                
                
                <a href="{{route('agency.plans.order.index')}}" class="btn btn-primary m-r-5 ml-2 btn-sm" >
                    <i class="anticon anticon-hdd"></i>
                    <span class="m-l-5">Plan History</span>
                </a>

            </div>
        </div>
    </div>
</div> 


@endsection
@section('content')

{{-- Success message --}}
@if (Session::has('login_success'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('login_success') }}
</div>
@endif

{{-- Success message --}}
@cannot('is_active')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{auth()->user()->agency->name}} သည် Plan ရွေးချယ်ထားခြင်းမရှိသော့ကြောင့် Plan အသစ်ရွေးချယ်ပြီး ဆက်လက်အသုံးပြုပါ။
</div>
@endcannot

<div class="row">
    @foreach ($plans as $data)
    <div class="col-md-3">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between p-b-20 border-bottom">
                    <div class="media align-items-center">
                        
                        <div class="m-l-0">
                            <h2 class="font-weight-semibold font-size-18 text-warning m-b-2">
                                {{$data->pricing}} {{$data->currency_type}}
                                <span class="font-size-13 font-weight-semibold">/ {{$data->time}} Days</span>
                            </h2>
                            <h4 class="m-b-0">{{$data->name}}</h4>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <div class="row">
                        <div class="col-3">
                            <button class="btn btn-icon btn-success btn-tone" data-toggle="modal" data-target="#priceModel{{$data->id}}">
                                <i class="anticon anticon-exclamation-circle"></i>
                            </button>
                        </div>
                        <div class="col-9">
                            <a href="{{route('agency.plans.order.create', $data->id)}}" class="btn btn-primary ">ရွေးချယ်မည်</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    
    </div>

    {{-- model --}}
    <div class="modal fade" id="priceModel{{$data->id}}">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="priceModel{{$data->id}}Title">{{$data->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        
                        <tbody>
                            <tr>
                                <td scope="row">Products</td>
                                <td>{{$data->product}}</td>
                            </tr>
                            <tr>
                                <td scope="row">Customers</td>
                                <td>{{$data->customer}}</td>
                            </tr>
                            <tr>
                                <td scope="row">Categories</td>
                                <td>{{$data->category}}</td>
                            </tr>
                            <tr>
                                <td scope="row">Brands</td>
                                <td>{{$data->brand}}</td>
                            </tr>
                            <tr>
                                <td scope="row">Suppliers</td>
                                <td>{{$data->supplier}}</td>
                            </tr>
                            <tr>
                                <td scope="row">24/7 Support</td>
                                <td><i class="anticon anticon-check"></i></td>
                            </tr>
                            <tr>
                                <td scope="row">Report & Voucher</td>
                                <td><i class="anticon anticon-check"></i></td>
                            </tr>
                            <tr>
                                <td scope="row">Android App</td>
                                <td><i class="anticon anticon-check"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>

@endsection

@section('script')

@endsection