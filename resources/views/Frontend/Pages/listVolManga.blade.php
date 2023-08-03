@extends('Frontend.index')
@section('titleHalaman', 'KiosManga')

@section('konten')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb km-ff-asap">
      <li class="breadcrumb-item ms-3"><a href="{{route('home')}}" class="text-km-lightblue">Home</a></li>
      <li class="breadcrumb-item"><a href="{{route('list-manga')}}" class="text-km-lightblue">Manga</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$manga->judul_manga}}</li>
    </ol>
</nav>
<div class="container-fluid km-ff-asap">
  <div class="row row-cols-1 row-cols-md-2 flex-column-reverse flex-md-row">
      <div class="col-md-3 col-lg-2">
        <x-list-filter />
      </div>
      <div class="col-md-9 col-lg-10">
        <div class="bg-white">
            <div class="border-km-left km-primary border-bottom border-km-primary py-3 px-4">
                <h5 class="text-km-primary mb-0">{{$manga->judul_manga}}</h5>
            </div>  
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 px-lg-5 pb-3 justify-content-center">
                @foreach ($volMangas as $volume)
                <div class="col p-0 mx-2 mx-lg-3 mt-4 mt-md-5 km-card shadow">
                    <a href="{{route('detail-manga', $volume->slug_vol)}}" class="manga-info text-decoration-none position-relative">                      
                      
                      <div class="thumbnail-container">
                        <div class="spinner-border text-primary position-absolute loading">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        
                        <img src="{{ asset('/images/visualArt/'.$manga->judul_manga.'/'.$volume->visual_art) }}" alt="{{$manga->judul_manga}}" class="km-thumbnail card-img-top object-fit-contain" height="200" hidden>
                      </div>


                        <div class="d-flex ms-1 mt-2">
                            <span class="fs-8 text-white px-1 rounded-1 bg-km-blue truncate-1">
                                {{$manga->mangaka->nama_mangaka}}
                            </span>
                        </div>

                        
                        <div class="px-2 pt-2">
                            <h6 class="fs-7 judul-manga">{{$manga->judul_manga}} - Vol {{$volume->vol_ke}}</h6>
                        </div>

                    </a>
                    <div class="button-section">                    
                        <div class="range-price me-2 km-fw-medium mb-1 fs-7">
                            Rp{{number_format($volume->harga, 0, '.', ',')}}                            
                        </div>
                        @auth
                          @php
                            $mangaExistsInCart = App\Models\Keranjang::where('id_vol', $volume->id_vol)->where('id_user', Auth::user()->id_user)->where('status', 'NOT PURCHASED')->exists();
                            $mangaOnHold = App\Models\Keranjang::where('id_vol', $volume->id_vol)->where('id_user', Auth::user()->id_user)->where('status', 'ON HOLD')->exists();
                            $purchasedManga = App\Models\Pembelian::where('id_vol', $volume->id_vol)->where('id_user', Auth::user()->id_user)->exists();
                          @endphp
                          
                          @if ($mangaExistsInCart)
                            <a href="{{route('list-keranjang')}}" class="btn btn-info rounded-0 fs-7 mx-auto text-white py-2 text-decoration-none lh-1 d-block">
                              <i class="fa-solid fa-cart-circle-check mb-1"></i><br>
                              Ada di Cart
                            </a>
                          @elseif ($purchasedManga)
                            <a href="#" class="btn btn-primary rounded-0 fs-7 mx-auto text-white py-2 text-decoration-none lh-1 d-block">
                              <i class="fa-solid fa-book-open-cover mb-1"></i><br>
                              Ada di Library
                            </a>
                          @elseif ($mangaOnHold)
                          <a href="#" class="btn btn-warning disabled rounded-0 fs-7 mx-auto text-white py-2 text-decoration-none lh-1 d-block">
                            <i class="fa-solid fa-spinner km-spin"></i><br>
                            Menunggu Pembayaran
                          </a>
                          @else
                            <a href="{{route('add-item', $volume->slug_vol)}}" class="btn btn-secondary rounded-0 fs-7 mx-auto text-white py-2 text-decoration-none lh-1 d-block">
                              <i class="fa-solid fa-cart-shopping mb-1"></i><br>
                              Cart
                            </a>
                          @endif
                        @endauth 
                        
                        @guest
                          <a href="javascript:void(0)" class="btn btn-secondary rounded-0 fs-7 mx-auto text-white py-2 text-decoration-none lh-1 d-block">
                            <i class="fa-solid fa-cart-shopping mb-1"></i><br>
                            Cart
                          </a>
                        @endguest                                               
                    </div>                                                      
                </div>
                @endforeach                                
            </div>
            <div class="mt-5 ms-2 ms-md-5 pb-2">
              {{ $volMangas->links('vendor.pagination.default') }}
            </div>                     
        </div>        
      </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
  document.title = "{{$manga->judul_manga}} - KiosManga";
});
</script>
@endsection