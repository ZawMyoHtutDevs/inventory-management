@extends('admin.layouts.app')
@section('style')
<!-- select css -->
<link href="{{ asset('backend/vendors/select2/select2.css') }}"  rel="stylesheet">
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">{{$user_data->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('users')}}">Accounts</a>
            <span class="breadcrumb-item active">{{$user_data->name}}</span>
        </nav>
    </div>
    {{-- change Pssword --}}
    <a name="" id="" class="btn btn-primary float-right" href="#" role="button" data-toggle="modal" data-target="#change_password">Change Password</a>
</div>

@endsection
@section('content')

@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('success') }}
</div>
@endif

@include('admin.users.change_password')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <form method="POST" action="{{ route('update.user', $user_data->id) }}">
            @csrf @method('PUT')
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user_data->name}}" required autocomplete="name" autofocus>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email') ?? $user_data->email}}"  autocomplete="email">
                                
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone" class="text-md-right">{{ __('Phone') }}</label>
                                
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone') ?? $user_data->phone}}" required autocomplete="phone">
                                
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="is_admin">User Role</label>
                                <select name="is_admin" id="is_admin" class="form-control">
                                    <option value="{{$user_data->is_admin}}" selected>
                                        @switch($user_data->is_admin)
                                        @case('1')
                                        Admin
                                        @break
                                        @default
                                        User
                                        @endswitch
                                    </option>
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="agency_id">Choose Agency</label>
                                <select class="select2" name="agency_id" id="agency_id">
                                    <option value="">Select</option>
                                    @if ($user_data->agency_id)
                                    <option value="{{$user_data->agency->id ?? ''}}" checked>{{$user_data->agency->name}}</option>
                                    @endif

                                    @foreach ($agencies as $agen_data)
                                        <option value="{{$agen_data->id}}">{{$agen_data->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                    </div>
                    
                    
                    

                    
                    
                    
                    
                   
                    
                    <a name="" id="" class="btn btn-outline-primary float-right ml-1" href="{{ route('users')}}" role="button">Close</a>
                    
                    <button type="submit" class="btn btn-primary float-right">
                        {{ __('Change') }}
                    </button>
                </div>
                
                
                
            </div>
            
        </div>
    </form>
</div>
</div>

@endsection

@section('script')
<!-- select js -->
<script src="{{asset('backend/vendors/select2/select2.min.js')}}"></script>
<script>
    $('.select2').select2();
    
    
</script>
@endsection