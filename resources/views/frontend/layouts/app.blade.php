<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>41 Inventory - {{ $page_action ?? '' }}</title>

    <link rel="shortcut icon" href="{{ asset('backend/images/logo/favicon.png') }}" type="image/x-icon" />

    <!-- Scripts -->
    
    @yield('style')
    <!-- Styles -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">

    {{-- css font --}}

    <style>
        @font-face {
      font-family: 'MyanmarSabae';
      src: url('{{ asset('asset/fonts/MyanmarSabae.ttf') }}');
        }
        
    </style>
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">

</head>
<body>
    <div class="app">
        <div class="layout">

            <!-- Side Nav START -->
            @include('frontend.layouts.parts.nav')
            <!-- Side Nav END -->


            <!-- Header START -->
            @include('frontend.layouts.parts.header')
            <!-- Header END -->
            
            <!-- Page Container START -->
            <div class="page-container" style="padding: 0">
                
                
                <!-- Content  -->
                <div class="main-content" style="padding-top: 20px">
                    @yield('breadcrumb')
                    
                    @yield('content')
                    <!-- Content  -->
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                @include('frontend.layouts.parts.footer')
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

            
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>

    

    <!-- Core JS -->
    <script src="{{ asset('backend/js/app.min.js') }}"></script>

    <!-- page js -->
    @yield('script')

</body>
</html>
