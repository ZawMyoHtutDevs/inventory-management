@extends('admin.layouts.app')
@section('style')
    
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @can('admin')
                        admin
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    
@endsection