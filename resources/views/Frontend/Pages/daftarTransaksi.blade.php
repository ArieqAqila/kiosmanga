@extends('Frontend.index')
@section('titleHalaman', ' ')

@section('konten')
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
            
        $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun."";
        return $result;
    }
?>

<div class="container position-relative km-ff-asap mt-4 px-5">
    <div class="row row-cols-1 row-cols-lg-2 flex-column-reverse flex-lg-row justify-content-lg-between">
        <div class="col-lg-3 mt-3 mt-lg-0">
            <div class="bg-white rounded mt-5 mt-md-0 shadow">
                <div class="p-2 d-flex mx-1 py-3">
                    <div class="km-mini-profile-2 me-2">
                        @if (Auth::user()->foto_profile == null)
                          <span>
                            {!! strtoupper(substr(Auth::user()->username, 0, 2)) !!}
                          </span>
                        @else
                            <img src="{{asset('images/profile/'.Auth::user()->foto_profile)}}" alt="Your Profile">
                        @endif
                    </div>
                    <div>
                        <div class="km-fw-medium">{{strtoupper(Auth::user()->username)}}</div>
                        <div class="text-km-primary km-fw-bold">{{Auth::user()->nama_user}}</div>
                    </div>
                </div>
                <hr class="m-0">                
                <div class="p-1">
                    <div class="mt-2">
                        <span class="ms-2 km-fw-semiBold">Informasi Transaksi</span>
                        <dl class="row gy-1 ms-2 mt-1 fs-7">
                            <dt class="col-md-9 km-fw-medium">Manga yang dibeli</dt>
                            <dd class="col-md-3">{{ $purchasedManga }}</dd>
        
                            <dt class="col-md-9 km-fw-medium">Daftar Transaksi</dt>
                            <dd class="col-md-3">{{ $listTransaction }}</dd>                    
                        </dl>
                    </div>
                    
                    <div class="mt-2">
                        <span class="ms-2 km-fw-semiBold">Pembelian</span>
                        <dl class="row mb-0 gy-1 ms-2 mt-1 fs-7">
                            <dt class="col-md-9 km-fw-medium">Manga dikeranjang</dt>
                            <dd class="col-md-3">{{ $listCart }}</dd>                   
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="bg-white rounded mt-5 mt-md-0 border border-gray-500">
                <div class="d-flex">
                    <a href="{{ route('profile-page') }}" class="px-4 py-2 km-fw-semiBold text-km-gray-100">Biodata Anda</a>
                    <a href="javascript:void(0)" class="d-block px-4 py-2 km-fw-semiBold text-km-primary">Transaksi Anda</a>                                        
                </div>  
                <hr class="m-0">
                @forelse ($transaksi as $item)
                @php
                    $transactionDate = new DateTime($item->created_at);
                    $transactionDate->setTimezone(new DateTimeZone("Asia/Jakarta"));
                    $formattedTransactionDateTime = $transactionDate->format('Y-m-d\TH:i:s\Z');
                @endphp 
                <a href="{{ route('pembayaran', $item->external_id) }}" class="d-flex justify-content-between align-items-center p-3 text-dark daftar-transaksi">
                    <div class="">
                        <span class="d-block fs-6 km-fw-semiBold">{{ tgl_indonesia($formattedTransactionDateTime) }}</span>
                        <span class="fs-7 text-km-gray-100">{{ $item->status_transaksi . ', ' . $item->metode_pembayaran }}</span>
                    </div>
                    <div class="">
                        <span class="d-block fs-6 km-fw-medium">(IDR) Rp<span class="text-danger km-fw-semiBold">{{number_format($item->total_harga)}}</span></span>
                        <span class="d-block fs-7 text-km-gray-100" style="text-align: right">{{ $item->keranjang->count() }} Item(s)</span>
                    </div>
                </a>
                <hr class="m-0">
                @empty
                    <p class="ms-4 mt-3">Anda belum melakukan transaksi...</p>
                @endforelse            
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
      document.title = "Transaksi - {{Auth::user()->username}}";
    });
</script>