@extends('Backend.index')
@section('titleHalaman', 'Admin - Keranjang')
@section('Keranjang', 'active')


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
    <div class="px-5 ms-5 pt-5 pb-5">
        <div class="container-fluid p-0 shadow">
            <div class="d-flex justify-content-between align-items-center bg-km-gray p-3">
                <h5 class="text-primary m-0">
                    <i class="fa-solid fa-cart-shopping me-3"></i>
                    Data Keranjang
                </h5>
                <div class="">
                    <form action="{{ route('keranjang-csv') }}" method="GET">
                        <div class="row align-items-center">
                            <div class="col">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="form-text ms-1 text-danger" id="start-date">{{ $error }}</div>
                                    @endforeach
                                @else
                                <div class="form-text ms-1" id="start-date">Start Date</div>
                                @endif
                                <div class="input-group">
                                    <input type="date" name="startDate" class="form-control" aria-describedby="start-date">
                                </div>
                            </div>
                            <div class="col">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="form-text ms-1 text-danger" id="start-date">{{ $error }}</div>
                                    @endforeach 
                                @else
                                <div class="form-text ms-1" id="end-date">End Date</div>
                                @endif
                                <div class="input-group">
                                    <input type="date" name="endDate" class="form-control" aria-describedby="end-date">
                                </div>
                            </div>
                            <div class="col text-end">
                                <div class="form-text ms-1" id="start-date">&nbsp;</div>
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-download"></i> &nbsp;CSV</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white p-3">
                <div class="mx-2 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        Show&nbsp;
                        <select class="form-select mx-1" id="km-form-select">
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                        </select>
                        &nbsp;data
                    </div>
                    <div>
                        <input type="search" id="search-input" class="form-control" placeholder="Search...">
                    </div>
                </div>
                <table class="table table-bordered border-gray mt-3" id="km-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Manga</th>
                            <th>Volume ke</th>
                            <th>Username Pengguna</th>
                            <th>Status Item</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @php $no = 1; @endphp
                        @foreach ($keranjang as $cart)
                        <tr>
                            <th>{{$no++}}</th>
                            <td>{{ Str::limit($cart->volManga->manga->judul_manga, 30, '...')}}</td>
                            <td>{{ Str::limit($cart->volManga->vol_ke, 20, '...')}}</td>
                            <td>{{ Str::limit($cart->user->username, 20, '...')}}</td>
                            <td>{{ Str::limit($cart->status, 20, '...')}}</td>
                            <td>{{ tgl_indonesia($cart->created_at) }}</td>                  
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-group-divider">
                        <tr>
                            <th>No.</th>
                            <th>Manga</th>
                            <th>Volume ke</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Created at</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="justify-content-between d-flex align-items-center">
                    <div class="ps-2">
                        Total data Keranjang: <b><span id="total-data"></span></b>
                    </div>
                    <div class="pagination me-3 bg-km-primary p-1 rounded">
                        <ul class="list-group list-group-horizontal">
                            {{-- Paginasi --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection