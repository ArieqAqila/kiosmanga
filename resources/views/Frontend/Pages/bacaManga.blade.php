<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Reading...</title>

    
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
    <!-- Slider main container -->
    <div class="container-fluid p-0">
        <div class="bg-primary km-ff-asap p-1 text-white ps-lg-5">
            <div class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand km-fw-bold text-center d-flex align-items-center" href="{{route('home')}}">
                    <div class="wrapper d-inline-block km-ff-asap km-logo">
                        <div>満<span class="text-warning mx-1">牙</span></div>
                        <div>気<span class="text-warning mx-1">尾</span>素</div>
                    </div>
                    <div class="ms-3 km-ff-comfortaa">KiosManga</div>   
                </a>
                <a href="{{route('profile-page')}}" class="me-2 km-cart text-center text-decoration-none">
                    <div class="km-mini-profile mx-auto">
                      @if (Auth::user()->foto_profile == null)
                      <span>
                        {!! strtoupper(substr(Auth::user()->username, 0, 2)) !!}
                      </span>
                      @else
                          <img src="{{asset('images/profile/'.Auth::user()->foto_profile)}}" alt="">
                      @endif                      
                    </div>
                </a>
            </div>
        </div>
        <div class="swiper swiper-panel" style="height: 100vh;">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div data-history="1" class="swiper-slide">
                    <div class="container-fluid p-0 text-center">
                        <img src="{{asset('images/isi_manga/Reincarnated As a Sword/page-1.jpg')}}" loading="lazy" alt="KiosManga" class="img-fluid manga-page">
                        <div class="swiper-lazy-preloader"></div>
                    </div>
                </div>
                <div data-history="2" class="swiper-slide">
                    <div class="container-fluid p-0 text-center">
                        <img src="{{asset('images/isi_manga/Reincarnated As a Sword/page-2.jpg')}}" loading="lazy" alt="KiosManga" class="img-fluid manga-page">
                        <div class="swiper-lazy-preloader"></div>
                    </div>
                </div>
                <div data-history="3" class="swiper-slide">
                    <div class="container-fluid p-0 text-center">
                        <img src="{{asset('images/isi_manga/Reincarnated As a Sword/page-3.jpg')}}" loading="lazy" alt="KiosManga" class="img-fluid manga-page">
                        <div class="swiper-lazy-preloader"></div>
                    </div>
                </div>
                <div data-history="4" class="swiper-slide">
                    <div class="container-fluid p-0 text-center">
                        <img src="{{asset('images/isi_manga/Reincarnated As a Sword/page-4.jpg')}}" loading="lazy" alt="KiosManga" class="img-fluid manga-page">
                        <div class="swiper-lazy-preloader"></div>
                    </div>
                </div>
                <div data-history="5" class="swiper-slide">
                    <div class="container- p-0 text-center">
                        <img src="{{asset('images/isi_manga/Reincarnated As a Sword/page-5.jpg')}}" loading="lazy" alt="KiosManga" class="img-fluid manga-page">
                        <div class="swiper-lazy-preloader"></div>
                    </div>
                </div>  
            </div>
        
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    {{-- Swiper JS --}}
    <script src="{{asset('Swiper/swiper-bundle.min.js')}}"></script>

    {{-- myJS --}}
    <script src="{{asset('src/js/Frontend/FE.min.js')}}"></script>
</body>
</html>