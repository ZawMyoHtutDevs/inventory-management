@extends('agency.layouts.app')
@section('style')
<!-- select css -->
<link href="{{ asset('backend/vendors/select2/select2.css') }}"  rel="stylesheet">
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">{{$agency->name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('admin.agencies.index')}}">Agencies</a>
            <span class="breadcrumb-item active">Edit Agency</span>
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
{{-- Error message --}}
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('error') }}
</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-8">
        
        <form method="POST" action="{{ route('agency.agencies.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="avatar avatar-image" style="width: 80px; height: 80px;">
                                <img src="
                                @if (!empty($agency->asset))
                                {{asset('agencies/'.$agency->unit_id.'/'.$agency->asset)}}
                                @else
                                    {{asset('backend/images/client_logo.png')}}
                                @endif
                                " alt="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="asset">Select Logo</label>
                                <input id="asset" type="file" class="form-control @error('asset') is-invalid @enderror" name="asset" value="{{ old('asset') }}" autocomplete="asset" >
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">Agency Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $agency->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $agency->phone }}" required autocomplete="phone" autofocus>
                                @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="business_type">Business Type</label>
                                <input id="business_type" type="text" class="form-control @error('business_type') is-invalid @enderror" name="business_type" value="{{ old('business_type') ?? $agency->business_type }}" autocomplete="business_type">
                                @error('business_type')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="currency">Currency</label>
                                <select class="form-control" name="currency" id="currency" style="text-transform:capitalize;" required>
                                    <option value="{{$agency->currency}}" selected>{{$agency->currency}}</option>
                                    <option value="Ks">Ks</option>
                                    <option value="MMK">MMK</option>
                                    <option value="$">$</option>
                                    <option value="Lakh">Lakh</option>
                                </select>
                              </div>
                        </div>
                        
                    </div>
                    
                    
                    
                    
                   
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror" autocomplete="description" rows="3">{{ old('description') ?? $agency->description }}</textarea>
                    </div>

                    
                    <a name="" id="" class="btn btn-outline-primary float-right ml-1" href="{{ route('admin.agencies.index')}}" role="button">Close</a>
                    
                    <button type="submit" class="btn btn-primary float-right">
                        {{ __('Update') }}
                    </button>
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