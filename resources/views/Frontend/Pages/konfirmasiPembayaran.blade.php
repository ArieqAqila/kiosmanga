<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Konfirmasi Pembayaran - KiosManga</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Comfortaa:wght@300;400;500;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">


    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{asset('FontAwesome/css/all.css')}}">

    {{-- MyCss --}}
    <link rel="stylesheet" href="{{asset('src/css/style.css')}}">
</head>
<body>
    <div class="modal fade" id="modalDetailPesanan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable km-ff-asap">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Detail Pesanan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    @if ($namaRoute == 'beli-keranjang')
                        @foreach ($listItem as $item)
                        <div class="d-flex justify-content-between">
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
                            </div>                    
                        </div>
                        @endforeach
                    @else
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex p-3 pe-0">
                                <img src="{{ asset('/images/visualArt/'.$volManga->manga->judul_manga.'/'.$volManga->visual_art) }}" alt="gambar" height="150" class="border border-2 border-km-gray-50">
                                <div class="fs-6 mt-1 ms-2">
                                    <div class="km-fw-semiBold">
                                        <span class="km-fw-medium bg-warning rounded-3 px-1 px-md-2 text-white fs-8">{{'Vol ' . $volManga->vol_ke}}</span>
                                        <span class="truncate-1">{{$volManga->manga->judul_manga}}</span>                                                                        
                                    </div>
                                    <span class="d-block text-km-gray-100">{{$volManga->manga->penerbit->nama_penerbit}}</span>
                                </div>
                            </div>                                            
                        </div>
                        <div class="d-flex fs-7">
                            <span class="d-flex flex-column justify-content-end">
                                <label class="d-block me-2 mb-1">Rp<span class="text-danger">{{number_format($volManga->harga, 0, '.', ',')}}</span></label>
                            </span>                            
                        </div>                    
                    </div>
                    @endif
                </div>          
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>


    <div class="bg-km-primary justify-content-end py-1 d-none d-md-flex">
        <div><a href="#" class="text-km-lightgreen">Tentang Kami</a></div>
        <div><a href="#" class="text-km-lightgreen px-5 me-5">Kontak Kami</a></div>
    </div>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid d-flex align-items-center justify-content-center">
            <a class="navbar-brand text-center d-flex align-items-center justify-content-center" href="{{route('home')}}">
                <div class="wrapper d-inline-block km-ff-asap km-logo">
                    <div>満<span class="text-km-blue">牙</span></div>
                    <div>気<span class="text-km-blue">尾</span>素</div>
                </div>
                <div class="ms-2 km-ff-comfortaa">KiosManga</div>   
            </a>
        </div>
    </nav>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb km-ff-asap">
            @if ($namaRoute == 'beli-keranjang')
                <li class="breadcrumb-item ms-3"><a href="{{route('home')}}" class="text-km-lightblue">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('list-keranjang')}}" class="text-km-lightblue">Cart</a></li>                
                <li class="breadcrumb-item active" aria-current="page">Konfirmasi Pembayaran</li>
            @else
                <li class="breadcrumb-item ms-3"><a href="{{route('home')}}" class="text-km-lightblue">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('list-manga')}}" class="text-km-lightblue">Manga</a></li>
                <li class="breadcrumb-item"><a href="{{route('detail-manga', $volManga->slug_vol)}}" class="text-km-lightblue">{{Str::limit($volManga->slug_vol, 25, '...')}}</a></li>
                <li class="breadcrumb-item active">Beli Sekarang</li>
                <li class="breadcrumb-item active" aria-current="page">Konfirmasi Pembayaran</li>
            @endif          
        </ol>
    </nav>
    <div class="container bg-white rounded-2 p-4 km-ff-asap">
        <div class="border-km-left km-primary border-bottom border-km-primary ps-4 km-fw-medium text-km-primary fs-5 py-2">Konfirmasi Pembayaran</div>
        <div class="row row-cols-1 row-cols-md-2 justify-content-between">
            <div class="col-12 col-md-5 ms-0 ms-md-5 mt-4">
                <div class="border border-3 border-danger rounded-3 p-4 km-total-cart">
                    <div class="border-km-left km-danger d-flex justify-content-between align-items-center ps-3">
                        <div class="fs-4 km-fw-semiBold">Total Harga</div>
                        <div class="">
                            <span class="d-block fs-5">(IDR) Rp<span class="text-danger km-fw-semiBold">{{number_format($total)}}</span></span>
                            <span class="d-block text-km-gray-100 fs-7">Sudah termasuk pajak</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row row-cols-2 justify-content-between align-items-center gy-2">
                        <div class="col">Subtotal</div>
                        <div class="col text-end">(IDR) {{number_format($subtotal)}}</div>
    
                        <div class="col">Pajak</div>
                        <div class="col text-end">(IDR) {{number_format($pajak)}}</div>
    
                        <div class="col pt-2 fw-bold">TOTAL</div>
                        <div class="col text-end fw-bold">(IDR) {{number_format($total)}}</div>
                    </div>
                    <div class="btn btn-km-gray-10 border border-2 border-km-gray-50 d-block rounded-0 mt-4" data-bs-toggle="modal" data-bs-target="#modalDetailPesanan">
                        <div class="d-flex justify-content-between">
                            <span class="d-block">Detail</span>
                            @if ($namaRoute == 'beli-keranjang')
                                <span class="d-block">{{ $listItem->count() }} Item(s)</span>
                            @else
                                <span class="d-block">Detail Item</span>
                            @endif
                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-12 col-md-5 me-0 me-md-5 mt-4">
                <div class="border border-3 border-secondary rounded-3 p-4 km-total-cart">
                    <div class="border-km-left km-purple d-flex justify-content-between align-items-center ps-3">
                        <div class="fs-4 km-fw-semiBold">Total Pembayaran</div>
                        <div class="">
                            <span class="d-block fs-5">(IDR) Rp<span class="text-danger km-fw-semiBold">{{number_format($total)}}</span></span>
                            <span class="d-block text-km-gray-100 fs-7">Sudah termasuk pajak</span>
                        </div>
                    </div>
    
                    <hr>
    
                    <div class="text-center mb-3 km-fw-medium">Pilih Metode Pembayaran</div>

                    @php                        
                        $routeKonfirmasiPembayaran = ($namaRoute == 'beli-keranjang') ? route('konfirmasiPembayaran-keranjang') : route('konfirmasiPembayaran-langsung', $volManga->id_vol) ;
                    @endphp  

                    <form action="{{$routeKonfirmasiPembayaran}}" method="POST" class="km-radio">
                        @csrf
                        <div class="row row-cols-2 justify-content-between align-items-center gy-3 px-4">                            
                            <label class="col">
                                <input type="radio" name="metodePembayaran" value="BNI" checked>
                                Virtual Account BNI
                            </label>
                            <label class="col">
                                <input type="radio" name="metodePembayaran" value="BCA">
                                Virtual Account BCA
                            </label>                                           
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-secondary rounded-4 km-fw-medium" type="submit">Konfirmasi Pembayaran</button>                            
                        </div>                        
                    </form>                    
                </div>                
            </div>
        </div>
    </div>

    <div class="container-fluid bg-primary text-white text-center py-4 km-footer">
      <span>KiosManga is a property of Arieq Aqila. ©2023 All Rights Reserved.</span>
    </div>
    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

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