@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden" style="border: 1px solid #f8bbd0 !important;">
                <div class="card-header bg-white p-4 d-flex align-items-center justify-content-between" style="border-bottom: 1px solid #f8bbd0 !important;">
                    <div>
                        <span class="badge fw-bold mb-1 rounded-pill px-3 py-1 shadow-sm" style="background-color: #fce4ec; color: #d81b60; font-size: 0.75rem;">
                            🔎 Information
                        </span>
                        <h5 class="fw-bold mb-0" style="color: #880e4f;">
                            Detail Produk 🛍️
                        </h5>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 align-items-center">
                        
                        {{-- Foto Produk --}}
                        <div class="col-md-5 text-center">
                            @if($produk->foto)
                                <div class="position-relative p-2 rounded-4" style="background-color: #fff0f5; border: 1px dashed #f8bbd0;">
                                    <img src="{{ asset('storage/' . $produk->foto) }}" 
                                         class="img-fluid rounded-4 shadow-sm w-100" 
                                         alt="{{ $produk->nama }}"
                                         style="max-height: 280px; object-fit: cover;">
                                </div>
                            @else
                                <div class="text-muted rounded-4 border-dashed d-flex flex-column align-items-center justify-content-center py-5" style="background-color: #fff0f5; border: 1px dashed #f8bbd0;">
                                    <div class="fs-1 mb-2">🖼️</div>
                                    <small class="fw-semibold text-pink" style="color: #d81b60;">Tidak Ada Foto</small>
                                </div>
                            @endif
                        </div>

                        {{-- Detail Informasi --}}
                        <div class="col-md-7">
                            
                            {{-- Nama Produk --}}
                            <div class="mb-3">
                                <small class="text-uppercase fw-bold d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px; color: #d81b60;">Nama Produk</small>
                                <h4 class="fw-bold text-dark mb-0">{{ $produk->nama }}</h4>
                            </div>

                            <hr class="my-3" style="border-color: #f8bbd0; opacity: 0.5;">

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
                                    <span class="fw-bold fs-5" style="color: #20c997;">
                                        Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block small">Stok Tersedia</small>
                                    <span class="badge fw-bold rounded-pill px-3 py-2 mt-1 shadow-sm" style="background-color: #e0f7fa; color: #006064;">
                                        📦 {{ $produk->stok }} pcs
                                    </span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block small">Penginput Data</small>
                                    <span class="badge fw-semibold px-3 py-2 mt-1 rounded-pill shadow-sm" style="background-color: #fce4ec; color: #880e4f;">
                                        👤 {{ $produk->user->name }}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Footer & Tombol Aksi Imut --}}
                <div class="card-footer p-3 d-flex justify-content-between align-items-center" style="background-color: #fff0f5; border-top: 1px solid #f8bbd0 !important;">
                    <a href="{{ route('produk.index') }}" 
                       class="btn fw-semibold px-4 rounded-pill shadow-sm border-0 d-inline-flex align-items-center gap-1"
                       style="background-color: #ffffff; color: #555; transition: all 0.2s ease;"
                       onmouseover="this.style.transform='scale(1.05)'" 
                       onmouseout="this.style.transform='scale(1)'">
                        👈 <span>Kembali ke Daftar</span>
                    </a>
                    
                    @can('update', $produk)
                        <a href="{{ route('produk.edit', $produk) }}" 
                           class="btn fw-bold px-4 rounded-pill shadow-sm border-0 d-inline-flex align-items-center gap-1"
                           style="background: linear-gradient(135deg, #ffc107 0%, #ffca28 100%); color: #333; transition: all 0.2s ease;"
                           onmouseover="this.style.transform='scale(1.05)'" 
                           onmouseout="this.style.transform='scale(1)'">
                            ✏️ <span>Edit Produk</span>
                        </a>
                    @endcan
                </div>

            </div>

        </div>
    </div>

</div>

@endsection