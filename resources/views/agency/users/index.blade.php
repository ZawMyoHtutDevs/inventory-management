@extends('agency.layouts.app', ['page_action' => 'Accounts List'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

<div class="page-header no-gutters">
    <div class="row align-items-md-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h3>Account List</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right m-v-10">
                <span class="text-muted pr-3 pt-2 p">Total Result: {{count($accounts)}}</span>
                
                <button class="btn btn-default m-r-5 ml-2 btn-sm" data-toggle="modal" data-target="#filter" >
                    <i class="anticon anticon-filter"></i>
                    <span class="m-l-5">Filter</span>
                </button>
                
                <button href="" class="btn btn-primary m-r-5 ml-2 btn-sm" data-toggle="modal" data-target="#add_user" >
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
@if (Session::has('account_limit'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('account_limit') }} - <a href="{{route('agency.plans.index')}}">Upgrade Plan</a>
</div>
@endif

<div class="container-fluid">
    
    <div id="card-view">
        <div class="row">

            @foreach ($accounts as $data)
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-image">
                                <img src="{{asset('backend/images/user.png')}}" alt="">
                            </div>
                            <div class="m-l-10">
                                <div class="m-b-0 text-dark font-weight-semibold">{{$data->name}}</div>
                                <div class="m-b-0 opacity-07 font-size-13">{{$data->products->count()}} Products</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            @if (auth()->user()->id == $data->id)
                            <a href="{{route('agency.accounts.edit', $data->id)}}" class="btn btn-default btn-xs">Change Password</a>
                            <a href="{{route('agency.accounts.edit', $data->id)}}" class="btn btn-primary btn-xs">Edit</a>
                            @else
                            <small class="text-muted">Not Your Accunt</small>
                            
                            @endif
                            
                        </div>
                    </div>
                </div>
                
            </div>
            @endforeach

        </div>
    </div>


    {!! $accounts->appends(array("name" => request()->get('name','') ))->links() !!}
</div>


{{-- Add Form Blade --}}
@include('agency.users.parts.add_form')

{{-- Filter Form Blade --}}
@include('agency.users.parts.filter_form')

@endsection

@section('script')

@if ($errors->any())
<script>
    $('#add_user').modal('show')
</script>
@endif
    
@endsection