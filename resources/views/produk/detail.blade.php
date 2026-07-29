@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            
            {{-- Main Detail Card --}}
            <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                
                {{-- Header Card --}}
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-bold mb-1 rounded-pill px-3 py-1" style="font-size: 0.75rem;">
                            🔎 Information
                        </span>
                        <h5 class="fw-bold text-dark mb-0">
                            Detail Produk 🛍️
                        </h5>
                    </div>
                    <div class="fs-4">
                        📦
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 align-items-center">
                        
                        {{-- Foto Produk --}}
                        <div class="col-md-5 text-center">
                            @if($produk->foto)
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $produk->foto) }}" 
                                         class="img-fluid rounded-4 shadow-sm border w-100" 
                                         alt="{{ $produk->nama }}"
                                         style="max-height: 280px; object-fit: cover;">
                                </div>
                            @else
                                <div class="bg-light text-muted rounded-4 border d-flex flex-column align-items-center justify-content-center py-5">
                                    <div class="fs-1 mb-2">🖼️</div>
                                    <small class="fw-semibold">Tidak Ada Foto</small>
                                </div>
                            @endif
                        </div>

                        {{-- Detail Informasi --}}
                        <div class="col-md-7">
                            
                            {{-- Nama Produk --}}
                            <div class="mb-3">
                                <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Nama Produk</small>
                                <h4 class="fw-bold text-dark mb-0">{{ $produk->nama }}</h4>
                            </div>

                            <hr class="my-3 opacity-25">

                            {{-- Rincian Harga & Stok --}}
                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block small">Harga Dasar (Beli)</small>
                                    <span class="fw-semibold text-secondary fs-6">
                                        Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block small">Harga Jual</small>
                                    <span class="fw-bold text-success fs-5">
                                        Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block small">Stok Tersedia</small>
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold rounded-pill px-3 py-2 mt-1">
                                        📦 {{ $produk->stok }} pcs
                                    </span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block small">Penginput Data</small>
                                    <span class="badge bg-light text-dark border fw-normal px-2 py-2 mt-1 rounded-2">
                                        👤 {{ $produk->user->name }}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Footer & Tombol Kembali --}}
                <div class="card-footer bg-light border-top p-3 d-flex justify-content-between align-items-center">
                    <a href="{{ route('produk.index') }}" class="btn btn-light fw-semibold px-4 rounded-3 border">
                        👈 Kembali ke Daftar
                    </a>
                    
                    @can('update', $produk)
                        <a href="{{ route('produk.edit', $produk) }}" class="btn btn-warning fw-bold px-4 rounded-3 shadow-sm text-dark">
                            ✏️ Edit Produk
                        </a>
                    @endcan
                </div>

            </div>

        </div>
    </div>

</div>

@endsection