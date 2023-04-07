@extends('agency.layouts.app', ['page_action' => $user->name])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header mb-3">
    <h2 class="header-title">{{$user->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('dashboard')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('agency.accounts.index')}}">Accounts</a>
            <span class="breadcrumb-item active">{{$user->name}}</span>
        </nav>
    </div>
    
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


<div class="row justify-content-center">
    <div class="col-md-8">
        
        <form method="POST" action="{{ route('agency.accounts.update', $user->id) }}">
            @csrf @method('PUT')
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}"  autocomplete="email">
                                
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="phone" class="text-md-right">{{ __('Phone') }}</label>
                                
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone') ?? $user->phone }}" required autocomplete="phone">
                                
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                   
                    
                    <a name="" id="" class="btn btn-outline-primary float-right ml-1" href="{{ route('agency.accounts.index')}}" role="button">Close</a>
                    
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="anticon anticon-save"></i> Save
                    </button>
                </div>
                
                
                
            </div>
            
        </div>
    </form>
</div>
</div>

@endsection

@section('script')

@endsection