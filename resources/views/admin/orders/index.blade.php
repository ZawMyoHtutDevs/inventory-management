@extends('admin.layouts.app')
@section('style')
<!-- page css -->
<link href="{{ asset('backend/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection
{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

<div class="page-header">
    <h2 class="header-title">Orders List</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('dashboard')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <span class="breadcrumb-item active">Orders</span>
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
            
            
            <div class="card-body">
                <table id="data-table" class="table" class="table table-inverse ">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Agency</th>
                            <th>User</th>
                            <th>Payment Type</th>
                            <th>Plan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $data)
                        <tr>
                            <td>
                                @switch($data->status)
                                    @case('active')
                                        <span class="badge badge-success">Active</span>
                                        @break
                                    @case('pending')
                                        <span class="badge badge-warning">Pending</span>
                                        @break
                                    @default
                                        <span class="badge badge-danger">Cancelled</span>
                                @endswitch
                            </td>
                            <td>
                                {{$data->agency->name}}
                            </td>
                            <td>
                                {{$data->user->name}}
                            </td>
                            <td>{{$data->payment_type}}</td>
                            <td>{{$data->plan->name}}</td>
                            
                            <td>       
                                {{-- Edit and View --}}
                                <a href="{{route('agency.plans.view', $data->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded pull-right text-primary">
                                    <i class="anticon anticon-eye"></i>
                                </a>
                                {{-- Delete User --}}
                               
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded text-danger" type="submit" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$data->id}}').submit(); }">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                                <form id="delete-form{{$data->id}}" method="POST" action="{{route('delete.user', $data->id)}}" >
                                    @csrf
                                </form>
                                
                                
                                
                                
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