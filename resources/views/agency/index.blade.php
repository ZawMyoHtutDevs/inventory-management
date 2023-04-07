@extends('agency.layouts.app', ['page_action' => auth()->user()->agency->name])
@section('style')
<link rel="stylesheet" href="{{asset('/backend/owl/assets/owl.carousel.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('/backend/owl/assets/owl.theme.green.min.css')}}"> --}}
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header no-gutters ">
    
    
    <div class="d-md-flex m-b-15 align-items-center justify-content-between">
        <div class="media align-items-center m-b-15">
            
            <div class="m-l-15">
                <h4 class="m-b-0">Welcome, {{auth()->user()->name}}</h4>
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

<div class=" owl-carousel">
    <div class="">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-dollar"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">Products</p>
                        <h4 class="m-b-0 ">{{ $products->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-dollar"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">Orders</p>
                        <h4 class="m-b-0 ">{{ $sales->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-hourglass"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">Customers</p>
                        <h4 class="m-b-0 ">{{ $customers->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-exclamation-circle"></i>
                    <div class="m-l-15">
                        <p class="m-b-0 text-muted">Suppliers</p>
                        <h4 class="m-b-0 ">{{ $suppliers->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="align-items-center">
                    <i class="font-size-40 text-primary anticon anticon-dollar"></i>
                </div>
                
                <div class="media align-items-center">
                    
                    <p class="m-b-0 text-center">ADD Products</p>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- <div class="card">
    
    <div class="card-body">
        <h4 class="card-title">Latest Orders</h4>
        
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Order No</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($sales_10 as $data)
                    <tr>
                        <th scope="row">{{$data->order_number}}</th>
                        <td>{{$data->total_price}}</td>
                        <td>
                            @switch($data->status)
                                        @case('Delivery Ongoing')
                                        <span class="badge badge-pill badge-info">Delivery Ongoing</span>
                                            @break
                                        @case('Completed')
                                        <span class="badge badge-pill badge-success">Completed</span>
                                            @break
                                        @case('Payment Pending')
                                        <span class="badge badge-pill badge-warning">Payment Pending</span>
                                            @break
                                        @case('On Hold')
                                        <span class="badge badge-pill badge-warning">On Hold</span>  
                                            @break
                                        @default
                                        <span class="badge badge-pill badge-danger">Cancelled</span>
                                    @endswitch
                        </td>
                        <td><a href="{{route('agency.sales.show', $data->order_number)}}" class="btn btn-info btn-sm">View</a></td>
                    </tr>
                    @endforeach
                    
                    
                    
                </tbody>
            </table>
        </div>
        
        
    </div>
    
</div> --}}

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="{{asset('/backend/owl/owl.carousel.min.js')}}"></script>

<script>
    $(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
  });
});
</script>
@endsection