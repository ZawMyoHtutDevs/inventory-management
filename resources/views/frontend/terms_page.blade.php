@extends('frontend.layouts.app', ['page_action' => 'Contact'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header mb-3 p-5">
    <h2 class="header-title">Terms and Conditions</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('frontend.index')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
            
            <span class="breadcrumb-item active">Terms and Conditions</span>
        </nav>
    </div>
    
</div>
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="mt-3">Terms and Conditions</h3>
        </div>
        <div class="card-body">
            <p>Thank you for choosing Airanus Co., Ltd for your digital gift card needs. Please read our terms and conditions carefully before using our services.</p>
            <hr>
            <h5>Definitions</h5>
            <p>In these terms and conditions, the following definitions apply:
                "Airanus Co., Ltd" refers to the digital gift card business entity.
                "Client" refers to any person or entity that uses Airanus Co., Ltd's digital gift card services.
                "Gift Card" refers to a digital gift card sold by Airanus Co., Ltd
            </p>
            <h5>Ordering and Payment</h5>
            <p>
                The Client shall place an order for a Gift Card via Airanus Co., Ltd's website or any other agreed-upon means.
                Payment shall be made in full by the Client at the time of purchase.

            </p>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection