@extends('frontend.layouts.app', ['page_action' => 'Contact'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header mb-3 p-5">
    <h2 class="header-title">Contact Us</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('frontend.index')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
            
            <span class="breadcrumb-item active">Contact</span>
        </nav>
    </div>
    
</div>
@endsection

@section('content')



@endsection

@section('script')
@include('frontend.layouts.promo')
<script>
    function openPromo(){
        $('#promo').modal('show')
    }
setTimeout(openPromo, 5000);
    
</script>
@endsection