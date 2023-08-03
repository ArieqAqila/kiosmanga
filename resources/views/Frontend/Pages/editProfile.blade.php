@extends('Frontend.index')
@section('titleHalaman', ' ')

@section('konten')

{{-- Modal Section --}}

<div class="modal fade km-ff-asap" id="ubahUsername" tabindex="-1" aria-labelledby="modalEditUsername" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('ubah-biodata', Auth::user()->username)}}" method="POST">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditUsername">Ubah Username</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">          
            <div class="mb-3">
                <label for="editUsername" class="form-label km-fw-semiBold">Username</label>
                <input type="text" name="ubahUsername" class="form-control" id="editUsername" minlength="6" maxlength="15" aria-describedby="usernameUnique" value="{{Auth::user()->username}}">
                <div id="usernameUnique" class="form-text">Username bersifat "UNIK". Pastikan username anda sudah benar</div>
            </div>          
        </div>
        <div class="modal-footer">          
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade km-ff-asap" id="ubahNama" tabindex="-1" aria-labelledby="modalEditNama" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('ubah-biodata', Auth::user()->username)}}" method="POST">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditNama">Ubah Nama Lengkap</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="editNama" class="form-label km-fw-semiBold">Nama Lengkap</label>
                <input type="text" name="ubahNama" class="form-control" id="editNama" aria-describedby="namaUser" maxlength="30" value="{{Auth::user()->nama_user}}">
                <div id="namaUser" class="form-text">Pastikan nama anda sudah benar.</div>
            </div>                    
        </div>
        <div class="modal-footer">          
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade km-ff-asap" id="ubahTglLahir" tabindex="-1" aria-labelledby="modalEditTglLahir" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('ubah-biodata', Auth::user()->username)}}" method="POST">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditTglLahir">Ubah Tanggal Lahir</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">                            
            <div class="mb-3">
                <label for="editTglLahir" class="form-label km-fw-semiBold">Tanggal Lahir</label>
                <input type="date" name="ubahTglLahir" class="form-control" id="editTglLahir" max="2017-12-31" aria-describedby="tglLahir" value="{{Auth::user()->tgl_lahir}}">
                <div id="tglLahir" class="form-text">Pastikan tanggal lahir anda sudah benar.</div>
            </div>
        </div>
        <div class="modal-footer">          
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade km-ff-asap" id="ubahEmail" tabindex="-1" aria-labelledby="modalEditEmail" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('ubah-biodata', Auth::user()->username)}}" method="POST">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditEmail">Ubah Email</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">                            
            <div class="mb-3">
                <label for="editEmail" class="form-label km-fw-semiBold">Email</label>
                <input type="email" name="ubahEmail" class="form-control" id="editEmail" aria-describedby="emailUser" value="{{Auth::user()->email}}">
                <div id="emailUser" class="form-text">Pastikan email anda sudah benar.</div>
            </div>  
        </div>
        <div class="modal-footer">          
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade km-ff-asap" id="ubahNoTelp" tabindex="-1" aria-labelledby="modalEditNoTelp" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('ubah-biodata', Auth::user()->username)}}" method="POST">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditNoTelp">Nomor Telepon</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="editNoTelp" class="form-label km-fw-semiBold">Nomor Telepon</label>
                <input type="text" name="ubahNoTelp" class="form-control" id="editNoTelp" aria-describedby="noTelp" value="{{Auth::user()->notelp}}">
                <div id="noTelp" class="form-text">Pastikan nomor telepon anda sudah benar.</div>
            </div>                                        
        </div>
        <div class="modal-footer">          
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade km-ff-asap" id="resetPassword" tabindex="-1" aria-labelledby="modalResetPassword" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('reset-password')}}" method="POST">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalResetPassword">Reset Password</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="editNoTelp" class="form-label km-fw-semiBold">Password Saat Ini</label>
                <input type="password" name="currentPassword" class="form-control" id="currentPassword" minlength="6" maxlength="15" aria-describedby="currentPassword">                
                @error('currentPassword')
                    <div class="form-text text-danger">Password tidak sama.</div>
                @else
                    <div id="currentPassword" class="form-text">Harus sama dengan password anda saat ini.</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="editNoTelp" class="form-label km-fw-semiBold">Masukkan Password Baru</label>
                <input type="password" name="newPassword" class="form-control" id="newPassword" minlength="6" maxlength="15" aria-describedby="newPassword">
                <div id="noTelp" class="form-text">Jangan gunakan password yang sama seperti sebelumnya.</div>
            </div>
            
            <div class="mb-3">
                <label for="editNoTelp" class="form-label km-fw-semiBold">Konfirmasi Password</label>
                <input type="password" name="confirmNewPassword" class="form-control" minlength="6" maxlength="15" aria-describedby="confirmNewPassword">
            </div>
        </div>
        <div class="modal-footer">          
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
</div>

