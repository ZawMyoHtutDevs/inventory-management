@extends('admin.layouts.app')
@section('style')
<!-- page css -->
<link href="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">

<style>
    #data-table_filter input{
        max-width: 200px !important;
    }
</style>
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">All Pricing Plan</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <span class="breadcrumb-item active">Plans</span>
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
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header mt-3 h3">{{ __('All Pricing Plan') }} 
                <a href="{{route('admin.plans.create')}}" class="btn btn-primary m-r-5 float-right">Add <i class="anticon anticon-plus-square"></i></a>
            </div>
            
            <div class="card-body">
                <table id="data-table" class="table" class="table table-inverse ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Pricing</th>
                            <th>Limit Time</th>
                            <th>Active Agencies</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->pricing}} - {{$data->currency_type}}</td>
                            <td>{{$data->time}} Days</td>
                            <td>
                                {{$data->agencies->count()}}
                            </td>
                            <td>
                               
                                {{-- Edit --}}
                                <a href="{{route('admin.plans.edit', $data->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded pull-right text-primary">
                                    <i class="anticon anticon-edit"></i>
                                </a>
                                {{-- Delete User --}}
                                
                                {{-- <button class="btn btn-icon btn-hover btn-sm btn-rounded text-danger" type="submit" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$data->id}}').submit(); }">
                                    <i class="anticon anticon-delete"></i>
                                </button> --}}
                                {{-- <form id="delete-form{{$data->id}}" method="POST" action="{{route('delete.user', $data->id)}}" >
                                    @csrf
                                </form> --}}
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<!-- page js -->
<script src="{{ asset('backend/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
    
    
    $('#data-table').DataTable();
    
    
</script>
@endsection