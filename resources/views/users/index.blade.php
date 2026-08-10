@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">
    <div class="card border-0 shadow-sm rounded-4 mb-4 text-white" 
         style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">
                    Halaman Users 
                </h2>
                <p class="mb-0 opacity-75">
                    Daftar akun pengguna dan pengelola sistem POS
                </p>
            </div>
        </div>
    </div>

    {{-- Alert Notifikasi (Sukses / Error) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
             <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
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
                    <a href="{{ route('admin.users.create') }}" class="btn fw-bold px-4 py-2 rounded-pill shadow-sm d-inline-flex align-items-center text-white" style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); border: none; letter-spacing: 0.3px;">
                        <i class="bi bi-person-plus-fill me-2 fs-5"></i>  Tambah Pengguna Baru
                    </a>
                </div>

                {{-- Form Pencarian --}}
                <div class="col-12 col-md-5 col-lg-4">
                    <form action="{{ route('admin.users') }}" method="GET">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden border" style="border-color: #f8bbd0 !important;">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-0 py-2 px-3 fst-italic"
                                placeholder="Search username or email..."
                                style="font-size: 0.95rem; background-color: #fff0f5;"
                            >
                            <button class="btn fw-semibold text-white px-4 border-0" type="submit" style="background-color: #ff758c;">
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
                        <tr class="text-secondary small">
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
                            <td class="fw-bold text-muted">{{ $users->firstItem() + $loop->index }}</td>
                            
                            {{-- Name dengan Inisial Avatar Bulat Pink --}}
                            <td class="fw-semibold text-dark">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold shadow-sm" style="width: 38px; height: 38px; font-size: 0.95rem; background-color: #fce4ec; color: #d81b60; border: 2px solid #f8bbd0;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        {{ $user->name }}
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="text-secondary">{{ $user->email }}</td>

                            {{-- Role dengan Badge Warna Imut --}}
                            <td>
                                @if(strtolower($user->role->name) == 'admin')
                                    <span class="badge fw-bold rounded-pill px-3 py-2 shadow-sm" style="background-color: #fce4ec; color: #d81b60; border: 1px solid #f8bbd0;">
                                         {{ $user->role->name }}
                                    </span>
                                @else
                                    <span class="badge fw-bold rounded-pill px-3 py-2 shadow-sm" style="background-color: #fff0f5; color: #e83e8c; border: 1px solid #f8bbd0;">
                                         {{ $user->role->name }}
                                    </span>
                                @endif
                            </td>

                            {{-- Tombol Aksi (Super Cantik & Cutie) --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    
                                    {{-- Tombol Edit Soft Pastel Yellow/Peach --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="btn btn-sm fw-bold rounded-pill px-3 py-1 shadow-sm border-0 d-inline-flex align-items-center gap-1" 
                                       style="background-color: #fff3cd; color: #856404; transition: all 0.2s ease;"
                                       onmouseover="this.style.transform='scale(1.05)'" 
                                       onmouseout="this.style.transform='scale(1)'">
                                        <span>Edit</span>
                                    </a>

                                    {{-- Tombol Hapus Soft Pastel Pink/Red --}}
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm fw-bold rounded-pill px-3 py-1 shadow-sm border-0 d-inline-flex align-items-center gap-1" 
                                                style="background-color: #f8d7da; color: #721c24; transition: all 0.2s ease;"
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