@extends('frontend.layouts.app', ['page_action' => 'Home'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

@endsection

@section('content')

<div class="row">
    <div class="col-md-6 header-41">
        <h1>သင့်ကုန်ပစ္စည်းများကို <span>စနစ်တကျ</span> ထိမ်းသိမ်းလိုက်ပါ။</h1>
        <h4>ကုန်ပစ္စည်းတွေ များပြားလို့ ထိမ်းသိမ်းရခက်ခဲနေရင် ကျနော်တို့ 41 Inventory ဖြင့် စနစ်တကျ သိမ်းစည်းလိုက်ပါ။</h4>
        <a href="{{route('frontend.register')}}" class="btn btn-primary mt-4">အကောင့်ဖွင့်ရန်</a>
    </div>

    <div class="col-md-6">
        <img src="{{asset('asset/inventory.png')}}" alt="" width="100%">
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="features p-3 mx-4 mb-5">
                <span class="icon-holder">
                    <i class="anticon anticon-appstore"></i>
                </span>
                <p>ကုန်ပစ္စည်း စာရင်း</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="features p-3 mx-4 mb-5">
                <span class="icon-holder">
                    <i class="anticon anticon-tag"></i>
                </span>
                <p>အမျိုးအစား ခွဲခြင်း</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="features p-3 mx-4 mb-5">
                <span class="icon-holder">
                    <i class="anticon anticon-team"></i>
                </span>
                <p>ဝယ်ယူသူ စာရင်း</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="features p-3 mx-4 mb-5">
                <span class="icon-holder">
                    <i class="anticon anticon-solution"></i>
                </span>
                <p>ရောင်းသူများ စာရင်း</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="features p-3 mx-4 mb-5">
                <span class="icon-holder">
                    <i class="anticon anticon-shopping-cart"></i>
                </span>
                <p>အော်ဒါများ</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="features p-3 mx-4 mb-5">
                <span class="icon-holder">
                    <i class="anticon anticon-file-text"></i>
                </span>
                <p >လက်ခံဘောင်ချာ</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <h3 class="header_41">
        ဈေးနှုန်းများ
        <hr>
    </h3>

    @include('frontend.layouts.plan')
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