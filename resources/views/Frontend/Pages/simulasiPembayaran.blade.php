<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Pembayaran - KiosManga</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Comfortaa:wght@300;400;500;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">


    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{asset('FontAwesome/css/all.css')}}">

    {{-- MyCss --}}
    <link rel="stylesheet" href="{{asset('src/css/style.css')}}">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="bg-km-primary justify-content-end py-1 d-none d-md-flex">
        <div><a href="#" class="text-km-lightgreen">Tentang Kami</a></div>
        <div><a href="#" class="text-km-lightgreen px-5 me-5">Kontak Kami</a></div>
    </div>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid d-flex align-items-center justify-content-center">
            <a class="navbar-brand text-center d-flex align-items-center justify-content-center" href="{{route('home')}}">
                <div class="wrapper d-inline-block km-ff-asap km-logo">
                    <div>満<span class="text-km-blue">牙</span></div>
                    <div>気<span class="text-km-blue">尾</span>素</div>
                </div>
                <div class="ms-2 km-ff-comfortaa">KiosManga</div>   
            </a>
        </div>
    </nav>
    <div class="container row row-cols-1 mx-auto justify-content-center mt-2">
        <div class="col-12 col-lg-6 px-0 bg-white rounded-2 km-ff-asap batas-pembayaran pb-2">
            <div class="border-km-left km-primary border-bottom border-km-primary ps-4 km-fw-medium text-km-primary fs-5 py-2">
                Simulasi Pembayaran dari Sisi User
            </div>
            <form method="POST" id="formSimulasi" class="px-5 py-3">
                <div class="mb-3">
                  <label class="form-label">{{$virtualAcc['bank_code']}} Virtual Account</label>
                  <input type="text" class="form-control" value="{{$virtualAcc['account_number']}}" disabled>
                </div>
                <div class="mb-3">
                  <label class="form-label">Total Pembayaran</label>
                  <input type="text" class="form-control" value="{{$virtualAcc['expected_amount']}}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Enter Amount</label>
                    <input type="number" class="form-control" name="amount" required>
                </div>


                <input type="text" name="externalId" value="{{$virtualAcc['external_id']}}" hidden>
                <button type="submit" class="btn btn-primary">Continue</button>
            </form>
        </div>
    </div>
    <div class="container-fluid bg-primary text-white text-center py-4 km-footer">
      <span>KiosManga is a property of Arieq Aqila. ©2023 All Rights Reserved.</span>
    </div>
    
    <script>
        $('#formSimulasi').submit(function (e) { 
            e.preventDefault();
            var dataSimulasi = new FormData($(this)[0])
            $.ajax({
                type: "POST",
                url: "/simulasi",
                data: dataSimulasi,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#formSimulasi').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Transfer Berhasil!',
                    });
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Transfer Gagal!',
                        text: 'Jumlah yang anda masukkan tidak sesuai dengan jumlah tagihan!'
                    });
                }
            });
        });
    </script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    {{-- Swiper JS --}}
    <script src="{{asset('Swiper/swiper-bundle.min.js')}}"></script>

    {{-- Sweetalert JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- myJS --}}
    <script src="{{asset('src/js/Frontend/FE.min.js')}}"></script>
</body>
</html>