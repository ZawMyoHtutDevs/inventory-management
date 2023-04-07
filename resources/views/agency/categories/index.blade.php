@extends('agency.layouts.app', ['page_action' => 'Category List'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

<div class="page-header no-gutters">
    <div class="row align-items-md-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h3>Category List</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right m-v-10">
                <span class="text-muted pr-3 pt-2 p">Total Result: {{count($categories)}}</span>
                
                <button class="btn btn-default m-r-5 ml-2 btn-sm" data-toggle="modal" data-target="#filter" >
                    <i class="anticon anticon-filter"></i>
                    <span class="m-l-5">Filter</span>
                </button>


                <button class="btn btn-primary m-r-5 ml-2 btn-sm" data-toggle="modal" data-target="#add_category" >
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
@if (Session::has('category_limit'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('category_limit') }} - <a href="{{route('agency.plans.index')}}">Upgrade Plan</a>
</div>
@endif

<div class="container-fluid">
    
    <div id="card-view">
        <div class="row">

            @foreach ($categories as $data)
            <div class="col-lg-3 col-md-6 col-6" style="padding-right: 5px;
            padding-left: 3px;">
                <div class="card" style="margin-bottom: 10px;">
                    <div class="card-body" style="padding-top: 0.7em; padding-left: 0.3em; padding-right: 0.3em;">
                        <div class="d-flex align-items-center" style="word-wrap: break-word;
                        display: block !important;
                        height: 57px;">
                            
                            <div class="m-l-10">
                                <div class="m-b-0 text-dark font-weight-semibold">{{$data->name}}</div>
                                <div class="m-b-0 opacity-07 font-size-13">{{$data->products->count()}} Products</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding: 0.7rem;">
                        <div class="text-right">
                            <div class="avatar avatar-icon avatar-sm mr-2" data-toggle="tooltip" data-placement="top" title="{{$data->user->name}}">
                                <i class="anticon anticon-user"></i>
                            </div>
                            <a class="btn btn-default btn-xs" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$data->id}}').submit(); }">Delete</a>

                            <a href="{{route('agency.categories.edit', $data->id)}}" class="btn btn-primary btn-xs">Edit</a>

                            <form style="display: none;" id="delete-form{{$data->id}}" method="POST" action="{{route('agency.categories.destroy', $data->id)}}" >
                                @csrf @method('DELETE')
                            </form>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            @endforeach

        </div>
    </div>


    {!! $categories->appends(array("name" => request()->get('name','') ))->links() !!}
</div>


{{-- Add Form Blade --}}
@include('agency.categories.parts.add_form')

{{-- Filter Form Blade --}}
@include('agency.categories.parts.filter_form')

@endsection

@section('script')

@if ($errors->any())
<script>
    $('#addnew').modal('show')
</script>
@endif
    
@endsection