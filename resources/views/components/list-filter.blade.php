<div class="bg-white rounded mt-5 mt-md-0 pb-1">
    <div class="border-km-left km-purple border-bottom border-secondary py-2">
        <span class="ms-3 km-fw-semiBold">List Genre</span>
    </div>
    @foreach ($genres->take(11) as $genre)
        <a href="{{route('list-manga', ['genre' => $genre->nama_genre])}}" class="fs-7 my-3 ps-1 text-primary text-decoration-none d-block km-ff-asap">
            <span class="ms-2 truncate-1">{{ $genre->nama_genre }}</span>                            
        </a>                        
    @endforeach   
    
    {{-- <a href="#" class="d-block py-3 mt-1 text-center text-secondary text-decoration-none km-fw-semiBold">
        Semua Genre&nbsp;
        <i class="fa-solid fa-right align-content-center"></i>
    </a> --}}                    
</div>

<div class="bg-white rounded mt-5 pb-1">
    <div class="border-km-left km-purple border-bottom border-secondary py-2">
        <span class="ms-3 km-fw-semiBold">List Mangaka</span>
    </div>
    @foreach ($mangakas->take(11) as $mangaka)
        <a href="{{route('list-manga', ['mangaka' => $mangaka->nama_mangaka])}}" class="fs-7 my-3 ps-1 text-primary text-decoration-none d-block km-ff-asap">
            <span class="ms-2 truncate-1">{{ $mangaka->nama_mangaka }}</span>                            
        </a>                        
    @endforeach   
    
    {{-- <a href="#" class="d-block py-3 mt-1 text-center text-secondary text-decoration-none km-fw-semiBold">
        Semua Mangaka&nbsp;
        <i class="fa-solid fa-right align-content-center"></i>
    </a>  --}}                   
</div>

<div class="bg-white rounded mt-5 pb-1">
    <div class="border-km-left km-purple border-bottom border-secondary py-2">
        <span class="ms-3 km-fw-semiBold">List Penerbit</span>
    </div>
    @foreach ($penerbits->take(11) as $penerbit)
        <a href="{{route('list-manga', ['penerbit' => $penerbit->nama_penerbit])}}" class="fs-7 my-3 ps-1 text-primary text-decoration-none d-block km-ff-asap">
            <span class="ms-2 truncate-1">{{ $penerbit->nama_penerbit }}</span>                            
        </a>                        
    @endforeach   
    
    {{-- <a href="#" class="d-block py-3 mt-1 text-center text-secondary text-decoration-none km-fw-semiBold">
        Semua Penerbit&nbsp;
        <i class="fa-solid fa-right align-content-center"></i>
    </a>  --}}                   
</div>