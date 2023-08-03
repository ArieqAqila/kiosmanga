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
            <div class="border-km-left km-primary border-bottom border-km-primary py-3 px-4">
                <h5 class="text-km-primary mb-0">List Manga {{ request()->query('genre') }} {{ request()->query('penerbit') }} {{ request()->query('mangaka') }}</h5>
            </div>  
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 px-lg-5 pb-3 justify-content-center">
                @foreach ($mangas as $manga)
                <div class="col p-0 mx-2 mx-lg-3 mt-4 mt-md-5 km-card shadow">
                    <a href="{{route('list-volume', $manga->slug_manga)}}" class="manga-info text-decoration-none">
                        @if(isset($manga->volManga[0]) && file_exists(public_path('/images/visualArt/'.$manga->judul_manga.'/'.$manga->volManga[0]->visual_art)))
                        <img src="{{ asset('/images/visualArt/'.$manga->judul_manga.'/'.$manga->volManga[0]->visual_art) }}" alt="{{$manga->judul_manga}}" class="card-img-top object-fit-contain" height="200">
                        @else
                        <img src="" alt="{{$manga->judul_manga}}" class="card-img-top object-fit-contain" height="200">
                        @endif
                                            
                        <div class="d-flex ms-1 mt-2">
                            <span class="fs-8 text-white px-1 rounded-1 bg-km-blue truncate-1">
                                {{$manga->mangaka->nama_mangaka}}
                            </span>
                        </div>
                        <div class="px-2 pt-2">
                            <h6 class="fs-7 judul-manga">{{$manga->judul_manga}}</h6>
                        </div> 
                    </a>
                    <div class="button-section d-flex flex-column justify-content-end">                    
                        <div class="range-price me-2 km-fw-medium">
                            Rp.{{$manga->volManga->min('harga')/1000 . "K"}}&nbsp;
                            〜&nbsp;
                            Rp.{{$manga->volManga->max('harga')/1000 . "K"}}
                        </div>
                        <div class="total-volume me-2 mt-1">
                            {{$manga->volManga->count()}} Volumes
                        </div>
                    </div>                                                      
                </div>
                @endforeach                                
            </div>
            <div class="mt-5 ms-2 ms-md-5 pb-2">
                {{ $mangas->links('vendor.pagination.default') }}
            </div>                     
        </div>        
      </div>
  </div>
</div>
{{-- {{ $mangas->links('vendor.pagination.default') }} --}}
@endsection