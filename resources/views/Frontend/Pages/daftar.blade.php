<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Daftar - KiosManga</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Comfortaa:wght@300;400;500;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{asset('FontAwesome/css/all.css')}}">

    {{-- MyCss --}}
    <link rel="stylesheet" href="{{asset('src/css/login.css')}}">
</head>
<body>
    <div class="login-header">
        <a href="{{route('home')}}">
            <div class="login-logo-text">
                <span id="login-logo">
                    <div>満<span>牙</span></div>
                    <div>気<span>尾</span>素</div>
                </span>
                <span id="login-title">KiosManga</span>    
            </div>
            
        </a>
    </div>
    <div class="login-card">
        <div class="card-title">Daftar akun anda</div>
        <form action="{{ route('register-store') }}" method="POST">
            {{ csrf_field() }}
            <div class="card-input">
                <label>Nama Lengkap <span style="color: #006D77; font-weight:800; font-size: 1rem;">*</span></label>
                <input type="text" id="namaLengkap" name="namaLengkap" aria-describedby="descNama" maxlength="30" required>
                @error('namaLengkap')
                    <div class="error-msg">Nama lengkap tidak valid. Silahkan masukkan kembali</div>
                @else
                    <div class="input-desc">Maksimal 30 karakter.</div>
                @enderror
            </div>


            <div class="card-input">
                <label>Username <span style="color: #006D77; font-weight:800; font-size: 1rem;">*</span></label>
                <input type="text" name="username" aria-describedby="descUsername" minlength="6" maxlength="15" required>
                @error('username')
                    <div class="error-msg">Username tidak valid atau sudah diambil. Silahkan masukkan kembali</div>
                @else
                    <div class="input-desc">Minimal 6 karakter dan maksimal 15 karakter. Username bersifat unik.</div>
                @enderror
            </div>


            <div class="card-input">
                <label>Email <span style="color: #006D77; font-weight:800; font-size: 1rem;">*</span></label>
                <input type="email" name="email" aria-describedby="descEmail" required>
                @error('email')
                    <div class="error-msg">Email tidak valid atau sudah diambil. Silahkan masukkan kembali</div>
                @else
                    <div class="input-desc">Email bersifat unik.</div>
                @enderror
            </div> 
            
            
            <div class="card-input">
                <label>Password <span style="color: #006D77; font-weight:800; font-size: 1rem;">*</span></label>
                <input type="password" name="password" aria-describedby="descPassword" minlength="6" maxlength="20" required>
                @error('password')
                    <div class="error-msg">Panjang Password minimal 8 karakter dan maksimal 20 karakter. Silahkan masukkan kembali</div>
                @else
                    <div class="input-desc">Minimal 6 karakter dan maksimal 15 karakter</div>
                @enderror
            </div>


            <div class="card-input">
                <label>Konfirmasi Password <span style="color: #006D77; font-weight:800; font-size: 1rem;">*</span></label>
                <input type="password" name="konfirmasiPassword" aria-describedby="descKonfirmasiPassword" required>
                @error('konfirmasiPassword')
                    <div class="error-msg">Password tidak sama. Silahkan masukkan kembali</div>
                @enderror
            </div>


            <div class="card-input">
                <label>No. Telepon <span style="color: #006D77; font-weight:800; font-size: 1rem;">*</span></label>
                <input type="number" id="noTelp" name="noTelp" aria-describedby="descNoTelp" required>
                @error('noTelp')
                    <div class="error-msg">No.Telepon tidak valid. Silahkan masukkan kembali</div>
                @enderror
            </div>
            
            <button type="submit" class="card-button">
                Daftar
            </button>
        </form>
        <div class="card-footer">
            Sudah punya akun? <a href="{{ route('login-page') }}">Login</a>
        </div>
    </div>

    <script>
        const maxLength = 13;
        document.getElementById('noTelp').addEventListener('input', function() {
            let inputValue = this.value.toString(); // Convert the input value to a string
            
            if (inputValue.length > maxLength) {
                inputValue = inputValue.slice(0, maxLength); // Truncate the input to the maximum length
                this.value = inputValue; // Set the modified value back to the input field
            }
        });


        document.getElementById('namaLengkap').addEventListener('input', function() {
            var sanitizedValue = this.value.replace(/[^a-zA-Z\s]/g, '');
            this.value = sanitizedValue;
        });
    </script>
</body>
</html>