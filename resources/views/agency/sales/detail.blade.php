@extends('agency.layouts.app', ['page_action' => 'Invoice'])
@section('style')
{{-- <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script> --}}
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
@endsection

{{-- Breadcrumb Data Here --}}
@section('breadcrumb')
<div class="page-header mb-3">
    <h2 class="header-title">{{$sale->order_number}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('dashboard')}}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
            <a class="breadcrumb-item" href="{{route('agency.sales.list')}}">Sales</a>
            <span class="breadcrumb-item active">Invoice</span>
        </nav>
    </div>

    
    <button class="btn btn-primary float-right btn-sm" onclick="downloadimage()"> <i class="anticon anticon-cloud-download"></i> Download Invoice</button>
    
</div>

@endsection
@section('content')

<div class="container" id="htmltoimage" style="width: 1000px">

    <div class="card">
        <div class="card-body">
            <div id="invoice" class="p-h-30">
                <div class="m-t-15 lh-2">
                    <div class="inline-block">
                        <img class="img-fluid" width="70px" 
                        src="
                        @if (!empty(auth()->user()->agency->asset))
                            {{asset('agencies/'.auth()->user()->agency->unit_id.'/'.auth()->user()->agency->asset)}}
                        @else
                            {{asset('backend/images/client_logo.png')}}
                        @endif
                        " alt="">
                        <address class="p-l-10">
                            <span class="font-weight-semibold text-dark">{{auth()->user()->agency->name}}</span><br>
                            <span>{{auth()->user()->agency->business_type}}</span><br>
                            <abbr class="text-dark" title="Phone">Phone:</abbr>
                            <span>{{auth()->user()->agency->phone}}</span>
                        </address>
                    </div>
                    <div class="float-right">
                        <h2>INVOICE</h2>
                    </div>
                </div>
                <div class="row m-t-20 lh-2">
                    <div class="col-9">
                        <h3 class="p-l-10 m-t-10">Invoice To:</h3>
                        <address class="p-l-10 m-t-10">
                            <span class="font-weight-semibold text-dark">{{$sale->customer->name}}</span><br>
                            <span>Phone </span><br>
                            <span>{{$sale->customer->phone}}</span>
                        </address>
                    </div>
                    <div class="col-3">
                        <div class="m-t-80">
                            <div class="text-dark text-uppercase d-inline-block">
                                <span class="font-weight-semibold text-dark">Invoice No :</span></div>
                            <div class="float-right">{{$sale->order_number}}</div>
                        </div>
                        <div class="text-dark text-uppercase d-inline-block">
                            <span class="font-weight-semibold text-dark">Date :</span>
                        </div>
                        <div class="float-right">{{Carbon\Carbon::parse($sale->created_at)->format('M d Y')}}</div>
                    </div>
                </div>
                <div class="m-t-20">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Items</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $json_arry = json_decode($sale->products_data);
                                    $id = 1;
                                    $sub_total_price = 0;
                                    foreach($json_arry as $key => $json) { 
                                        $sub_total_price += $json->total;

                                    }
                                @endphp

                                @foreach ($json_arry as $key => $data)
                                    <tr>
                                        <th>{{$id++}}</th>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->count}}</td>
                                        <td>{{$data->price}} {{auth()->user()->agency->currency}}</td>
                                        <td>{{$data->total}} {{auth()->user()->agency->currency}}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row m-t-30 lh-1-8">
                        <div class="col-sm-12">
                            <div class="float-right text-right">
                                <p>Sub - Total amount: {{$sub_total_price}} {{auth()->user()->agency->currency}}</p>
                                <p>Discount : {{$sale->discount_price ?? '0'}} {{auth()->user()->agency->currency}} </p>
                                <hr>
                                <h3><span class="font-weight-semibold text-dark">Total :</span> {{$sale->total_price}} {{auth()->user()->agency->currency}}</h3>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row m-t-30 lh-2">
                        <div class="col-sm-12">
                            <div class="border-bottom p-v-20">
                                <p class="text-opacity"><small>In exceptional circumstances, Financial Services can provide an urgent manually processed special cheque. Note, however, that urgent special cheques should be requested only on an emergency basis as manually produced cheques involve duplication of effort and considerable staff resources. Requests need to be supported by a letter explaining the circumstances to justify the special cheque payment.</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="row m-v-20">
                        <div class="col-sm-6">
                            <img class="img-fluid text-opacity m-t-5" src="assets/images/logo/logo.png" alt="" width="100">
                        </div>
                        <div class="col-sm-6 text-right">
                            <small><span class="font-weight-semibold text-dark">Phone:</span> (123) 456-7890</small>
                            <br>
                            <small>support@themenate.com</small>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

@section('script')
<script>
    // var node = document.getElementById('my-node');
    // var btn = document.getElementById('result');
    // btn.onclick = function() {
    //   domtoimage.toBlob(document.getElementById('my-node'))
    //     .then(function(blob) {
    //       window.saveAs(blob, 'my-node.png');
    //     });
    // }

    function downloadimage() {
                /*var container = document.getElementById("image-wrap");*/ /*specific element on page*/
                var container = document.getElementById("htmltoimage");; /* full page */
                html2canvas(container, { allowTaint: true }).then(function (canvas) {

                    var link = document.createElement("a");
                    document.body.appendChild(link);
                    link.download = "html_image.jpg";
                    link.href = canvas.toDataURL();
                    link.target = '_blank';
                    link.click();
                });
            }
    </script>
@endsection