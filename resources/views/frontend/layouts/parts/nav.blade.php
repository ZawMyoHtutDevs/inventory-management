<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">
        <img src="{{asset('asset/logo-fold.png')}}" alt="" width="50" height="50">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item ml-3">
            <a class="nav-link active" aria-current="page" href="/">ပင်မစာမျက်နှာ</a>
          </li>
          <li class="nav-item ml-3">
            <a class="nav-link" href="{{route('frontend.pricing')}}">ဈေးနှုန်းများ</a>
          </li>
          <li class="nav-item ml-3">
            <a class="nav-link" href="{{route('frontend.about')}}">ကုမ္ပဏီအကြောင်း</a>
          </li>
          <li class="nav-item ml-3">
            <a class="nav-link" href="{{route('frontend.contact')}}">အကူအညီရယူရန်</a>
          </li>
          <li class="nav-item ml-3">
            <a class="nav-link" href="{{route('frontend.contact')}}">ဆက်သွယ်ရန်</a>
          </li>
         
        </ul>
      </div>
      <a class="btn btn-primary btn-tone float-end mr-2" href="{{route('login')}}">အကောင့်ဝင်ရန်</a>
      <a class="btn btn-primary float-end text-light" href="{{route('frontend.register')}}">အကောင့်ဖွင့်ရန်</a>
    </div>
  </nav>