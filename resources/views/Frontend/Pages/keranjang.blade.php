@extends('Frontend.index')

@section('titleHalaman', 'Keranjang - Kiosmanga')

@section('konten')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb km-ff-asap">
      <li class="breadcrumb-item ms-3"><a href="{{route('home')}}" class="text-km-lightblue">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Cart</li>
    </ol>
</nav>

<div class="container km-ff-asap">
    <div class="row row-cols-1 row-cols-lg-2 justify-content-center">
        <div class="col col-lg-7">
            <div class="bg-white">
                <div class="border-km-left km-info border-top border-bottom border-end border-info">
                    <div class="d-flex justify-content-between align-items-center fs-5 mx-3">
                        <span class="text-info d-block">Cart</span>
                        <div class="form-check form-check-inline fs-7">
                            <label class="form-check-label" for="pilih-semua">Pilih Semua</label>
                            <input class="form-check-input" type="checkbox" id="pilih-semua">                            
                        </div>
                    </div>
                </div>
                <form action="{{route('hapus-item')}}" method="POST">
                    @csrf                    
                    @method('DELETE')

                    @if ($cartList->isEmpty())
                        <p class="p-3 km-fw-medium">Tidak ada Item apapun di Keranjang.</p>
                    @else
                        @foreach ($cartList as $item)
                        <div class="d-flex justify-content-between border border-top-0 border-bottom-0 border-info km-cart-items">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex p-3 pe-0">
                                    <img src="{{ asset('/images/visualArt/'.$item->volManga->manga->judul_manga.'/'.$item->volManga->visual_art) }}" alt="gambar" height="150" class="border border-2 border-km-gray-50">
                                    <div class="fs-6 mt-1 ms-2">
                                        <div class="km-fw-semiBold">
                                            <span class="km-fw-medium bg-warning rounded-3 px-1 px-md-2 text-white fs-8">{{'Vol ' . $item->volManga->vol_ke}}</span>
                                            <span class="truncate-1">{{$item->volManga->manga->judul_manga}}</span>                                                                        
                                        </div>
                                        <span class="d-block text-km-gray-100">{{$item->volManga->manga->penerbit->nama_penerbit}}</span>
                                    </div>
                                </div>                                            
                            </div>
                            <div class="d-flex fs-7">
                                <span class="d-flex flex-column justify-content-end">
                                    <label class="d-block me-2 mb-1">Rp<span class="text-danger">{{number_format($item->harga, 0, '.', ',')}}</span></label>
                                </span>
                                <label class="d-flex align-items-center bg-info p-4 py-5 fs-4" for="{{'checkboxNoLabel' . $loop->iteration}}">
                                    <input class="form-check-input checkbox-item" type="checkbox" name="keranjangIds[]" id="{{'checkboxNoLabel' . $loop->iteration}}" value="{{$item->id_keranjang}}" aria-label="...">                      
                                </label>
                            </div>                    
                        </div>
                        @endforeach
                        <button class="btn btn-danger float-end mt-2 rounded-1" id="dltBtnItms" disabled><i class="fa-solid fa-x me-1"></i> Hapus</button>
                    @endif        
                </form>                                                        
            </div>            
        </div>
        <div class="col col-lg-4 mt-3 mt-lg-0">
            @if ($cartList->isEmpty())
                &nbsp;
            @else
            <div class="border border-2 border-secondary rounded-3 p-4 km-total-cart">
                <div class="border-km-left km-purple d-flex justify-content-between align-items-center ps-3">
                    <div class="fs-4 km-fw-semiBold">Total Harga</div>
                    <div class="">
                        <span class="d-block fs-5">(IDR) Rp<span class="text-danger">{{number_format($total)}}</span></span>
                        <span class="d-block text-km-gray-100 fs-7">Sudah termasuk pajak</span>
                    </div>                    
                </div> 
                <div class="d-grid gap-2 mt-4">
                    <a href="{{route('beli-keranjang')}}" class="btn btn-secondary rounded-4 km-fw-medium" type="button">
                        Pilih Metode Pembayaran &nbsp;<i class="fa-solid fa-right"></i>
                    </a>                            
                </div>                
            </div>
            @endif
        </div>
    </div>
</div>
@endsection