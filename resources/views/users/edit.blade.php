@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    {{-- Form Container Card --}}
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-6">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body p-4 p-md-5">
                    
                    {{-- Header Judul Kecil & Pas Selebar Form --}}
                    <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom">
                        <div>
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-bold mb-1 rounded-pill px-3 py-1" style="font-size: 0.75rem;">
                                ✏️ Edit User
                            </span>
                            <h5 class="fw-bold text-dark mb-0">
                                Edit Data User 👤
                            </h5>
                        </div>
                        <div class="fs-4">
                            🛠️
                        </div>
                    </div>

                    {{-- Form Update --}}
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('POST')
                        
                        <div class="row g-3">
    
                            {{-- Input Nama --}}
                            <div class="col-12 text-start">
                                <label class="form-label fw-semibold text-dark small mb-1">
                                    Nama <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-primary border-end-0 rounded-start-3">
                                        👤
                                    </span>
                                    <input type="text" 
                                           name="name" 
                                           class="form-control py-2 fst-italic @error('name') is-invalid @enderror rounded-end-3" 
                                           placeholder="Masukkan nama lengkap Anda" 
                                           value="{{ old('name', $user->name ?? '') }}">
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block mt-1 small text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Input Email --}}
                            <div class="col-12 text-start">
                                <label class="form-label fw-semibold text-dark small mb-1">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-primary border-end-0 rounded-start-3">
                                        ✉️
                                    </span>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control py-2 fst-italic @error('email') is-invalid @enderror rounded-end-3" 
                                           placeholder="contoh@domain.com" 
                                           value="{{ old('email', $user->email ?? '') }}">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block mt-1 small text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Input Password --}}
                            <div class="col-12 text-start">
                                <label class="form-label fw-semibold text-dark small mb-1">
                                    Password 
                                    <small class="text-muted fw-normal">(Kosongkan jika tidak diubah)</small>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-primary border-end-0 rounded-start-3">
                                        🔑
                                    </span>
                                    <input type="password" 
                                           name="password" 
                                           class="form-control py-2 fst-italic @error('password') is-invalid @enderror rounded-end-3" 
                                           placeholder="Masukan password baru...">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block mt-1 small text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Select Role --}}
                            <div class="col-12 text-start mb-2">
                                <label class="form-label fw-semibold text-dark small mb-1">
                                    Role / Hak Akses <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-primary border-end-0 rounded-start-3">
                                        🛡️
                                    </span>
                                    <select name="role_id" class="form-select py-2 @error('role_id') is-invalid @enderror rounded-end-3" style="cursor: pointer;">
                                        <option value="" disabled selected>-- Pilih Role --</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}>
                                                ✨ {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role_id')
                                    <div class="invalid-feedback d-block mt-1 small text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="col-12 d-flex justify-content-end gap-2 pt-3 border-top mt-4">
                                <a href="{{ route('admin.users') }}" class="btn btn-light fw-semibold px-4 rounded-3 border">
                                    👈 Batal
                                </a>
                                <button type="submit" class="btn btn-primary fw-bold px-4 rounded-3 shadow-sm">
                                    💾 Simpan Data
                                </button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection