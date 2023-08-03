@extends('Backend.index')
@section('titleHalaman', 'Dashboard')
@section('Dashboard', 'active')

@section('csrf')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('konten')
@php
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
                
        $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu;
        return $result;
    }
@endphp
<div class="page-content km-ff-asap" id="km-content">
    <button type="button" class="btn btn-primary text-white fs-5 position-fixed ps-3" style="border-radius: 0;" id="sidebarCollapse">
        <i class="fa-solid fa-xmark me-2" id="km-icon"></i>
    </button>
    <div class="px-5 ms-5 pt-1 pb-5">
        <div class="container-fluid p-0 shadow">
            <div class="d-flex justify-content-between align-items-center bg-km-gray p-3">
                <h5 class="text-primary m-0">
                    <i class="fa-solid fa-wreath me-3"></i>
                    Welcome! <span class="text-uppercase">{{ Auth::user()->username }}</span>
                </h5>
                <div class="km-fw-semiBold">
                    @php
                        date_default_timezone_set('Asia/Jakarta');
                        $date = date('Y-m-d');
                        echo tgl_indonesia($date);
                    @endphp
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center px-5 ms-5 pt-1 pb-5 g-4">
        <div class="col-12 d-flex align-items-center border border-1 border-km-primary bg-white p-3 rounded">
            <i class="fa-solid fa-money-bills text-km-primary fs-1"></i>
            <div class="ms-4">
                <div class="fs-3 km-fw-medium">IDR <span class="text-primary km-fw-semiBold">{{ number_format($balance['balance']) }}</span></div>
                <div class="fs-5 text-km-gray-100">Xendit Balance</div>
            </div>
        </div>


        <div class="col-3 mx-auto d-flex align-items-center border border-1 border-km-blue bg-white rounded p-3">
            <i class="fa-solid fa-scale-balanced text-km-blue fs-2"></i>
            <div class="ms-4">
                <div class="fs-5 km-fw-medium">{{ $totalTransaksi }}</div>
                <div class="text-km-gray-100">Transaksi</div>
            </div>
        </div>

        <div class="col-3 mx-auto d-flex align-items-center border border-1 border-secondary bg-white rounded p-3">
            <i class="fa-solid fa-cart-shopping text-secondary fs-2"></i>
            <div class="ms-4">
                <div class="fs-5 km-fw-medium">{{ $totalPembelian }}</div>
                <div class="text-km-gray-100">Pembelian</div>
            </div>
        </div>


        <div class="col-3 mx-auto d-flex align-items-center border border-1 border-danger bg-white rounded p-3">
            <i class="fa-solid fa-user-group text-danger fs-2"></i>
            <div class="ms-4">
                <div class="fs-5 km-fw-medium">{{ $totalPengguna }}</div>
                <div class="text-km-gray-100">Pengguna</div>
            </div>
        </div>
    </div>
</div>
@endsection