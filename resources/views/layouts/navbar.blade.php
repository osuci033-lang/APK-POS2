<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm py-2 mb-4 sticky-top" style="z-index: 1020;">
    <div class="container-fluid px-3 px-md-4">
        
{{-- Logo & Brand (URL Gambar Sepatu Sneaker) --}}
<a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-dark" href="{{ route('dashboard') }}">
    <img src="https://cdn-icons-png.flaticon.com/512/5499/5499206.png" alt="Logo Sepatu" width="35" height="35">
    
    <span><span style="color: #e83e8c;">SoleStation</span> POS</span>
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
                    <a class="nav-link px-3 rounded-3 text-dark d-flex align-items-center gap-1 {{ Request::is('dashboard') ? 'active fw-bold' : 'text-secondary' }}" 
                       style="{{ Request::is('dashboard') ? 'background-color: #fce4ec; color: #d81b60 !important;' : '' }}"
                       aria-current="page" 
                       href="{{ route('dashboard') }}">
                         <span>Dashboard</span>
                    </a>
                </li>

                {{-- 🔒 Users (Hanya muncul untuk Admin) --}}
                @if(Auth::check() && Auth::user()->role && strtolower(is_object(Auth::user()->role) ? Auth::user()->role->name : Auth::user()->role) === 'admin')
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-dark d-flex align-items-center gap-1 {{ Request::is('admin/users*') ? 'active fw-bold' : 'text-secondary' }}" 
                       style="{{ Request::is('admin/users*') ? 'background-color: #fce4ec; color: #d81b60 !important;' : '' }}"
                       href="{{ route('admin.users') }}">
                         <span>Kelola Kasir</span>
                    </a>
                </li>
                @endif

                {{-- Stok Sepatu / Produk --}}
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-dark d-flex align-items-center gap-1 {{ Request::is('produk*') ? 'active fw-bold' : 'text-secondary' }}" 
                       style="{{ Request::is('produk*') ? 'background-color: #fce4ec; color: #d81b60 !important;' : '' }}"
                       href="{{ route('produk.index') }}">
                         <span>Katalog Sepatu</span>
                    </a>
                </li>

                {{-- Kasir / Transaksi Penjualan --}}
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-3 text-dark d-flex align-items-center gap-1 {{ Request::is('penjualan*') ? 'active fw-bold' : 'text-secondary' }}" 
                       style="{{ Request::is('penjualan*') ? 'background-color: #fce4ec; color: #d81b60 !important;' : '' }}"
                       href="{{ route('penjualan.index') }}">
                         <span>Kasir / Penjualan</span>
                    </a>
                </li>

            </ul>

            {{-- Info User & Tombol Logout (Kanan) --}}
            <div class="d-flex align-items-center gap-3 pt-2 pt-lg-0 border-top border-lg-0 ms-auto">
                
                <span class="text-secondary small d-none d-md-inline">
                    {{ is_object(Auth::user()->role) ? Auth::user()->role->name : (Auth::user()->role ?? 'Admin') }}: <strong class="text-dark">{{ Auth::user()->name }}</strong> 
                </span>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm fw-bold px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-1" style="color: #d81b60; border-color: #f8bbd0; background-color: #fff0f5;" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                         <span>Logout</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>