<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm py-2 mb-4 sticky-top" style="z-index: 1020;">
    <div class="container-fluid px-3 px-md-4">
        
        {{-- Logo & Brand --}}
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-dark me-4" href="{{ route('dashboard') }}">
            <span><span style="color: #e83e8c;">SoleStation</span> POS</span>
        </a>

        {{-- Tombol Toggle Hamburger untuk HP --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Isi Menu Navbar (Sejajar ke samping pada layar besar/Desktop) --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            {{-- Navigasi Utama (Pakai flex-row agar selalu berjajar ke samping) --}}
            <ul class="navbar-nav d-flex flex-row flex-wrap align-items-center me-auto mb-0 gap-2">
                
                {{-- Beranda --}}
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center gap-2 {{ Request::is('dashboard') ? 'active fw-bold' : 'text-secondary' }}" 
                       style="{{ Request::is('dashboard') ? 'background-color: #fce4ec; color: #d81b60 !important;' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door-fill fs-6"></i>
                        <span>Beranda</span>
                    </a>
                </li>

                {{-- Users (Khusus Admin) --}}
                @if(Auth::check() && Auth::user()->role && strtolower(is_object(Auth::user()->role) ? Auth::user()->role->name : Auth::user()->role) === 'admin')
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center gap-2 {{ Request::is('admin/users*') ? 'active fw-bold' : 'text-secondary' }}" 
                       style="{{ Request::is('admin/users*') ? 'background-color: #fce4ec; color: #d81b60 !important;' : '' }}"
                       href="{{ route('admin.users') }}">
                        <i class="bi bi-person-fill fs-6"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
                @endif

                {{-- Produk --}}
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center gap-2 {{ Request::is('produk*') ? 'active fw-bold' : 'text-secondary' }}" 
                       style="{{ Request::is('produk*') ? 'background-color: #fce4ec; color: #d81b60 !important;' : '' }}"
                       href="{{ route('produk.index') }}">
                        <i class="bi bi-box-seam-fill fs-6"></i>
                        <span>Produk</span>
                    </a>
                </li>

                {{-- Penjualan --}}
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center gap-2 {{ Request::is('penjualan*') ? 'active fw-bold' : 'text-secondary' }}" 
                       style="{{ Request::is('penjualan*') ? 'background-color: #fce4ec; color: #d81b60 !important;' : '' }}"
                       href="{{ route('penjualan.index') }}">
                        <i class="bi bi-cart-fill fs-6"></i>
                        <span>Penjualan</span>
                    </a>
                </li>

                {{-- Tentang --}}
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 d-flex align-items-center gap-2 {{ Request::is('tentang*') ? 'active fw-bold' : 'text-secondary' }}" 
                       style="{{ Request::is('tentang*') ? 'background-color: #fce4ec; color: #d81b60 !important;' : '' }}"
                       href="{{ route('tentang.index') }}">
                        <i class="bi bi-info-circle-fill fs-6"></i>
                        <span>Tentang</span>
                    </a>
                </li>

            </ul>

            {{-- Info User & Logout (Juga sejajar ke samping) --}}
            <div class="d-flex align-items-center gap-3 ms-auto mt-2 mt-lg-0">
                
                {{-- User Info --}}
                <div class="d-flex align-items-center gap-2 text-secondary small">
                    <i class="bi bi-person-circle fs-5"></i>
                    <span>
                        {{ is_object(Auth::user()->role) ? Auth::user()->role->name : (Auth::user()->role ?? 'Admin') }}: 
                        <strong class="text-dark">{{ Auth::user()->name }}</strong> 
                    </span>
                </div>

                {{-- Tombol Logout --}}
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm fw-bold px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2" 
                            style="color: #d81b60; border-color: #f8bbd0; background-color: #fff0f5;" 
                            onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                        <i class="bi bi-box-arrow-right fs-6"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>