@extends('FrontEnd.index')

@section('titleHalaman', 'KiosManga')

@section('konten')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb km-ff-asap">
      <li class="breadcrumb-item ms-3"><a href="{{route('home')}}" class="text-km-lightblue">Home</a></li>
      <li class="breadcrumb-item"><a href="{{route('list-manga')}}" class="text-km-lightblue">Manga</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$volume->manga->judul_manga}}, Vol {{$volume->vol_ke}}</li>
    </ol>
</nav>
<div class="container">
    <div class="title-section km-ff-asap">
        <span class="px-4 py-1 fs-7 text-white bg-km-secondary km-fw-medium rounded-5">{{$volume->manga->penerbit->nama_penerbit}}</span>
        <div class="fs-5 mt-1 ms-1 km-fw-medium">{{$volume->manga->judul_manga}}, Vol {{$volume->vol_ke}}</div>
        <span class="text-km-primary ms-1">{{$volume->manga->mangaka->nama_mangaka}}</span>
    </div>

    <div class="row row-cols-1 row-cols-lg-2 justify-content-center">
        <div class="col col-lg-9">
            <div class="row row-cols-1 row-cols-lg-2 bg-white rounded-2 p-4 mt-3">
                <div class="col-lg-4">
                    <img src="{{ asset('/images/visualArt/'.$volume->manga->judul_manga.'/'.$volume->visual_art) }}" alt="{{$volume->manga->judul_manga}}" class="img-fluid km-img">
                </div>
                <div class="col-lg-8 km-ff-asap mt-4 mt-lg-0">
                    <div class="border-km-left km-primary border-bottom border-km-primary ps-2 km-fw-medium text-km-primary fs-5 py-2">Tentang Manga Ini</div>
                    <div class="vol-desc mt-2">
                        {{$volume->deskripsi}}
                    </div>
                </div>                
            </div>


            <div class="row row-cols-1 mt-3">                
                <div class="col bg-white rounded-2 km-ff-asap mt-lg-0 p-0">
                    <div class="border-km-left km-primary border-bottom border-km-primary ps-4 py-2 km-fw-medium text-km-primary fs-5">Detail Manga</div>
                    <dl class="row gy-3 mx-4 mt-2">
                        <dt class="col-md-3">Judul Manga</dt>
                        <dd class="col-md-9"><a href="{{route('list-volume', $volume->manga->slug_manga)}}">{{$volume->manga->judul_manga}}</a></dd>

                        <dt class="col-md-3">Judul Manga(Japanese)</dt>
                        <dd class="col-md-9 text-primary">{{$volume->manga->judul_jepang}}</dd>

                        <dt class="col-md-3">Mangaka</dt>
                        <dd class="col-md-9"><a href="{{route('list-manga', ['mangaka' => $volume->manga->mangaka->nama_mangaka])}}">{{$volume->manga->mangaka->nama_mangaka}}</a></dd>

                        <dt class="col-md-3">Penerbit</dt>
                        <dd class="col-md-9"><a href="{{route('list-manga', ['penerbit' => $volume->manga->penerbit->nama_penerbit])}}">{{$volume->manga->penerbit->nama_penerbit}}</a></dd>

                        <dt class="col-md-3">Genre</dt>
                        <dd class="col-md-9">
                            @foreach($volume->manga->genreManga as $genreManga)
                                <a href="{{route('list-manga', ['genre' => $genreManga->genre->nama_genre])}}">{{ $genreManga->genre->nama_genre }}</a> &nbsp;
                            @endforeach
                        </dd>

                        <dt class="col-md-3">Jumlah Halaman</dt>
                        <dd class="col-md-9">{{$volume->jml_hal}} Halaman</dd>
                    </dl>
                </div>                
            </div>

            <div class="row row-cols-1">
                <div class="col bg-km-lightgreen rounded-2 p-4 mt-3 km-ff-asap">
                    <h5 class="mb-3">Rekomendasi Manga</h5>
                    <div class="swiper swiper-manga px-4 pb-4 km-ff-asap">
                        <div class="swiper-wrapper">
                        @foreach ($recommendationManga->take(7) as $recommendation)
                        <div class="swiper-slide bg-white shadow rounded-1">
                            <a href="{{route('list-volume', $recommendation->slug_manga)}}" class="manga-info text-decoration-none">                                
                                @if(isset($recommendation->volManga[0]) && file_exists(public_path('/images/visualArt/'.$recommendation->judul_manga.'/'.$recommendation->volManga[0]->visual_art)))
                                <img src="{{asset('/images/visualArt')}}/{{$recommendation->judul_manga}}/{{$recommendation->volManga[0]->visual_art}}" alt="{{$recommendation->judul_manga}}" class="card-img-top object-fit-contain" height="200">
                                @else
                                <img src="" alt="{{$recommendation->judul_manga}}" class="card-img-top object-fit-contain" height="200">
                                @endif
                                <div class="d-flex ms-1 mt-2">
                                    <span class="fs-8 text-white px-1 rounded-1 bg-km-blue">
                                        {{$recommendation->mangaka->nama_mangaka}}
                                    </span>
                                </div>
                                <div class="px-2 pt-2">
                                    <h6 class="fs-7">{{ Str::limit($recommendation->judul_manga, 38, '...') }}</h6>
                                </div>
                            </a>
                            <div class="button-section mt-3">                    
                                <div class="range-price me-2 km-fw-medium">
                                    Rp.{{$recommendation->volManga->max('harga')/1000 . "K"}}&nbsp;
                                    〜&nbsp;
                                    Rp.{{$recommendation->volManga->min('harga')/1000 . "K"}}
                                </div>
                                <div class="total-volume me-2 mt-1">
                                    {{$recommendation->volManga->count()}} Volumes
                                </div>
                            </div>                                                    
                        </div>
                        @endforeach
                        </div>
                        <div class="swiper-scrollbar"></div>                       
                    </div>
                </div>
            </div>
        </div>

        @guest
        <div class="col col-lg-3 km-ff-asap">
            <div class="row row-cols-1 sticky-top mx-auto">
                <div class="col bg-white rounded-2 border border-3 border-km-secondary mt-5">
                    <div class="text-center fs-5 pt-1">Rp<span class="text-danger">{{number_format($volume->harga, 0, '.', ',')}}</span></div>
                    <div class="fs-7">
                        <div class="text-warning my-2">
                            *Item ini adalah <span class="fst-italic">eBook</span>
                            (Buku Digital). <br>&nbsp;Bukan buku cetak.
                        </div>
                        <div class="text-warning">
                            *Item ini berbahasa Indonesia/Inggris.
                        </div>
                    </div>
                    <div class="button-section mt-3 pb-2">
                        <a href="{{route('beli-sekarang', $volume->id_vol)}}" class="btn btn-secondary d-block km-fw-semiBold">Beli Sekarang</a>
                        <a href="{{route('add-item', $volume->slug_vol)}}" class="btn btn-km-primary d-block km-fw-semiBold mt-2">
                            <i class="fa-regular fa-cart-shopping mx-2"></i>Masukkan ke Keranjang
                        </a>
                    </div>                    
                </div>                               
            </div>            
        </div>
        @endguest

        @auth
            @php
                $mangaInCart = App\Models\Keranjang::where('id_vol', $volume->id_vol)->where('id_user', Auth::user()->id_user)->where('status', 'NOT PURCHASED')->exists();
                $mangaOnHold = App\Models\Keranjang::where('id_vol', $volume->id_vol)->where('id_user', Auth::user()->id_user)->where('status', 'ON HOLD')->exists();
                $mangaInLibrary = App\Models\Pembelian::where('id_vol', $volume->id_vol)->where('id_user', Auth::user()->id_user)->exists();
            @endphp


            @if ($mangaInCart)
            <div class="col col-lg-3 km-ff-asap">
                <div class="row row-cols-1 sticky-top mx-auto">
                    <div class="col bg-info mt-5 text-center p-4 fs-5">
                        <a href="{{ route('list-keranjang') }}" class="text-white"><i class="fa-solid fa-cart-circle-check mb-1"></i> Ada di Keranjang</a>
                    </div>                               
                </div>            
            </div>


            @elseif ($mangaOnHold)
            <div class="col col-lg-3 km-ff-asap">
                <div class="row row-cols-1 sticky-top mx-auto">
                    <div class="col bg-warning disabled mt-5 text-center p-4 fs-5">
                        <a href="" class="text-white disabled"><i class="fa-solid fa-spinner km-spin"></i> Menunggu Pembayaran</a>
                    </div>                               
                </div>            
            </div>


            @elseif ($mangaInLibrary)
            <div class="col col-lg-3 km-ff-asap">
                <div class="row row-cols-1 sticky-top mx-auto">
                    <div class="col bg-primary disabled mt-5 text-center p-4 fs-5">
                        <a href="{{ route('library') }}" class="text-white"><i class="fa-solid fa-book-open-cover mb-1"></i> Ada di Library</a>
                    </div>                               
                </div>            
            </div>


            @else
            <div class="col col-lg-3 km-ff-asap">
                <div class="row row-cols-1 sticky-top mx-auto">
                    <div class="col bg-white rounded-2 border border-3 border-km-secondary mt-5">
                        <div class="text-center fs-5 pt-1">Rp<span class="text-danger">{{number_format($volume->harga, 0, '.', ',')}}</span></div>
                        <div class="fs-7">
                            <div class="text-warning my-2">
                                *Item ini adalah <span class="fst-italic">eBook</span>
                                (Buku Digital). <br>&nbsp;Bukan buku cetak.
                            </div>
                            <div class="text-warning">
                                *Item ini berbahasa Indonesia/Inggris.
                            </div>
                        </div>
                        <div class="button-section mt-3 pb-2">
                            <a href="{{route('beli-sekarang', $volume->id_vol)}}" class="btn btn-secondary d-block km-fw-semiBold">Beli Sekarang</a>
                            <a href="{{route('add-item', $volume->slug_vol)}}" class="btn btn-km-primary d-block km-fw-semiBold mt-2">
                                <i class="fa-regular fa-cart-shopping mx-2"></i>Masukkan ke Keranjang
                            </a>
                        </div>                    
                    </div>                               
                </div>            
            </div>
            @endif
        @endauth
        
    </div>    
</div>
@endsection