<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('csrf')
    <title>@yield('titleHalaman')</title>

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- Select2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Comfortaa:wght@300;400;500;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{asset('FontAwesome/css/all.css')}}">

    {{-- myCss --}}
    <link rel="stylesheet" href="{{asset('src/css/style.css')}}">
</head>
<body>
    <div class="vertical-nav navbar-dark km-ff-asap bg-primary" id="km-sidebar">
        <div class="text-center py-4">
            <a href="#" class="navbar-brand fs-5 text-white km-ff-comfortaa fw-bold">KiosManga Admin</a>
        </div>

        <ul class="flex-column navbar-nav mb-0">
            <li class="nav-item km-bg-blue">
                <a href="{{ route('dashboard-admin') }}" class="fw-bold text-uppercase px-3 d-block pb-2 pt-3 nav-link @yield('Dashboard')">
                    <i class="fa-solid fa-gauge-high me-2"></i>
                    Dashboard
                </a>
            </li>
        </ul>

        <p class="fw-bold text-uppercase px-3 text-white-50 pb-2 pt-3">Data Master</p>
        <ul class="flex-column navbar-nav ms-4 mb-0">
            <li class="nav-item km-bg-blue">
                <a href="{{route('all-manga')}}" class="nav-link km-fw-medium @yield('Manga')">
                    <i class="fa-solid fa-books me-3"></i>
                    &nbsp;Manga
                </a>
            </li>
            <li class="nav-item km-bg-blue">
                <a href="{{route('all-mangaka')}}" class="nav-link km-fw-medium @yield('Mangaka')">
                    <i class="fa-solid fa-pen-swirl me-3"></i>
                    &nbsp;Mangaka
                </a>
            </li>
            <li class="nav-item km-bg-blue">
                <a href="{{route('all-penerbit')}}" class="nav-link km-fw-medium @yield('Penerbit')">
                    <i class="fa-brands fa-product-hunt me-3"></i>
                    &nbsp;Penerbit
                </a>
            </li>
            <li class="nav-item km-bg-blue">
                <a href="{{route('all-user')}}" class="nav-link km-fw-medium @yield('Pengguna')">
                    <i class="fa-solid fa-user-large me-3"></i>
                    &nbsp;Pengguna
                </a>
            </li>
            <li class="nav-item km-bg-blue">
                <a href="{{route('all-genre')}}" class="nav-link km-fw-medium @yield('Genre')">
                    <i class="fa-regular fa-list-dropdown me-3"></i>
                    &nbsp;Genre
                </a>
            </li>
        </ul>

        <p class="fw-bold text-uppercase px-3 text-white-50 pb-2 pt-4">Data Transaksi</p>
        <ul class="flex-column navbar-nav ms-4 mb-0">
            <li class="nav-item km-bg-blue">
                <a href="{{ route('all-keranjang') }}" class="nav-link km-fw-medium @yield('Keranjang')">
                    <i class="fa-solid fa-cart-shopping me-3"></i>
                    &nbsp;Keranjang
                </a>
            </li>
            <li class="nav-item km-bg-blue">
                <a href="{{ route('all-pembelian') }}" class="nav-link km-fw-medium @yield('Pembelian')">
                    <i class="fa-solid fa-list-check me-3"></i>
                    &nbsp;Pembelian
                </a>
            </li>
            <li class="nav-item km-bg-blue">
                <a href="{{ route('all-transaksi') }}" class="nav-link km-fw-medium @yield('Transaksi')">
                    <i class="fa-solid fa-money-bill-transfer me-3"></i>
                    &nbsp;Transaksi
                </a>
            </li>
        </ul>

        <p class="fw-bold text-uppercase px-3 text-white-50 pb-2 pt-4">Aksi</p>
        <ul class="flex-column navbar-nav ms-4 mb-0">
            <li class="nav-item km-bg-blue">
                <a href="{{ route('logout') }}" class="nav-link km-fw-medium @yield('Keranjang')">
                    <i class="fa-solid fa-arrow-up-left-from-circle me-3"></i>
                    &nbsp;Logout
                </a>
            </li>
        </ul>
    </div>
    @yield('modalTambah')
    @yield('modalEdit')
    @yield('konten')

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

    {{-- Flatpickr --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    
    {{-- myJS --}}
    <script src="{{asset('src/js/script.js')}}"></script>
    @yield('js')

    {{-- Bootstrap JS --}}
    <script src="{{asset('/Bootstrap/dist/js/bootstrap.bundle.js')}}"></script>

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    {{-- Sweetalert JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</body>
</html>