{{-- End Modal Section --}}


<div class="container position-relative km-ff-asap mt-4 px-5">


    {{-- Validation/Notification Section --}}

    @if (session('success'))
    <div class="toast-container top-0 end-0 p-3">
        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">
                {{ session('success') }}
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>
    @endif


    @error('profilePic')
    <div class="toast-container top-0 end-0 p-3">
        <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
                Foto anda terdapat kesalahan. Mohon dicek kembali.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>
    @enderror


    @error('ubahNama')
    <div class="toast-container top-0 end-0 p-3">
        <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
                Maksimal 50 karakter. Mohon dicek kembali.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>
    @enderror


    @error('ubahUsername')
    <div class="toast-container top-0 end-0 p-3">
        <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
                Username yang anda masukkan sudah diambil. Harap masukkan kembali.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>
    @enderror


    @error('ubahEmail')
    <div class="toast-container top-0 end-0 p-3">
        <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
                Email yang anda masukkan sudah diambil. Harap masukkan kembali.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>
    @enderror


    @error('resetPasswordError')
    <div class="toast-container top-0 end-0 p-3">
        <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
                Reset password invalid. Silahkan masukkan kembali.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>
    @enderror


    @error('currentPassword')
    <div class="toast-container top-0 end-0 p-3">
        <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
                Password tidak sama. Silahkan masukkan kembali.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>
    @enderror


    @if (session('resetPasswordSuccess'))
    <div class="toast-container top-0 end-0 p-3">
        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">
                {{ session('resetPasswordSuccess') }}
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>
    @endif

    {{-- End Validation/Notification Section --}}



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
                    <a href="javascript:void(0)" class="px-4 py-2 km-fw-semiBold text-km-primary">Biodata Anda</a>
                    <a href="{{ route('daftar-transaksi') }}" class="d-block px-4 py-2 km-fw-semiBold text-km-gray-100">Transaksi Anda</a>
                </div>
                <hr class="m-0">
                <div class="row row-cols-1 row-cols-lg-2">
                    <div class="col-lg-4">
                        <form action="{{route('ubah-biodata', Auth::user()->username)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="m-3 p-3 bg-white rounded-3 border border-gray-500 shadow-sm">
                            @if (Auth::user()->foto_profile == null)
                                <span id="txtImage">Tidak ada foto profile.</span>
                                <img src="" alt="Your Profile" id="previewImage" class="img-fluid" style="max-height: 300px;" hidden>
                            @else
                                <img src="{{asset('images/profile/'.Auth::user()->foto_profile)}}" alt="Your Profile" class="img-fluid" id="previewImage" style="max-height: 300px;">
                            @endif
                            
                            <div class="d-grid gap-2 mt-3">
                                <label for="editProfilePic" class="btn btn-outline-km-primary rounded-2 km-fw-medium fs-7">
                                    Pilih Foto
                                    <input name="profilePic" type="file" id="editProfilePic" accept="image/png, image/jpeg, image/jpg" max="10MB" hidden>
                                </label>                                                         
                            </div>
                            <div class="fs-8 mt-2 text-km-gray-100">
                                Besar file: maksimum 10.000.000 bytes (10 Megabytes). Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG
                            </div>
                        </div>
                        <div class="d-grid gap-2 m-3">
                            <button class="btn btn-primary fs-7" type="submit">Simpan Foto Profile</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-lg-7 m-3">
                        <div class="mt-4 km-fw-semiBold text-km-gray-100">Ubah Biodata</div>
                        <div class="">
                            <dl class="row gy-1 ms-1 mt-1 fs-7">
                                <dt class="col-md-3 km-fw-medium">Username</dt>
                                <dd class="col-md-8 p-0">
                                    {{ Auth::user()->username }}
                                    <button class="text-km-primary ms-2" data-bs-toggle="modal" data-bs-target="#ubahUsername">Ubah Username</button>
                                </dd>                                


                                <dt class="col-md-3 km-fw-medium">Nama</dt>
                                <dd class="col-md-8 p-0">
                                    {{ Auth::user()->nama_user }}
                                    <button class="text-km-primary ms-2" data-bs-toggle="modal" data-bs-target="#ubahNama">Ubah</button>
                                </dd>                                                               
            

                                @php
                                    setlocale(LC_TIME, 'id_ID');
                                    $date=date_create(Auth::user()->tgl_lahir);
                                @endphp
                                <dt class="col-md-3 km-fw-medium">Tanggal Lahir</dt>
                                <dd class="col-md-8 p-0">
                                    @if (Auth::user()->tgl_lahir == null)
                                        <button class="text-km-primary ms-2" data-bs-toggle="modal" data-bs-target="#ubahTglLahir">Masukkan tanggal lahir anda.</button>
                                    @else
                                        {{ strftime("%d %B %Y", strtotime(date_format($date, "Y-m-d"))) }}
                                        <button class="text-km-primary ms-2" data-bs-toggle="modal" data-bs-target="#ubahTglLahir">Ubah Tgl Lahir</button>
                                    @endif                                    
                                </dd>                                                    
                            </dl>
                        </div>

                        <div class="mt-4 km-fw-semiBold text-km-gray-100">Ubah Kontak</div>
                        <div class="">
                            <dl class="row gy-1 ms-1 mt-1 fs-7">
                                <dt class="col-md-3 km-fw-medium">Email</dt>
                                <dd class="col-md-8 p-0 me-2">
                                    {{ Auth::user()->email }}
                                    <button class="text-km-primary ms-2" data-bs-toggle="modal" data-bs-target="#ubahEmail">Ubah</button>
                                </dd>                                                               
            
                                
                                <dt class="col-md-3 km-fw-medium">No. Telepon</dt>
                                <dd class="col-md-8 p-0">
                                    {{ Auth::user()->notelp }}
                                    <button class="text-km-primary ms-2" data-bs-toggle="modal" data-bs-target="#ubahNoTelp">Ubah</button>
                                </dd>
                                
                                
                                <dt class="col-8 col-md-7 km-fw-medium mt-3">
                                    <button class="btn btn-warning text-white km-fw-medium px-4" data-bs-toggle="modal" data-bs-target="#resetPassword">Reset Password</button>
                                </dt>
                            </dl>
                        </div>
                    </div>                                       
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('input', '#editNoTelp', function() {
        let inputValue = $(this).val().toString();
        const maxLength = 13;
        
        if (inputValue.length > maxLength) {
            inputValue = inputValue.slice(0, maxLength);
            $(this).val(inputValue);
        }
    });

    $(document).on('input', '#editNama', function() {
        const sanitizedValue = $(this).val().replace(/[^a-zA-Z]/g, '');
        $(this).val(sanitizedValue);
    });



    document.addEventListener('DOMContentLoaded', function() {
      document.title = "Profile - {{Auth::user()->username}}";
    });
</script>

@endsection