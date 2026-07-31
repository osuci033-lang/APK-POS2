@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    {{-- Header Banner Biru Lucu --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 text-white" 
         style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-primary fw-bold mb-2 rounded-pill px-3 py-2 shadow-sm">
                    👥 User Management
                </span>
                <h2 class="fw-bold mb-1">
                    Halaman Users 👤
                </h2>
                <p class="mb-0 opacity-75">
                    Daftar akun pengguna dan pengelola sistem POS
                </p>
            </div>
            <div class="d-none d-md-block fs-1 opacity-75 me-3">
                🔑 🛡️ 💼
            </div>
        </div>
    </div>

    {{-- Alert Notifikasi (Sukses / Error) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            🎉 <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            ⚠️ <strong>Gagal!</strong> {{ session('error') }}
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
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary fw-bold px-4 py-2 rounded-3 shadow-sm d-inline-flex align-items-center" style="letter-spacing: 0.3px;">
                        <i class="bi bi-person-plus-fill me-2 fs-5"></i> + Create User Baru
                    </a>
                </div>

                {{-- Form Pencarian --}}
                <div class="col-12 col-md-5 col-lg-4">
                    <form action="{{ route('admin.users') }}" method="GET">
                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-end-0 py-2 fst-italic"
                                placeholder="Search username or email..."
                                style="font-size: 0.95rem;"
                            >
                            <button class="btn btn-primary px-3 fw-semibold" type="submit">
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
                            
                            {{-- Name dengan Inisial Avatar Bulat --}}
                            <td class="fw-semibold text-dark">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold shadow-sm" style="width: 35px; height: 35px; font-size: 0.9rem;">
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
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold rounded-pill px-3 py-2">
                                        👑 {{ $user->role->name }}
                                    </span>
                                @else
                                    <span class="badge bg-info bg-opacity-10 text-info fw-bold rounded-pill px-3 py-2">
                                        🏷️ {{ $user->role->name }}
                                    </span>
                                @endif
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm fw-semibold rounded-3 px-3 shadow-sm text-dark">
                                        ✏️ Edit Akun
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger fw-semibold rounded-3 px-3 shadow-sm" onclick="return confirm('Yakin hapus user ini?')">
                                            🗑️ Hapus
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