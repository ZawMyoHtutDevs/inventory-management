@extends('admin.layouts.app')
@section('style')
<!-- select css -->
<link href="{{ asset('backend/vendors/select2/select2.css') }}"  rel="stylesheet">
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header">
    <h2 class="header-title">Create New Agency</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('home')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('admin.agencies.index')}}">Agencies</a>
            <span class="breadcrumb-item active">New Agency</span>
        </nav>
    </div>
    
</div>

@endsection
@section('content')

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
        
        <form method="POST" action="{{ route('admin.agencies.store') }}" enctype="multipart/form-data">
            @csrf @method('POST')
            <div class="card">
                <div class="card-body">
                    <div class="row">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Agency Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="business_type">Business Type</label>
                                <input id="business_type" type="text" class="form-control @error('business_type') is-invalid @enderror" name="business_type" value="{{ old('business_type') }}" autocomplete="business_type">
                                @error('business_type')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="currency">Currency</label>
                                <select class="form-control" name="currency" id="currency" style="text-transform:capitalize;" required>
                                    <option value="" selected>Selete Currency</option>
                                    <option value="Ks">Ks</option>
                                    <option value="MMK">MMK</option>
                                    <option value="$">$</option>
                                    <option value="Lakh">Lakh</option>
                                </select>
                              </div>
                        </div>
                        
                    </div>
                    
                    
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Agency Status</label>
                                <select class="form-control" name="status" id="status" style="text-transform:capitalize;" required>
                                  @if (old('status'))
                                      <option value="{{old('status')}}" selected>{{old('status')}}</option>
                                  @endif
                                  <option value="active">active</option>
                                  <option value="pending">pending</option>
                                  <option value="cancelled">cancelled</option>
                                </select>
                              </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="plan_id">Choose Plan</label>
                                <select class="select2" name="plan_id" id="plan_id">
                                    <option value="">Select</option>
                                    @foreach ($plans as $plan_data)
                                        <option value="{{$plan_data->id}}">{{$plan_data->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="start_date">Start Date</label>
                              <input type="date"
                                class="form-control" name="start_date" id="start_date" aria-describedby="start_date" required value="{{ old('start_date') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date"
                                  class="form-control" name="end_date" id="end_date" aria-describedby="end_date" value="{{ old('end_date') }}">
                              </div>
                        </div>
                    </div>
                    
                   
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror" autocomplete="description" rows="3">
                            {{old('description')}}</textarea>
                    </div>

                    
                    <a name="" id="" class="btn btn-outline-primary float-right ml-1" href="{{ route('admin.agencies.index')}}" role="button">Close</a>
                    
                    <button type="submit" class="btn btn-primary float-right">
                        {{ __('Add') }}
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