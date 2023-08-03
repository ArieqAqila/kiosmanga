<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Pembayaran - KiosManga</title>

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
    <?php
        function tgl_indonesia($date){
            /* ARRAY u/ hari dan bulan */
            $Hari = array ("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu",);
            $Bulan = array ("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            
            /* Memisahkan format tanggal bulan dan tahun menggunakan substring */
            $tahun 	 = substr($date, 0, 4);
            $bulan 	 = substr($date, 5, 2);
            $tgl	 = substr($date, 8, 2);
            $waktu	 = substr($date,11, 5);
            $hari	 = date("w", strtotime($date));
                
            $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu." WIB";
            return $result;
        }


        if ($transaksi->status_transaksi == 'PENDING') {
            $expiredDate = new DateTime($virtualAcc['expiration_date']);
            $expiredDate->setTimezone(new DateTimeZone("Asia/Jakarta"));
            $formattedExpiredDateTime = $expiredDate->format('Y-m-d\TH:i:s\Z');

        } else {
            $transactionDate = new DateTime($virtualAcc['transaction_timestamp']);
            $transactionDate->setTimezone(new DateTimeZone("Asia/Jakarta"));
            $formattedTransactionDateTime = $transactionDate->format('Y-m-d\TH:i:s\Z');
        }
        $itemCount = App\Models\Keranjang::where('id_transaksi', $transaksi->id_transaksi)->count();
    ?>

    <div class="modal fade" id="modalDetailPesanan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable km-ff-asap">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5">Detail Pesanan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
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
    <div class="container row row-cols-1 mx-auto justify-content-center mt-2">
        <div class="col-12 col-lg-6 px-0 bg-white rounded-2 km-ff-asap batas-pembayaran pb-2">
            <div class="border-km-left km-primary border-bottom border-km-primary ps-4 km-fw-medium text-km-primary fs-5 py-2">
                @if ($transaksi->status_transaksi == 'PENDING')
                    Invoice Pembayaran
                @else
                    Invoice
                @endif
            </div>

            @if ($transaksi->status_transaksi == 'PENDING')
            <div class="d-flex justify-content-between px-3 mt-2 align-items-center">
                <div class="fs-6">
                    <span class="d-block text-km-gray-100">Batas Akhir Pembayaran</span>
                    <span class="d-block km-fw-semiBold">{{ tgl_indonesia($formattedExpiredDateTime) }}</span>
                </div>
                <div class="fs-7 km-fw-semiBold px-2 bg-danger rounded-4 text-white">
                    <i class="fa-regular fa-clock"></i>&nbsp;
                    <span id="countdown"></span>
                </div>
            </div>

            @else

            <div class="d-flex justify-content-between px-3 mt-2 align-items-center">
                <div class="fs-6">
                    <span class="d-block text-km-gray-100">Transaksi pada Tanggal</span>
                    <span class="d-block km-fw-semiBold">{{ tgl_indonesia($formattedTransactionDateTime) }}</span>
                </div>
                <div class="fs-7 km-fw-semiBold bg-km-primary px-1 rounded-5 text-white text-center">
                    <i class="fa-regular fa-circle-check"></i></i>
                </div>
            </div>
            @endif

            <hr class="border-4 border-km-gray-50">

            <div class="d-flex justify-content-between px-3 pb-1 mt-2 align-items-center">
                <div class="fs-6 km-fw-semiBold">
                    {{ $virtualAcc['bank_code'] }} Virtual Account
                </div>
            </div>


            <div class="d-flex justify-content-between px-3 mt-2 align-items-center">
                <div class="fs-6">
                    <span class="d-block text-km-gray-100">Nomor Virtual Account</span>
                    <span class="d-block km-fw-semiBold">{{ $virtualAcc['account_number'] }}</span>
                </div>
                <div class="fs-7 km-fw-semiBold px-2 bg-secondary rounded-4 text-white">
                    <i class="fa-solid fa-hashtag"></i>&nbsp;
                    Angka Unik
                </div>
            </div>


            <div class="d-flex justify-content-between px-3 mt-2 align-items-center">
                <div class="fs-6">
                    <span class="d-block text-km-gray-100">Total Pembayaran</span>
                    <span class="d-block km-fw-semiBold">(IDR) Rp<span class="text-danger">
                        @if ($transaksi->status_transaksi == 'PENDING')
                            {{ number_format($virtualAcc['expected_amount']) }}</span>
                        @else
                            {{ number_format($virtualAcc['amount']) }}</span>
                        @endif
                    </span>
                </div>
                <div class="fs-7 km-fw-semiBold px-2 bg-info rounded-4 text-white button-items" data-bs-toggle="modal" data-bs-target="#modalDetailPesanan">
                    <i class="fa-solid fa-grip"></i>&nbsp;
                    {{$itemCount}} Item(s)
                </div>
            </div>


            <div class="d-flex justify-content-between px-3 mt-2 align-items-center">
                @if ($transaksi->status_transaksi == 'PENDING')
                <div class="fs-6">
                    <span class="d-block text-km-gray-100">Status</span>
                    <span class="d-block km-fw-semiBold text-warning">{{ $transaksi->status_transaksi}}</span>
                </div>
                <div class="fs-7 km-fw-semiBold px-2 bg-warning rounded-4 text-white">
                    <i class="fa-solid fa-spinner km-spin"></i>&nbsp;
                    Menunggu Pembayaran
                </div> 
                @else
                <div class="fs-6">
                    <span class="d-block text-km-gray-100">Status</span>
                    <span class="d-block km-fw-semiBold text-km-primary">{{ $transaksi->status_transaksi}}</span>
                </div>
                <div class="fs-7 km-fw-semiBold px-2 bg-km-primary rounded-4 text-white">
                    <i class="fa-regular fa-circle-check"></i></i>&nbsp;
                    Sudah dibayar
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container-fluid bg-primary text-white text-center py-4 km-footer">
      <span>KiosManga is a property of Arieq Aqila. ©2023 All Rights Reserved.</span>
    </div>
    
    @if ($transaksi->status_transaksi == 'PENDING')
    <script>
        function updateCountdown() {
            var currentDate = new Date();

            var specifiedDate = new Date("{{$virtualAcc['expiration_date']}}");

            var timeDiff = specifiedDate.getTime() - currentDate.getTime();

            if (timeDiff <= 0) {
                console.log("Countdown completed!");
                return;
            }

            var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            $("#countdown").text(hours + " : " + minutes + " : " + seconds);
        }
        $(document).ready(function() {
            setInterval(updateCountdown, 1000);
        });
    </script>
    @endiF
    

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