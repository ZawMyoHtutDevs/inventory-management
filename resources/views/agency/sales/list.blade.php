@extends('agency.layouts.app', ['page_action' => 'Sales List'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

<div class="page-header no-gutters">
    <div class="row align-items-md-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h3>Sale List</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right m-v-10">
                <span class="text-muted pr-3 pt-2 p">Total Result: {{count($sales)}}</span>
                
                <button class="btn btn-default m-r-5 ml-2 btn-sm" data-toggle="modal" data-target="#filter" >
                    <i class="anticon anticon-filter"></i>
                    <span class="m-l-5">Filter</span>
                </button>


                <a class="btn btn-primary m-r-5 ml-2 btn-sm" href="{{route('agency.sales.index')}}" >
                    <i class="anticon anticon-plus"></i>
                    <span class="m-l-5">New</span>
                </a>

            </div>
        </div>
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

<div class="container-fluid">
    
    <div id="card-view">
        <div class="row">

            @foreach ($sales as $data)
            <div class="col-lg-3 col-md-6 col-6" style="padding-right: 5px;
            padding-left: 3px;">
                <div class="card" style="margin-bottom: 10px;">
                    <div class="card-body" style="padding-top: 0.7em; padding-left: 0.3em; padding-right: 0.3em;">
                        <div class="d-flex align-items-center" >
                            
                            <div class="m-l-10">
                                <div class="pb-1 text-dark font-weight-semibold">Invoice No({{$data->order_number}})</div>
                                <div class="pb-1 opacity-07 font-size-15">{{$data->total_price}} {{auth()->user()->agency->currency}}</div>
                                <div class="pb-1 opacity-07 font-size-13">

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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding: 0.7rem;">
                        <div class="text-right">

                           

                            <a href="{{route('agency.sales.invoice.pdf', $data->order_number)}}" class="btn btn-primary btn-xs">Download</a>
                            <a href="{{route('agency.sales.show', $data->order_number)}}" class="btn btn-info btn-xs">View</a>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            @endforeach

        </div>
    </div>


    {!! $sales->appends(array("name" => request()->get('name',''),"status" => request()->get('status','') ))->links() !!}
</div>

{{-- Filter Form Blade --}}
@include('agency.sales.parts.list_filter_form')

@endsection

@section('script')

@if ($errors->any())
<script>
    $('#addnew').modal('show')
</script>
@endif
    
@endsection