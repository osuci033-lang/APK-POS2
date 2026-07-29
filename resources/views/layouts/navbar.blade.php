<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm py-2 mb-4">
    <div class="container-fluid px-3 px-md-4">
        
        {{-- Logo & Brand --}}
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-dark" href="{{ route('dashboard') }}">
            <span class="fs-4">👟</span>
            <span class="text-primary">SoleStation</span> POS
        </a>

        {{-- Tombol Toggle Hamburger untuk HP --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Isi Menu Navbar --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            {{-- Navigasi Utama (Kiri) --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1 mt-2 mt-lg-0">
                
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-dark d-flex align-items-center gap-1 {{ Request::is('dashboard') ? 'active bg-primary bg-opacity-10 text-primary fw-bold' : 'text-secondary' }}" 
                       aria-current="page" 
                       href="{{ route('dashboard') }}">
                        📊 <span>Dashboard</span>
                    </a>
                </li>

                {{-- Users (Admin) --}}
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-dark d-flex align-items-center gap-1 {{ Request::is('admin/users*') ? 'active bg-primary bg-opacity-10 text-primary fw-bold' : 'text-secondary' }}" 
                       href="{{ route('admin.users') }}">
                        👥 <span>Kelola Kasir</span>
                    </a>
                </li>

                {{-- Stok Sepatu / Produk --}}
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-dark d-flex align-items-center gap-1 {{ Request::is('produk*') ? 'active bg-primary bg-opacity-10 text-primary fw-bold' : 'text-secondary' }}" 
                       href="{{ route('produk.index') }}">
                        👟 <span>Katalog Sepatu</span>
                    </a>
                </li>

                {{-- Kasir / Transaksi Penjualan --}}
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-dark d-flex align-items-center gap-1 {{ Request::is('penjualan*') ? 'active bg-primary bg-opacity-10 text-primary fw-bold' : 'text-secondary' }}" 
                       href="{{ route('penjualan.index') }}">
                        🛒 <span>Kasir / Penjualan</span>
                    </a>
                </li>

            </ul>

            {{-- Info Kasir & Tombol Logout (Kanan) --}}
            <div class="d-flex align-items-center gap-3 pt-2 pt-lg-0 border-top border-lg-0 ms-auto">
                
                <span class="text-secondary small d-none d-md-inline">
                    Kasir: <strong class="text-dark">{{ Auth::user()->name ?? 'Admin' }}</strong> 👟
                </span>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm fw-bold px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-1" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                        🚪 <span>Logout</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>