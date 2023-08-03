<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('titleHalaman')</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Comfortaa:wght@300;400;500;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">


    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{asset('FontAwesome/css/all.css')}}">

    {{-- MyCss --}}
    <link rel="stylesheet" href="{{asset('src/css/style.css')}}">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="bg-km-primary justify-content-end py-1 d-none d-md-flex">
        <div>&nbsp;</div>
        <div>&nbsp;</div>
    </div>
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
          <a class="navbar-brand text-center d-flex align-items-center" href="{{route('home')}}">
            <div class="wrapper d-inline-block km-ff-asap km-logo">
                <div>満<span class="text-km-blue">牙</span></div>
                <div>気<span class="text-km-blue">尾</span>素</div>
            </div>
            <div class="ms-3 km-ff-comfortaa">KiosManga</div>   
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 km-ff-asap">
              <li class="nav-item ms-lg-5 me-lg-4">
                <a class="nav-link km-fw-medium mt-2 mt-lg-0 active" aria-current="page" href="{{route('list-manga')}}">
                  <i class="fa-solid fa-book d-inline d-lg-none"></i>
                  Manga
                </a>
              </li>
              {{-- <li class="nav-item ps-lg-3 km-search-bar">
                <div class="input-group">
                    <span class="input-group-text bg-white border-km-blue" id="basic-addon1">
                        <i class="fa-solid fa-magnifying-glass text-km-blue"></i>
                    </span>
                    <input class="form-control border-km-blue" type="search" placeholder="Search" aria-label="Search">
                </div>              
              </li> --}}
            </ul>
            <div class="d-flex">
              @guest
                <a href="{{route('login-page')}}" class="btn btn-km-blue px-3">Masuk</a>
                <a href="{{route('register-page')}}" class="btn btn-outline-km-blue me-5 ms-3 px-3">Daftar</a>
                <span class="me-4 pe-1">&nbsp;</span>
              @endguest              


              @auth
                @if (Auth::user()->isAdmin)
                    <a href="{{ route('all-manga') }}" class="km-ff-comfortaa km-fw-semiBold me-3 btn btn-warning">Anda seorang ADMIN. Aksi anda DIBATASI!</a>
                @else
                  <div class="row gx-4 me-5 mt-3 mt-md-0">
                    <a href="{{route('list-keranjang')}}" class="col km-cart text-center text-decoration-none">
                      <div class="km-mini-profile mx-auto">
                                              
                        <i class="fa-solid fa-cart-shopping"></i>
                        <br>     
                      </div>
                      <span class="km-ff-asap">Cart</span>
                    </a>

                    <a href="{{route('library')}}" class="col km-cart text-center text-decoration-none">
                      <div class="km-mini-profile mx-auto">
                        <i class="fa-solid fa-books"></i><br>                                      
                      </div>
                      <span class="km-ff-asap">Library</span>
                    </a>
                    
                    <a href="{{route('profile-page')}}" class="col km-cart text-center text-decoration-none">
                      <div class="km-mini-profile mx-auto">
                        @if (Auth::user()->foto_profile == null)
                        <span>
                          {!! strtoupper(substr(Auth::user()->username, 0, 2)) !!}
                        </span>
                        @else
                            <img src="{{asset('images/profile/'.Auth::user()->foto_profile)}}" alt="">
                        @endif                      
                      </div>
                      <span class="km-ff-asap">Profile</span>
                    </a>

                    <a href="{{route('logout')}}" class="col km-cart text-center text-decoration-none">
                      <div class="km-mini-profile mx-auto">
                        <i class="fa-solid fa-arrow-up-left-from-circle"></i>                      
                      </div>
                      <span class="km-ff-asap">Logout</span>
                    </a>
                  </div>                
                  {{-- <a href="{{route('logout')}}" class="btn btn-km-blue px-3">Logout</a> --}}        
                  
                  <span class="me-4 pe-1">&nbsp;</span>  
                @endif    
              @endauth
          </div>
        </div>
    </nav>

    @yield('konten')

    <span class="d-block mt-5"></span>
    <div class="container-fluid bg-primary text-white text-center py-4 km-footer">
      <span>KiosManga is a property of Arieq Aqila. ©2023 All Rights Reserved.</span>
    </div>
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    {{-- Swiper JS --}}
    <script src="{{asset('Swiper/swiper-bundle.min.js')}}"></script>

    {{-- Sweetalert JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- myJS --}}
    <script src="{{asset('src/js/Frontend/FE.min.js')}}"></script>
</body>
</html>