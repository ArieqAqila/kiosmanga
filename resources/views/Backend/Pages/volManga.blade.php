@extends('Backend.index')
@section('titleHalaman', 'Admin - VolManga')
@section('VolManga', 'active')

@section('csrf')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('js')
<script src="{{asset('src/js/Backend/volManga.min.js')}}"></script>
@endsection

@section('modalTambah')
<form method="POST" id="formTambahVolManga">
<div class="modal fade" id="modalTambahVolManga" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Tambah Data VolManga</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="inVolKe" class="form-label">Volume ke-</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-arrow-up-9-1"></i>
                    </span>
                    <input type="number" placeholder="Masukkan Volume Series" class="form-control" name="inVolKe" id="inVolKe" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="inDeskripsi" class="form-label">Deskripsi</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-text-size"></i>
                    </span>
                    <textarea rows="3" placeholder="Masukkan Deskripsi" class="form-control" name="inDeskripsi" id="inDeskripsi" required></textarea>
                </div>
            </div>
            <div class="mb-3">
                <label for="inBahasa" class="form-label">Bahasa</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-language"></i>
                    </span>
                    <input type="text" placeholder="Masukkan Bahasa TL Manga" class="form-control" name="inBahasa" id="inBahasa" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="inJmlHal" class="form-label">Jumlah Halaman</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-input-numeric"></i>
                    </span>
                    <input type="number" placeholder="Masukkan Jumlah Halaman" class="form-control" name="inJmlHal" id="inJmlHal" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="inHarga" class="form-label">Harga</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <b>Rp.</b>
                    </span>
                    <input type="number" placeholder="Masukkan Harga Manga" class="form-control" name="inHarga" id="inHarga" required>
                </div>                
            </div>
            <div class="mb-3">
                <label for="inVisualArt" class="form-label">Visual Art</label>
                <input type="file" accept="image/*" class="form-control" name="inVisualArt" id="inVisualArt" required>                                                
            </div>              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="reset" class="btn btn-info text-white">Cancel</button>
          <button type="submit" data-id="{{$manga->id_manga}}" id="addBtn" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('modalEdit')
<form id="formEditVolManga" method="POST">
    @method('PUT')
    <input type="text" id="idVolManga" hidden>
    <input type="text" id="idManga" hidden>
    <div class="modal fade" id="modalEditVolManga" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Edit Data VolManga</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editVolKe" class="form-label">Volume ke-</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-arrow-up-9-1"></i>
                        </span>
                        <input type="number" placeholder="Masukkan Volume Series" class="form-control" name="editVolKe" id="editVolKe" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="editDeskripsi" class="form-label">Deskripsi</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-text-size"></i>
                        </span>
                        <textarea rows="3" placeholder="Masukkan Deskripsi" class="form-control" name="editDeskripsi" id="editDeskripsi" required></textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="editBahasa" class="form-label">Bahasa</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-language"></i>
                        </span>
                        <input type="text" placeholder="Masukkan Bahasa TL Manga" class="form-control" name="editBahasa" id="editBahasa" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="editJmlHal" class="form-label">Jumlah Halaman</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-input-numeric"></i>
                        </span>
                        <input type="number" placeholder="Masukkan Jumlah Halaman" class="form-control" name="editJmlHal" id="editJmlHal" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="editHarga" class="form-label">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <b>Rp.</b>
                        </span>
                        <input type="number" placeholder="Masukkan Harga Manga" class="form-control" name="editHarga" id="editHarga" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="editVisualArt" class="form-label">Visual Art</label><br>
                    <button class="btn btn-km-primary text-white mb-2" id="previewVisualArt"><i class="fa-solid fa-eye"></i>Lihat Visual Art</button>
                    <input type="file" accept="image/*" class="form-control" name="editVisualArt" id="editVisualArt">                                                
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
                    <i class="fa-solid fa-books me-3"></i>
                    Data Volume Manga
                </h5>
                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#modalTambahVolManga">
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
                            <th>@php echo("No."); $no = 1;@endphp</th>
                            <th>Manga</th>
                            <th>Volume Manga</th>
                            <th>Deskripsi</th>
                            <th>Bahasa</th>
                            <th>Jumlah Halaman</th>
                            <th>Harga</th>
                            <th>Visual Art</th>
                            <th>Slug Volume</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($volMangas as $volManga)
                        <tr>
                            <td>@php echo $no; $no++;@endphp</td>
                            <td>{{ Str::limit($volManga->manga->judul_manga, 10, '...') }}</td>
                            <td>{{$volManga->vol_ke}}</td>
                            <td>{{ Str::limit($volManga->deskripsi, 10, '...') }}</td>
                            <td>{{$volManga->bahasa}}</td>
                            <td>{{$volManga->jml_hal}}</td>
                            <td>{{$volManga->harga}}</td>
                            <td>
                                <button class="btn btn-km-primary text-white mb-2 viewVisualArt" data-vart="{{$volManga->visual_art}}" data-judul="{{$volManga->manga->judul_manga}}"><i class="fa-solid fa-eye"></i> Lihat Visual Art</button>
                            </td>
                            <td>{{ Str::limit($volManga->slug_vol, 10, '...') }}</td>                          
                            <td class="fs-5">                            
                                <button type="button" class="editBtn" data-id="{{$volManga->id_vol}}" data-bs-toggle="modal" data-bs-target="#modalEditVolManga"><i class="fa-solid fa-pen-to-square text-secondary mx-1"></i></button>
                                <button type="button" class="deleteBtn" data-id="{{$volManga->id_vol}}"><i class="fa-solid fa-trash-can text-danger"></i></button>                             
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-group-divider">
                        <tr>
                            <th>No.</th>
                            <th>Manga</th>
                            <th>Volume Manga</th>
                            <th>Deskripsi</th>
                            <th>Bahasa</th>
                            <th>Jumlah Halaman</th>
                            <th>Harga</th>
                            <th>Visual Art</th>
                            <th>Slug Volume</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="justify-content-between d-flex align-items-center">
                    <div class="ps-2">
                        Total data VolManga: <b><span id="total-data"></span></b>
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