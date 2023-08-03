@extends('Backend.index')
@section('titleHalaman', 'Admin - Manga')
@section('Manga', 'active')

@section('csrf')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('js')
<script src="{{asset('src/js/Backend/Manga.min.js')}}"></script>
@endsection

@section('modalTambah')
<form method="POST" id="formTambahManga" enctype="multipart/form-data">
<div class="modal fade km-ff-asap" id="modalTambahManga" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Tambah Data Manga</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="inJudulManga" class="form-label">Judul Manga</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-book-sparkles"></i>
                    </span>
                    <input type="text" placeholder="Masukkan Judul Manga" class="form-control" name="inJudulManga" id="inJudulManga" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="inJudulMangaJapanese" class="form-label">Judul Manga(Jepang)</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-book-heart"></i>
                    </span>
                    <input type="text" placeholder="Masukkan Judul Manga versi Jepang" class="form-control" name="inJudulMangaJapanese" id="inJudulMangaJapanese" required>
                </div>              
            </div>
            <div class="mb-3">
                <label for="inMangaka" class="form-label">Mangaka</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-sharp fa-solid fa-feather"></i>
                    </span>
                    <select name="inMangaka" id="inMangaka" class="form-select" required>
                        @foreach ($mangakas as $mangaka)
                        <option value="{{$mangaka->id_mangaka}}">{{$mangaka->nama_mangaka}}</option>                                     
                        @endforeach                
                    </select>
                </div>                
            </div>
            <div class="mb-3">
                <label for="inPenerbit" class="form-label">Penerbit</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-brands fa-creative-commons-pd-alt fs-5"></i>
                    </span>
                    <select name="inPenerbit" id="inPenerbit" class="form-select" required>
                        @foreach ($penerbits as $penerbit)
                        <option value="{{$penerbit->id_penerbit}}">{{$penerbit->nama_penerbit}}</option>                                     
                        @endforeach                
                    </select>
                </div>                                       
            </div>
            <div class="mb-3">
                <label for="inJumlahVolume" class="form-label">Jumlah Volume</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-book-section"></i>
                    </span>
                    <input type="number" placeholder="Masukkan Jumlah Volume" class="form-control" name="inJumlahVolume" id="inJumlahVolume" required>
                </div>                                
            </div>
            <div class="mb-3">
                <label for="inTglTersedia" class="form-label">Tanggal Tersedia</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-sharp fa-solid fa-calendar-week"></i>
                    </span>
                    <input type="text" placeholder="Masukkan Tanggal Tersedia" class="form-control" name="inTglTersedia" id="inTglTersedia" required>
                </div>                                                
            </div>
            <div class="mb-3">
                <label for="inGenre" class="form-label" placeholder="Choose anything">Genre</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-regular fa-list-dropdown me-3"></i>
                    </span>
                    <select name="inGenre[]" id="inGenre" class="form-select" multiple required>
                        @foreach ($genres as $genre)
                        <option value="{{$genre->id_genre}}">{{$genre->nama_genre}}</option>                                     
                        @endforeach                
                    </select>
                </div>                                       
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
<form id="formEditManga" method="POST">
    @method('PUT')
    <input type="text" id="idManga" hidden>
    <div class="modal fade" id="modalEditManga" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Edit Data Manga</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editJudulManga" class="form-label">Judul Manga</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-book-sparkles"></i>
                        </span>
                        <input type="text" placeholder="Masukkan Judul Manga" class="form-control" name="editJudulManga" id="editJudulManga" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="editJudulMangaJapanese" class="form-label">Judul Manga(Jepang)</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-book-heart"></i>
                        </span>
                        <input type="text" placeholder="Masukkan Judul Manga versi Jepang" class="form-control" name="editJudulMangaJapanese" id="editJudulMangaJapanese" required>
                    </div>              
                </div>
                <div class="mb-3">
                    <label for="editMangaka" class="form-label">Mangaka</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-feather"></i>
                        </span>
                        <select name="editMangaka" id="editMangaka" class="form-select" required>
                            @foreach ($mangakas as $mangaka)
                            <option value="{{$mangaka->id_mangaka}}">{{$mangaka->nama_mangaka}}</option>                                     
                            @endforeach                
                        </select>
                    </div>                
                </div>
                <div class="mb-3">
                    <label for="editPenerbit" class="form-label">Penerbit</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-brands fa-creative-commons-pd-alt fs-5"></i>
                        </span>
                        <select name="editPenerbit" id="editPenerbit" class="form-select" required>
                            @foreach ($penerbits as $penerbit)
                            <option value="{{$penerbit->id_penerbit}}">{{$penerbit->nama_penerbit}}</option>                                     
                            @endforeach                
                        </select>
                    </div>                                       
                </div>
                <div class="mb-3">
                    <label for="editJumlahVolume" class="form-label">Jumlah Volume</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-solid fa-book-section"></i>
                        </span>
                        <input type="number" placeholder="Masukkan Jumlah Volume" class="form-control" name="editJumlahVolume" id="editJumlahVolume" required>
                    </div>                                
                </div>
                <div class="mb-3">
                    <label for="editTglTersedia" class="form-label">Tanggal Tersedia</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-calendar-week"></i>
                        </span>
                        <input type="text" placeholder="Masukkan Tanggal Tersedia" class="form-control" name="editTglTersedia" id="editTglTersedia" required>
                    </div>                                                
                </div>
                <div class="mb-3">
                    <label for="editGenre" class="form-label" placeholder="Choose anything">Genre</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-regular fa-list-dropdown me-3"></i>
                        </span>
                        <select name="editGenre[]" id="editGenre" class="form-select" multiple required>
                            @foreach ($genres as $genre)
                            <option value="{{$genre->id_genre}}">{{$genre->nama_genre}}</option>                                     
                            @endforeach                
                        </select>
                    </div>                                       
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
                    Data Manga
                </h5>
                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#modalTambahManga">
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
                <div class="table-responsive">
                    <table class="table table-bordered border-gray mt-3" id="km-table">
                        <thead>
                            <tr>
                                <th>@php echo("No."); $no = 1;@endphp</th>
                                <th>Judul Manga</th>
                                <th>Judul Manga(Jepang)</th>
                                <th>Mangaka</th>
                                <th>Penerbit</th>
                                <th>Jumlah Volume</th>
                                <th>Tanggal Tersedia</th>
                                <th>Slug Manga</th>
                                <th>Genre</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($mangas->reverse() as $manga)
                            <tr>
                                <th>@php echo $no; $no++;@endphp</th>
                                <td>{{ Str::limit($manga->judul_manga, 10, '...') }}</td>
                                <td>{{ Str::limit($manga->judul_jepang, 10, '...') }}</td>
                                <td>{{ Str::limit($manga->mangaka->nama_mangaka, 15, '...') }}</td>                                
                                <td>{{ Str::limit($manga->penerbit->nama_penerbit, 10, '...') }}</td>
                                <td>{{ $manga->jml_vol }}</td>
                                <td>{{ $manga->tgl_tersedia }}</td>
                                <td>{{ Str::limit($manga->slug_manga, 10, '...') }}</td>
                                <td>
                                    @foreach($manga->genreManga->take(2) as $genreManga)
                                        {{ $genreManga->genre->nama_genre }},
                                    @endforeach ...                                                                   
                                </td>
                                <td class="fs-5">
                                    <a href="{{route('all-vol', $manga->slug_manga)}}" class="editBtn"><i class="fa-solid fa-book text-info"></i></a>                        
                                    <button type="button" class="editBtn" data-id="{{$manga->id_manga}}" data-bs-toggle="modal" data-bs-target="#modalEditManga"><i class="fa-solid fa-pen-to-square text-secondary mx-1"></i></button>
                                    <button type="button" class="deleteBtn" data-id="{{$manga->id_manga}}"><i class="fa-solid fa-trash-can text-danger"></i></button>   
                                    <div class="px-5"></div>                        
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-group-divider">
                            <tr>
                                <th>No.</th>
                                <th>Judul Manga</th>
                                <th>Judul Manga(Jepang)</th>
                                <th>Id Mangaka</th>
                                <th>Id Penerbit</th>
                                <th>Jumlah Volume</th>
                                <th>Tanggal Tersedia</th>
                                <th>Slug Manga</th>
                                <th>Genre</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>                
                <div class="justify-content-between d-flex align-items-center">
                    <div class="ps-2">
                        Total data Manga: <b><span id="total-data"></span></b>
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