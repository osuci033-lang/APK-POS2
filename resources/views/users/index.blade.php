@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')

@include('layouts.navbar')

<style>
    /* Mengatur body agar full background grid pink kucing tanpa batas putih */
    html, body {
        height: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        background-color: #fff0f5 !important;
        background-image: linear-gradient(90deg, rgba(255, 182, 193, 0.25) 2px, transparent 2px), linear-gradient(0deg, rgba(255, 182, 193, 0.25) 2px, transparent 2px) !important;
        background-size: 40px 40px !important;
        overflow-x: hidden !important;
    }
</style>

<div class="container-fluid py-4 px-3 px-md-4 min-vh-100" style="background-color: transparent !important;">
    
    {{-- Banner Halaman Users - Menggunakan Warna Presisi Sama Dengan Halaman Produk & Efek Glassmorphism --}}
    <div class="card border-0 shadow-sm mb-4 position-relative overflow-hidden rounded-4" 
         style="background: linear-gradient(135deg, rgba(255, 182, 193, 0.65) 0%, rgba(248, 187, 208, 0.75) 100%); backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.8) !important;">
        
        {{-- Hiasan Kecil ala Kucing di Pojok Banner --}}
        <div class="position-absolute" style="top: 15px; right: 20px; opacity: 0.8;">
            <div class="d-flex gap-1">
                <div style="width: 10px; height: 10px; background-color: #ffe082; border-radius: 2px;"></div>
                <div style="width: 12px; height: 12px; background-color: #ffd54f; border-radius: 2px;"></div>
            </div>
        </div>

        <div class="card-body p-4 p-md-5 d-flex justify-content-between align-items-center position-relative z-index-1">
            <div>
                <h1 class="fw-bold mb-2" style="color: #880e4f; font-family: 'Comic Sans MS', 'Bubblegum Sans', cursive, sans-serif; letter-spacing: 0.5px; font-size: 2.2rem;">
                    Halaman Pengguna
                </h1>
                <p class="mb-0 fw-semibold" style="color: #880e4f; opacity: 0.85; font-size: 1.05rem;">
                   Daftar akun pengguna dan pengelola sistem POS
                </p>
            </div>
        </div>
    </div>

    {{-- Alert Notifikasi (Sukses / Error) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
             <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
             <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Main Container Card --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-body p-4">
            
            {{-- Tombol Create & Search Form --}}
            <div class="row g-3 justify-content-between align-items-center mb-4">
                
                {{-- Tombol Tambah User --}}
                <div class="col-12 col-md-auto">
                    <a href="{{ route('admin.users.create') }}" class="btn fw-bold px-4 py-2 rounded-pill shadow-sm d-inline-flex align-items-center text-white border-0" 
                       style="background-color: #d81b60; letter-spacing: 0.3px; transition: all 0.2s ease;">
                         <i class="bi bi-person-plus-fill me-2 fs-5"></i> Tambah Pengguna Baru
                    </a>
                </div>

                {{-- Form Pencarian --}}
                <div class="col-12 col-md-5 col-lg-4">
                    <form action="{{ route('admin.users') }}" method="GET">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden border" style="border-color: #ffe4e8 !important;">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-0 py-2 px-3 fst-italic"
                                placeholder="Search username or email..."
                                style="font-size: 0.95rem; background-color: #fff5f6;"
                            >
                            <button class="btn fw-semibold text-white px-4 border-0" type="submit" style="background-color: #d81b60;">
                                🔍 Search
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            {{-- Table Data Users --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small" style="color: #880e4f;">
                            <th scope="col" class="py-3" style="width: 5%;">#</th>
                            <th scope="col" class="py-3">Name</th>
                            <th scope="col" class="py-3">Email</th>
                            <th scope="col" class="py-3">Role</th>
                            <th scope="col" class="py-3 text-center" style="width: 22%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="fw-bold" style="color: #880e4f;">{{ $users->firstItem() + $loop->index }}</td>
                            
                            {{-- Name dengan Inisial Avatar Bulat Pink --}}
                            <td class="fw-semibold text-dark">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold shadow-sm" 
                                         style="width: 38px; height: 38px; font-size: 0.95rem; background-color: #ffe4e8; color: #d81b60; border: 2px solid #ffd6e0;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        {{ $user->name }}
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="text-secondary">{{ $user->email }}</td>

                            {{-- Role Teks Pink --}}
                            <td>
                                <span class="fw-semibold text-capitalize" style="color: #d81b60;">
                                    {{ $user->role->name }}
                                </span>
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    
                                    {{-- Tombol Edit Soft Pastel Yellow --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="btn btn-sm fw-bold rounded-pill px-3 py-1 shadow-sm border-0 d-inline-flex align-items-center gap-1" 
                                       style="background-color: #fff2a8; color: #7a5e00; transition: all 0.2s ease;"
                                       onmouseover="this.style.transform='scale(1.05)'" 
                                       onmouseout="this.style.transform='scale(1)'">
                                        <span>Edit</span>
                                    </a>

                                    {{-- Tombol Hapus Soft Pastel Pink --}}
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm fw-bold rounded-pill px-3 py-1 shadow-sm border-0 d-inline-flex align-items-center gap-1" 
                                                style="background-color: #ffd6e0; color: #800020; transition: all 0.2s ease;"
                                                onmouseover="this.style.transform='scale(1.05)'" 
                                                onmouseout="this.style.transform='scale(1)'"
                                                onclick="return confirm('Yakin hapus user ini?')">
                                            <span>Hapus</span>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>

</div>

@endsection