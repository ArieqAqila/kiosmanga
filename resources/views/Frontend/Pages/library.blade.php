@extends('Frontend.index')
@section('titleHalaman', 'List Manga - KiosManga')

@section('konten')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb km-ff-asap">
      <li class="breadcrumb-item ms-3"><a href="{{route('home')}}" class="text-km-lightblue">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Manga</li>
    </ol>
</nav>
<div class="container-fluid km-ff-asap">
  <div class="row row-cols-1 row-cols-md-2 flex-column-reverse flex-md-row">
      <div class="col-md-3 col-lg-2">
        <x-list-filter />
      </div>
      <div class="col-md-9 col-lg-10">
        <div class="bg-white">
            <div class="border-km-left km-info border-bottom border-info py-3 px-4">
                <h5 class="text-info mb-0">{{strtoupper(Auth::user()->username)}}'s Library</h5>
            </div>  
            @if ($myMangaList->isEmpty())
                <p class="px-3 pt-3 km-fw-medium">Tidak ada Item apapun di Library anda.</p>
            @else
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 px-lg-5 pb-3 justify-content-center">
                    @foreach ($myMangaList as $myManga)
                    <div class="col p-0 mx-2 mx-lg-3 mt-4 mt-md-5 km-card shadow">
                        <a href="{{route('read-manga', ['slugVol' => $myManga->volManga->slug_vol, 'page' => 1])}}" class="manga-info text-decoration-none">
                            <div class="thumbnail-container">
                                <div class="spinner-border text-primary position-absolute loading">
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                                
                                <img src="{{ asset('/images/visualArt/'.$myManga->volManga->manga->judul_manga.'/'.$myManga->volManga->visual_art) }}" alt="{{$myManga->volManga->manga->judul_manga}}" class="km-thumbnail card-img-top object-fit-contain" height="200" hidden>
                            </div>                                                                      
                            <div class="d-flex ms-1 mt-2">
                                <span class="fs-8 text-white px-1 rounded-1 bg-km-blue truncate-1">
                                    {{$myManga->volManga->manga->mangaka->nama_mangaka}}
                                </span>
                            </div>
                            <div class="px-2 pt-2">
                                <h6 class="fs-7 judul-manga">{{$myManga->volManga->manga->judul_manga}} - Vol {{$myManga->volManga->vol_ke}}</h6>
                            </div> 
                        </a>
                        <div class="button-section mt-2">                                            
                            <a href="{{route('read-manga', ['slugVol' => $myManga->volManga->slug_vol, 'page' => 1])}}" class="btn btn-km-pink rounded-0 fs-7 mx-auto text-white py-2 text-decoration-none lh-1 d-block">
                                <i class="fa-solid fa-eye mb-1"></i><br>
                                Baca
                            </a>                                                                      
                        </div>                                                      
                    </div>
                    @endforeach                             
                </div>                
            @endif
            <div class="mt-5 ms-2 ms-md-5 pb-2">
                {{ $myMangaList->links('vendor.pagination.default') }}
            </div>                     
        </div>        
      </div>
  </div>
</div>
@endsection