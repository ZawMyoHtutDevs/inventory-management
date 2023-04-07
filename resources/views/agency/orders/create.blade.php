@extends('agency.layouts.app', ['page_action' => 'Order Plan'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

<div class="page-header no-gutters">
    <div class="row align-items-md-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h3>{{$plan->name}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right m-v-10">
                
                
                <button class="btn btn-warning m-r-5 ml-2 btn-sm" >
                    <span class="m-l-5">{{$plan->pricing}} {{auth()->user()->agency->currency}}</span>
                </button>

            </div>
        </div>
    </div>
</div> 


@endsection
@section('content')

{{-- Success message --}}
@if (Session::has('login_success'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('login_success') }}
</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-8">
        
        <form method="POST" action="{{ route('agency.plans.order.store', $plan->id) }}" enctype="multipart/form-data">
            @csrf 
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">နာမည်</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="asset">Payment Slip / Screenshot</label>
                                <p class="form-text text-muted">
                                    ငွေပေးချေခဲ့သော ပြေစာ Screenshot ထည့်ပေးပါရန်။
                                </p>
                                <input id="asset" type="file" class="form-control @error('asset') is-invalid @enderror" name="asset" value="{{ old('asset') }}"  autocomplete="asset">
                                
                                @error('asset')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                                <div class="row">
                                    <div class="col-md-3 payment_type_img">
                                        <div class="radio">
                                            <input id="kbzpay" name="payment_type" type="radio"  value="KBZ Pay">
                                            <label for="kbzpay">KBZ Pay</label>
                                        </div>
                                        <img  src="{{asset('backend/images/payment/kbzpay.png')}}" class="img-fluid" onclick="paymenttype('kbzpay')">
                                        
                                    </div>
                                    <div class="col-md-3 payment_type_img">
                                        <div class="radio">
                                            <input id="kbzbank" name="payment_type" type="radio"  value="KBZ Bank">
                                            <label for="kbzbank">KBZ Bank</label>
                                        </div>
                                        <img  src="{{asset('backend/images/payment/kbzbank.png')}}" class="img-fluid" onclick="paymenttype('kbzbank')">
                                        
                                    </div>
                                    <div class="col-md-3 payment_type_img">
                                        <div class="radio">
                                            <input id="ayabank" name="payment_type" type="radio"  value="AYA Bank">
                                            <label for="ayabank">AYA Bank</label>
                                        </div>
                                        <img  src="{{asset('backend/images/payment/ayabank.png')}}" class="img-fluid" onclick="paymenttype('ayabank')">
                                        
                                    </div>

                                    <div class="col-md-3 payment_type_img">
                                        <div class="radio">
                                            <input id="wave" name="payment_type" type="radio" value="Wave Pay">
                                            <label for="wave">Wave Pay</label>
                                        </div>
                                        <img  src="{{asset('backend/images/payment/wave.png')}}" class="img-fluid" onclick="paymenttype('wave')">
                                        
                                    </div>
                                </div>
                                
                                
                                
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary float-right">
                        {{ __('အတည်ပြုသည်') }}
                    </button>
                </div>
                
                
                
            </div>
        
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    

    function paymenttype(id){


        document.getElementById('kbzpay').removeAttribute('checked');
        document.getElementById('kbzbank').removeAttribute('checked');
        document.getElementById('wave').removeAttribute('checked');
        document.getElementById('ayabank').removeAttribute('checked');

        document.getElementById(id).setAttribute('checked', true)
    }
</script>
@endsection