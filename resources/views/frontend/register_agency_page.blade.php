@extends('frontend.layouts.app', ['page_action' => 'Register'])
@section('style')

@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')

@endsection

@section('content')
{{-- validated error --}}
@if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            @foreach ($errors->all() as $error) {{$error}} <br> @endforeach
        </div>
@endif

<div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('{{asset('backend/images/others/login-3.png')}}')">
    <div class="d-flex flex-column justify-content-between w-100">
        <div class="container d-flex h-100">
            <div class="row align-items-center w-100">
                <div class="col-md-9 col-lg-8 m-h-auto">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between m-b-30">
                                <img class="img-fluid" alt="" src="assets/images/logo/logo.png">
                                <h2 class="m-b-0">အကောင့်ဖွင့်ရန်</h2>
                            </div>
                            <form action="{{route('frontend.store')}}" method="post" enctype="multipart/form-data">
                                @csrf @method('POST')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="logo">ဆိုင်လိုဂို</label>
                                            <input type="file" class="form-control" name="logo" id="logo" placeholder="သင့်နာမည်">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="shopname">ဆိုင်နာမည်</label>
                                            <input type="text" class="form-control" name="shopname" id="shopname" placeholder="ဆိုင်နာမည်">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="username">သင့်နာမည်</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="သင့်နာမည်">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="phone">ဖုန်း</label>
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="ဖုန်း">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">စကားဝှတ်</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="စကားဝှတ်">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password_confirmation">အတည်ပြု စကားဝှတ်</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="အတည်ပြု စကားဝှတ်">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between p-t-15">
                                        <div class="checkbox">
                                            <input id="checkbox" name="terms" type="checkbox" required>
                                            <label for="checkbox"><span>သဘောတူသည် <a href="{{route('frontend.terms')}}">စည်းကမ်းနှင့်သတ်မှတ်ချက်များ</a></span></label>
                                        </div>
                                        <button class="btn btn-primary">အတည်ပြုသည်</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection

@section('script')
<script>
 
</script>
@endsection