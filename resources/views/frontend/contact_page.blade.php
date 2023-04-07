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

<div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" >
    <div class="d-flex flex-column justify-content-between w-100">
        <div class="container d-flex h-100">
            <div class="row align-items-center w-100">
                <div class="col-md-8 col-lg-8 m-h-auto">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScIItiQCGOAGy5cfpDbVml-5nsRu21fWVvDxBsEDRDwZ4pwdw/viewform?embedded=true" width="640" height="800" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>


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