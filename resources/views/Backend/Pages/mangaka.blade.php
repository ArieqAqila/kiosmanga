@extends('Backend.index')
@section('titleHalaman', 'Admin - Mangaka')
@section('Mangaka', 'active')

@section('csrf')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('js')
<script src="{{asset('src/js/Backend/mangaka.min.js')}}"></script>
@endsection

@section('modalTambah')
<form method="POST" id="formTambahMangaka">
<div class="modal fade" id="modalTambahMangaka" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Tambah Data Mangaka</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="inJudul" class="form-label">Nama Mangaka</label>
                <input type="text" class="form-control" name="inNamaMangaka" id="inNamaMangaka" aria-describedby="errJudul" required>
                
                @error('inNamaMangaka')
                    <div id="errJudul" class="form-text text-danger">Nama Mangaka Invalid</div>
                @enderror
            </div>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="reset" class="btn btn-info text-white">Cancel</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('modalEdit')
<form id="formEditMangaka" method="POST">
    @method('PUT')
    <input type="text" id="idMangaka" hidden>
    <div class="modal fade" id="modalEditMangaka" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Edit Data Mangaka</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editNamaMangaka" class="form-label">Nama Mangaka</label>
                    <input type="text" class="form-control" name="editNamaMangaka" id="editNamaMangaka" aria-describedby="errNama" required>
                    
                    @error('editNamaMangaka')
                        <div id="errNama" class="form-text text-danger">Nama Mangaka Invalid</div>
                    @enderror
                </div>          
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>              
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>
@endsection

@section('konten')
<div class="page-content km-ff-asap" id="km-content">
    <button type="button" class="btn btn-primary text-white fs-5 position-fixed ps-3" style="border-radius: 0;" id="sidebarCollapse">
        <i class="fa-solid fa-xmark me-2" id="km-icon"></i>
    </button>
    <div class="px-5 ms-5 pt-5 pb-5">
        <div class="container-fluid p-0 shadow">
            <div class="d-flex justify-content-between align-items-center bg-km-gray p-3">
                <h5 class="text-primary m-0">
                    <i class="fa-solid fa-pen-swirl me-3"></i>
                    Data Mangaka
                </h5>
                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#modalTambahMangaka">
                    <i class="fa-solid fa-circle-plus"></i>
                    Tambah data
                </button>
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
                            <th>Nama Mangaka</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($mangakas as $mangaka)
                        <tr>
                            <th>{{$mangaka->id_mangaka}}</th>
                            <td>{{$mangaka->nama_mangaka}}</td>                            
                            <td class="fs-5">                            
                                <button type="button" class="editBtn" data-id="{{$mangaka->id_mangaka}}" data-bs-toggle="modal" data-bs-target="#modalEditMangaka"><i class="fa-solid fa-pen-to-square text-secondary mx-1"></i></button>
                                <button type="button" class="deleteBtn" data-id="{{$mangaka->id_mangaka}}"><i class="fa-solid fa-trash-can text-danger"></i></button>                             
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-group-divider">
                        <tr>
                            <th>No.</th>
                            <th>Nama Mangaka</th>                            
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="justify-content-between d-flex align-items-center">
                    <div class="ps-2">
                        Total data Mangaka: <b><span id="total-data"></span></b>
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