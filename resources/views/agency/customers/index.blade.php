@extends('agency.layouts.app', ['page_action' => 'Customer List'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

<div class="page-header no-gutters">
    <div class="row align-items-md-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h3>Customer List</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right m-v-10">
                <span class="text-muted pr-3 pt-2 p">Total Result: {{count($customers)}}</span>
                
                <button class="btn btn-default m-r-5 ml-2 btn-sm" data-toggle="modal" data-target="#filter" >
                    <i class="anticon anticon-filter"></i>
                    <span class="m-l-5">Filter</span>
                </button>


                <button class="btn btn-primary m-r-5 ml-2 btn-sm" data-toggle="modal" data-target="#add_customer" >
                    <i class="anticon anticon-plus"></i>
                    <span class="m-l-5">New</span>
                </button>

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

{{-- Limit message --}}
@if (Session::has('customer_limit'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('customer_limit') }} - <a href="{{route('agency.plans.index')}}">Upgrade Plan</a>
</div>
@endif

<div class="container-fluid">
    
    <div id="card-view">
        <div class="row">

            @foreach ($customers as $data)
            <div class="col-lg-3 col-md-6 col-6" style="padding-right: 5px;
            padding-left: 3px;">
                <div class="card" style="margin-bottom: 10px;">
                    <div class="card-body" style="padding-top: 0.7em; padding-left: 0.3em; padding-right: 0.3em;">
                        <div class="d-flex align-items-center" style="word-wrap: break-word;
                        display: block !important;
                        height: 57px;">
                            
                            <div class="m-l-10">
                                <div class="m-b-0 text-dark font-weight-semibold">{{$data->name}}</div>
                                <div class="m-b-0 opacity-07 font-size-13">{{$data->phone ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding: 0.7rem;">
                        <div class="text-right">

                            <a class="btn btn-default btn-xs" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$data->id}}').submit(); }">Delete</a>
                            
                            <a href="{{route('agency.customers.edit', $data->id)}}" class="btn btn-primary btn-xs">Edit</a>
                            <a href="{{route('agency.customers.view', $data->id)}}" class="btn btn-info btn-xs">View</a>

                            <form style="display: none;" id="delete-form{{$data->id}}" method="POST" action="{{route('agency.customers.destroy', $data->id)}}" >
                                @csrf @method('DELETE')
                            </form>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            @endforeach

        </div>
    </div>


    {!! $customers->appends(array("name" => request()->get('name',''), "phone" => request()->get('phone','') ))->links() !!}
</div>


{{-- Add Form Blade --}}
@include('agency.customers.parts.add_form')

{{-- Filter Form Blade --}}
@include('agency.customers.parts.filter_form')

@endsection

@section('script')

@if ($errors->any())
<script>
    $('#addnew').modal('show')
</script>
@endif
    
@endsection