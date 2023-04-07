@extends('admin.layouts.app')
@section('style')
<!-- select css -->
<link href="{{ asset('backend/vendors/select2/select2.css') }}"  rel="stylesheet">
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Create New User</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('users')}}">Accounts</a>
            <span class="breadcrumb-item active">New User</span>
        </nav>
    </div>
    
</div>

@endsection
@section('content')



<div class="row justify-content-center">
    <div class="col-md-8">
        
        <form method="POST" action="{{ route('create.user') }}">
            @csrf 
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                                
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone" class="text-md-right">{{ __('Phone') }}</label>
                                
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}" required autocomplete="phone">
                                
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
                                    
                                    <option value="1" selected>Admin</option>
                                    <option value="0">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="agency_id">Choose Agency</label>
                                <select class="select2" name="agency_id" id="agency_id">
                                    <option value="">Select</option>
                                    @foreach ($agencies as $agen_data)
                                        <option value="{{$agen_data->id}}">{{$agen_data->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group ">
                                <label for="password" class="text-md-right">{{ __('Password') }}</label>
                                
                                
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group ">
                                <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>
                                
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                
                            </div>
                        </div>
                    </div>
                   
                    
                    <a name="" id="" class="btn btn-outline-primary float-right ml-1" href="{{ route('users')}}" role="button">Close</a>
                    
                    <button type="submit" class="btn btn-primary float-right">
                        {{ __('Add') }}
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