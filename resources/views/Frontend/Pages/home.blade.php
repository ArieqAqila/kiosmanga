@extends('FrontEnd.index')

@section('titleHalaman', 'Home - KiosManga')

@section('konten')
    <div class="container-fluid">
        <div class="swiper banner-swiper text-center">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('images/banner1.jpg') }}" alt="Slide Image 1">
                    </a>        
                </div>
                <div class="swiper-slide">
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('images/banner2.jpg') }}" alt="">
                    </a>                
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="container-xl mt-2 mt-md-4 mt-lg-5">
        <a href="#">
            <img src="{{ asset('images/banner3.jpg') }}" alt="Advertisement Segment" class="img-fluid">
        </a>        
    </div>

    <div class="container mt-2 mt-2 mt-md-4 mt-lg-5">
        <div class="row row-cols-1 row-cols-md-2 flex-column-reverse flex-md-row">
            <div class="col-lg-3 col-md-3">
                <x-list-filter />
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="bg-white border-km-top km-primary text-center px-4">
                    <h5 class="text-center py-4 mt-1">Manga Fantasy</h5>                    
                    <div class="swiper swiper-manga px-4 pb-4 km-ff-asap">
                        <div class="swiper-wrapper">
                        @foreach ($fantasyMangas->take(10) as $fantasyManga)
                        <div class="swiper-slide shadow rounded-1">
                            <a href="{{route('list-volume', $fantasyManga->slug_manga)}}" class="manga-info text-decoration-none">
                                <div class="thumbnail-container">
                                    <div class="spinner-border text-primary position-absolute loading">
                                      <span class="visually-hidden">Loading...</span>
                                    </div>
                                    
                                    <img src="{{asset('/images/visualArt')}}/{{$fantasyManga->judul_manga}}/{{$fantasyManga->volManga[0]->visual_art}}" alt="{{$fantasyManga->judul_manga}}" class="km-thumbnail card-img-top object-fit-contain" height="200" hidden>                                    
                                </div>
                                

                                <div class="d-flex ms-1 mt-2">
                                    <span class="fs-8 text-white px-1 rounded-1 bg-km-blue">
                                        {{$fantasyManga->mangaka->nama_mangaka}}
                                    </span>
                                </div>


                                <div class="px-2 pt-2">
                                    <h6 class="fs-7">{{ Str::limit($fantasyManga->judul_manga, 38, '...') }}</h6>
                                </div>

                            </a>
                            <div class="button-section mt-3">                    
                                <div class="range-price me-2 km-fw-medium">
                                    Rp.{{$fantasyManga->volManga->max('harga')/1000 . "K"}}&nbsp;
                                    〜&nbsp;
                                    Rp.{{$fantasyManga->volManga->min('harga')/1000 . "K"}}
                                </div>
                                <div class="total-volume me-2 mt-1">
                                    {{$fantasyManga->volManga->count()}} Volumes
                                </div>
                            </div>                                                    
                        </div>
                        @endforeach
                        </div>
                        <div class="swiper-scrollbar"></div>                       
                    </div>
                    <a href="{{route('list-manga', ['genre' => 'Fantasy'])}}" class="btn btn-km-primary my-4 fs-5">
                        Lihat Selengkapnya&nbsp;
                        <i class="fa-solid fa-right align-content-center"></i>
                    </a>
                </div>


                <div class="bg-white border-km-top km-secondary text-center px-4 mt-2 mt-md-4 mt-lg-5">
                    <h5 class="text-center py-4 mt-1">Manga Mystery</h5>                    
                    <div class="swiper swiper-manga px-4 pb-4 km-ff-asap">
                        <div class="swiper-wrapper">
                        @foreach ($mysteryMangas->take(10) as $mysteryManga)
                        <div class="swiper-slide shadow rounded-1">
                            <a href="{{route('list-volume', $mysteryManga->slug_manga)}}" class="manga-info text-decoration-none">

                                <div class="thumbnail-container">
                                    <div class="spinner-border text-primary position-absolute loading">
                                      <span class="visually-hidden">Loading...</span>
                                    </div>
                                    
                                    <img src="{{asset('/images/visualArt')}}/{{$mysteryManga->judul_manga}}/{{$mysteryManga->volManga[0]->visual_art}}" alt="{{$mysteryManga->judul_manga}}" class="km-thumbnail card-img-top object-fit-contain" height="200" hidden>                                    
                                </div>
                                

                                <div class="d-flex ms-1 mt-2">
                                    <span class="fs-8 text-white px-1 rounded-1 bg-km-blue">
                                        {{$mysteryManga->mangaka->nama_mangaka}}
                                    </span>
                                </div>


                                <div class="px-2 pt-2">
                                    <h6 class="fs-7">{{ Str::limit($mysteryManga->judul_manga, 38, '...') }}</h6>
                                </div>

                            </a>
                            <div class="button-section">                    
                                <div class="range-price me-2 km-fw-medium">
                                    Rp.{{$mysteryManga->volManga->max('harga')/1000 . "K"}}&nbsp;
                                    〜&nbsp;
                                    Rp.{{$mysteryManga->volManga->min('harga')/1000 . "K"}}
                                </div>
                                <div class="total-volume me-2 mt-1">
                                    {{$mysteryManga->volManga->count()}} Volumes
                                </div>
                            </div>                                                    
                        </div>
                        @endforeach
                        </div>
                        <div class="swiper-scrollbar"></div>                       
                    </div>
                    <a href="{{route('list-manga', ['genre' => 'Mystery'])}}" class="btn btn-km-primary my-4 fs-5">
                        Lihat Selengkapnya&nbsp;
                        <i class="fa-solid fa-right align-content-center"></i>
                    </a>
                </div> 

                
                <div class="bg-white border-km-top km-pink text-center px-4 mt-2 mt-md-4 mt-lg-5">
                    <h5 class="text-center py-4 mt-1">Manga Romance</h5>                    
                    <div class="swiper swiper-manga px-4 pb-4 km-ff-asap">
                        <div class="swiper-wrapper">
                        @foreach ($romanceMangas->take(10) as $romanceManga)
                        <div class="swiper-slide shadow rounded-1">
                            <a href="{{route('list-volume', $romanceManga->slug_manga)}}" class="manga-info text-decoration-none">

                                <div class="thumbnail-container">
                                    <div class="spinner-border text-primary position-absolute loading">
                                      <span class="visually-hidden">Loading...</span>
                                    </div>
                                    
                                    <img src="{{asset('/images/visualArt')}}/{{$romanceManga->judul_manga}}/{{$romanceManga->volManga[0]->visual_art}}" alt="{{$romanceManga->judul_manga}}" class="km-thumbnail card-img-top object-fit-contain" height="200" hidden>                                    
                                </div> 
                                
                                
                                <div class="d-flex ms-1 mt-2">
                                    <span class="fs-8 text-white px-1 rounded-1 bg-km-blue">
                                        {{$romanceManga->mangaka->nama_mangaka}}
                                    </span>
                                </div>


                                <div class="px-2 pt-2">
                                    <h6 class="fs-7">{{ Str::limit($romanceManga->judul_manga, 38, '...') }}</h6>
                                </div>

                            </a>
                            <div class="button-section mt-3">                    
                                <div class="range-price me-2 km-fw-medium">
                                    Rp.{{$romanceManga->volManga->max('harga')/1000 . "K"}}&nbsp;
                                    〜&nbsp;
                                    Rp.{{$romanceManga->volManga->min('harga')/1000 . "K"}}
                                </div>
                                <div class="total-volume me-2 mt-1">
                                    {{$romanceManga->volManga->count()}} Volumes
                                </div>
                            </div>                                                    
                        </div>
                        @endforeach
                        </div>
                        <div class="swiper-scrollbar"></div>                       
                    </div>
                    <a href="{{route('list-manga', ['genre' => 'Romance'])}}" class="btn btn-km-primary my-4 fs-5">
                        Lihat Selengkapnya&nbsp;
                        <i class="fa-solid fa-right align-content-center"></i>
                    </a>
                </div>


                <div class="bg-white border-km-top km-orange text-center px-4 mt-2 mt-md-4 mt-lg-5">
                    <h5 class="text-center py-4 mt-1">Manga Comedy</h5>                    
                    <div class="swiper swiper-manga px-4 pb-4 km-ff-asap">
                        <div class="swiper-wrapper">
                        @foreach ($comedyMangas->take(10) as $comedyManga)
                        <div class="swiper-slide shadow rounded-1">
                            <a href="{{route('list-volume', $comedyManga->slug_manga)}}" class="manga-info text-decoration-none">

                                <div class="thumbnail-container">
                                    <div class="spinner-border text-primary position-absolute loading">
                                      <span class="visually-hidden">Loading...</span>
                                    </div>
                                    
                                    <img src="{{asset('/images/visualArt')}}/{{$comedyManga->judul_manga}}/{{$comedyManga->volManga[0]->visual_art}}" alt="{{$comedyManga->judul_manga}}" class="km-thumbnail card-img-top object-fit-contain" height="200" hidden>                                    
                                </div>


                                <div class="d-flex ms-1 mt-2">
                                    <span class="fs-8 text-white px-1 rounded-1 bg-km-blue">
                                        {{$comedyManga->mangaka->nama_mangaka}}
                                    </span>
                                </div>


                                <div class="px-2 pt-2">
                                    <h6 class="fs-7">{{ Str::limit($comedyManga->judul_manga, 38, '...') }}</h6>
                                </div>
                                
                            </a>
                            <div class="button-section mt-3">                    
                                <div class="range-price me-2 km-fw-medium">
                                    Rp.{{$comedyManga->volManga->max('harga')/1000 . "K"}}&nbsp;
                                    〜&nbsp;
                                    Rp.{{$comedyManga->volManga->min('harga')/1000 . "K"}}
                                </div>
                                <div class="total-volume me-2 mt-1">
                                    {{$comedyManga->volManga->count()}} Volumes
                                </div>
                            </div>                                                    
                        </div>
                        @endforeach
                        </div>
                        <div class="swiper-scrollbar"></div>                       
                    </div>
                    <a href="{{route('list-manga', ['genre' => 'Comedy'])}}" class="btn btn-km-primary my-4 fs-5">
                        Lihat Selengkapnya&nbsp;
                        <i class="fa-solid fa-right align-content-center"></i>
                    </a>
                </div>              
            </div>
        </div>
    </div>
@endsection