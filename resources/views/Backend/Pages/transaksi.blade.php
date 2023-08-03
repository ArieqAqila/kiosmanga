@extends('Backend.index')
@section('titleHalaman', 'Admin - Transaksi')
@section('Transaksi', 'active')


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
    date_default_timezone_set('Asia/Jakarta');
@endphp
<div class="page-content km-ff-asap" id="km-content">
    <button type="button" class="btn btn-primary text-white fs-5 position-fixed ps-3" style="border-radius: 0;" id="sidebarCollapse">
        <i class="fa-solid fa-xmark me-2" id="km-icon"></i>
    </button>
    <div class="px-5 ms-5 pt-5 pb-5">
        <div class="container-fluid p-0 shadow">
            <div class="d-flex justify-content-between align-items-center bg-km-gray p-3">
                <h5 class="text-primary m-0">
                    <i class="fa-solid fa-money-bill-transfer me-3"></i>
                    Data Transaksi
                </h5>
                <div class="">
                    <form action="{{ route('transaksi-csv') }}" method="GET">
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
                            <th>External ID</th>
                            <th>ID Virtual Account</th>
                            <th>Username Pengguna</th>
                            <th>Metode Pembayaran</th>
                            <th>Total Pembayaran</th>
                            <th>Status Transaksi</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @php $no = 1; @endphp
                        @foreach ($transaksi as $item)
                        <tr>
                            <th>{{$no++}}</th>
                            <td>{{ Str::limit($item->external_id, 30, '...')}}</td>
                            <td>{{ Str::limit($item->id_va, 20, '...')}}</td>
                            <td>{{ Str::limit($item->user->username, 20, '...')}}</td>
                            <td>{{ Str::limit($item->metode_pembayaran, 20, '...')}}</td>
                            <td>{{ Str::limit($item->total_harga, 20, '...')}}</td>
                            <td>{{ Str::limit($item->status_transaksi, 20, '...')}}</td>
                            <td>{{ Str::limit(tgl_indonesia($item->updated_at), 20, '...') }}</td>                  
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-group-divider">
                        <tr>
                            <th>No.</th>
                            <th>External ID</th>
                            <th>ID Virtual Account</th>
                            <th>Username Pengguna</th>
                            <th>Metode Pembayaran</th>
                            <th>Total Pembayaran</th>
                            <th>Status Transaksi</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="justify-content-between d-flex align-items-center">
                    <div class="ps-2">
                        Total data Transaksi: <b><span id="total-data"></span></b>
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