@extends('Backend.index')
@section('titleHalaman', 'Admin - User')
@section('Pengguna', 'active')

@section('csrf')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('js')
<script src="{{asset('src/js/Backend/User.min.js')}}"></script>
@endsection

@section('modalTambah')
<form method="POST" id="formTambahUser" enctype="multipart/form-data">
    <div class="modal fade km-ff-asap" id="modalTambahUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5">Tambah Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inNamaUser" class="form-label">Nama User</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user-pen"></i>
                            </span>
                            <input type="text" placeholder="Masukkan nama user" class="form-control" name="inNamaUser" id="inNamaUser" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inEmail" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" placeholder="Masukkan email user" class="form-control" name="inEmail" id="inEmail" required>
                        </div>              
                    </div>
                    <div class="mb-3">
                        <label for="inUsername" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-signature"></i>
                            </span>
                            <input type="text" placeholder="Max 15 Karakter" max="15" class="form-control" name="inUsername" id="inUsername" required>
                        </div>                
                    </div>
                    <div class="mb-3">
                        <label for="inPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-key"></i>
                            </span>
                            <input type="password" placeholder="Max 12 karakter" max="12" class="form-control" name="inPassword" id="inPassword" required>
                        </div>                                       
                    </div>
                    <div class="mb-3">
                        <label for="inNotelp" class="form-label">No Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <input type="text" placeholder="Masukkan no telepon user" class="form-control" name="inNotelp" id="inNotelp" required>
                        </div>                                
                    </div>
                    <div class="mb-3">
                        <label for="inTglLahir" class="form-label">Tanggal Lahir</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input type="text" placeholder="Masukkan tanggal lahir user" class="form-control" name="inTglLahir" id="inTglLahir" required>
                        </div>                                                
                    </div>
                    <div class="mb-3">
                        <label for="editIsAdmin" class="form-label">Hak Akses</label>
                        <select name="inIsAdmin" id="inIsAdmin" class="form-control">
                            <option value="0">Pengguna</option>
                            <option value="1">Admin</option>    
                        </select>                                        
                    </div>
                    <div class="mb-3">
                        <label for="inFotoProfile" class="form-label">Foto Profile</label>
                        <input type="file" accept="image/*" class="form-control" name="inFotoProfile" id="inFotoProfile" required>                                                
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
<form id="formEditUser" method="POST">
    @method('PUT')
    <input type="text" id="idUser" hidden>
    <div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Edit Data User</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editNamaUser" class="form-label">Nama User</label>
                    <input type="text" class="form-control" name="editNamaUser" id="editNamaUser" maxlength="30" required>                                        
                </div>
                <div class="mb-3">
                    <label for="editEmail" class="form-label">Email</label>
                    <input type="text" class="form-control" name="editEmail" id="editEmail" required>                                        
                </div>
                <div class="mb-3">
                    <label for="editUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" name="editUsername" id="editUsername" minlength="6" maxlength="15" required>                    
                </div>
                <div class="mb-3">
                    <label for="editPassword" class="form-label">Password</label>
                    <input type="password" class="form-control is-invalid" name="editPassword" minlength="6" maxlength="20" id="editPassword">                    
                </div>
                <div class="mb-3">
                    <label for="editNoTelp" class="form-label">No Telepon</label>
                    <input type="number" class="form-control" name="editNotelp" id="editNotelp" required>                    
                </div>
                <div class="mb-3">
                    <label for="editTglLahir" class="form-label">Tanggal Lahir</label>
                    <input type="text" class="form-control" name="editTglLahir" id="editTglLahir" required>                                        
                </div>
                <div class="mb-3">
                    <label for="editIsAdmin" class="form-label">Hak Akses</label>
                    <select name="editIsAdmin" id="editIsAdmin" class="form-control">
                        <option value="0">Pengguna</option>
                        <option value="1">Admin</option>    
                    </select>                                        
                </div>
                <div class="mb-3">
                    <label for="editFotoProfile" class="form-label">Foto Profile</label><br>
                    <button class="btn btn-km-primary text-white mb-2" id="previewFotoPreview"><i class="fa-solid fa-eye"></i> Lihat Foto</button>
                    <input type="file" accept="image/*" class="form-control" name="editFotoProfile" id="editFotoProfile">                                        
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
                    <i class="fa-solid fa-user-large me-3"></i>
                    Data User
                </h5>
                <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
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
                                <th>No.</th>
                                <th>Foto Profile</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>No Telp</th>
                                <th>Tanggal Lahir</th>
                                <th>Foto Profile</th>
                                <th>Is Admin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($users as $user)
                            <tr>
                                <th>{{$user->id_user}}</th>
                                <td>{{$user->nama_user}}</td>
                                <td>{{ Str::limit($user->email, 10, '...') }}</td>
                                <td>{{$user->username}}</td>
                                <td><b>HIDDEN</b></td>
                                <td>{{$user->notelp}}</td>
                                <td>{{$user->tgl_lahir}}</td>
                                <td>{{ Str::limit($user->foto_profile, 10, '...') }}</td>
                                <td>
                                    @if ($user->isAdmin == 0)
                                        Pengguna
                                    @else
                                        Admin
                                    @endif
                                </td>
                                <td class="fs-5">                            
                                    <button type="button" class="editBtn" data-id="{{$user->id_user}}" data-bs-toggle="modal" data-bs-target="#modalEditUser"><i class="fa-solid fa-pen-to-square text-secondary mx-1"></i></button>
                                    <button type="button" class="deleteBtn" data-id="{{$user->id_user}}"><i class="fa-solid fa-trash-can text-danger"></i></button>                             
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-group-divider">
                            <tr>
                                <th>No.</th>
                                <th>Foto Profile</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>No Telp</th>
                                <th>Tanggal Lahir</th>
                                <th>Foto Profile</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>                
                <div class="justify-content-between d-flex align-items-center">
                    <div class="ps-2">
                        Total data User: <b><span id="total-data"></span></b>
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

<script>
    const maxLength = 13;
    document.getElementById('inNotelp').addEventListener('input', function() {
        let inputValue = this.value.toString(); // Convert the input value to a string
        
        if (inputValue.length > maxLength) {
            inputValue = inputValue.slice(0, maxLength); // Truncate the input to the maximum length
            this.value = inputValue; // Set the modified value back to the input field
        }
    });

    document.getElementById('editNotelp').addEventListener('input', function() {
        let inputValue = this.value.toString(); // Convert the input value to a string
        
        if (inputValue.length > maxLength) {
            inputValue = inputValue.slice(0, maxLength); // Truncate the input to the maximum length
            this.value = inputValue; // Set the modified value back to the input field
        }
    });


    document.getElementById('editNamaUser').addEventListener('input', function() {
        var sanitizedValue = this.value.replace(/[^a-zA-Z\s]/g, '');
        this.value = sanitizedValue;
    });

    document.getElementById('inNamaUser').addEventListener('input', function() {
        var sanitizedValue = this.value.replace(/[^a-zA-Z\s]/g, '');
        this.value = sanitizedValue;
    });
</script>
@endsection