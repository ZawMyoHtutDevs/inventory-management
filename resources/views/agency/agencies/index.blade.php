@extends('agency.layouts.app', ['page_action' => 'View Agency'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header no-gutters ">
      

    <div class="d-md-flex m-b-15 align-items-center justify-content-between">
        <div class="media align-items-center m-b-15">
            <div class="avatar avatar-image rounded" style="height: 70px; width: 70px">
                <img src="{{asset('agencies/'.$agency->unit_id.'/'.$agency->asset)}}" alt="">
            </div>
            <div class="m-l-15">
                <h4 class="m-b-0">{{$agency->name}}</h4>
                <p class="text-muted m-b-0">
                    @switch($agency->status)
                        @case('active')
                            <span class="badge badge-pill badge-cyan">Active</span>
                            @break
                        @case('pending')
                            <span class="badge badge-pill badge-gold">Pending</span>
                            @break
                        @default
                            <span class="badge badge-pill badge-red">Cancled</span>
                    @endswitch

                    
                </p>
            </div>
        </div>
        <div class="m-b-15">
            <a href="{{route('agency.plans.index')}}" class="btn btn-success">
                <i class="anticon anticon-to-top"></i>
                <span>Upgreat Plan</span>
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
                    <i class="font-size-40 text-primary anticon anticon-dollar"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">Plan</p>
                        <h4 class="m-b-0 ">{{$agency->plan->name}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-hourglass"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">Start Date</p>
                        <h4 class="m-b-0 ">{{ Carbon\Carbon::parse($agency->start_date)->format('M d-Y') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-exclamation-circle"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">End Date</p>
                        <h4 class="m-b-0 ">{{ Carbon\Carbon::parse($agency->end_date)->format('M d-Y') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<div class="card">

    <div class="card-body">
        <h4 class="card-title">Plan Info</h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Plan Details</th>
                        <th>Your Details</th>
                        <th>{{$agency->plan->name}}</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <th>Products</th>
                        <td class="text-dark font-weight-semibold">{{$agency->products->count()}} ({{$agency->plan->product - $agency->products->count()}}) Left</td>
                        <td>{{$agency->plan->product}} Products</td>
                    </tr>
                    <tr>
                        <th>Customers</th>
                        <td class="text-dark font-weight-semibold">{{$agency->customers->count()}} ({{$agency->plan->customer - $agency->customers->count()}}) Left</td>
                        <td>{{$agency->plan->customer}} Customers</td>
                    </tr>
                    <tr>
                        <th>Categories</th>
                        <td class="text-dark font-weight-semibold">{{$agency->categories->count()}} ({{$agency->plan->category - $agency->categories->count()}}) Left</td>
                        <td>{{$agency->plan->category}} Categories</td>
                    </tr>
                    <tr>
                        <th>Brands</th>
                        <td class="text-dark font-weight-semibold">{{$agency->brands->count()}} ({{$agency->plan->brand - $agency->brands->count()}}) Left</td>
                        <td>{{$agency->plan->brand}} Brands</td>
                    </tr>
                    <tr>
                        <th>Suppliers</th>
                        <td class="text-dark font-weight-semibold">{{$agency->suppliers->count()}} ({{$agency->plan->supplier - $agency->suppliers->count()}}) Left</td>
                        <td>{{$agency->plan->supplier}} Suppliers</td>
                    </tr>
                    
                </tbody>
            </table> 
        </div>
    </div>

</div>

@endsection

@section('script')

@endsection