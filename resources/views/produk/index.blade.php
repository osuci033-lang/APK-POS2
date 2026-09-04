@extends('layouts.app')

@section('title', 'Produk')

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

    .product-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(255, 178, 204, 0.3) !important;
    }
</style>

<div class="container-fluid py-4 px-3 px-md-4 min-vh-100" style="background-color: transparent !important;">
    
    {{-- Banner Halaman Produk - Menggunakan Warna Presisi Sama Dengan Ringkasan Hari Ini & Efek Glassmorphism --}}
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
                   Halaman Produk 
                </h1>
                <p class="mb-0 fw-semibold" style="color: #880e4f; opacity: 0.85; font-size: 1.05rem;">
                   Daftar koleksi produk dan stok sepatu yang tersedia
                </p>
            </div>
        </div>
    </div>

    {{-- Main Container --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-body p-4">
            
            {{-- Action Row: Tombol Create & Search Form --}}
            <div class="row g-3 justify-content-between align-items-center mb-4">
                <div class="col-12 col-md-auto">
                    @can('create', App\Models\Produk::class)
                        <a href="{{ route('produk.create') }}" class="btn fw-bold px-4 py-2 rounded-pill shadow-sm d-inline-flex align-items-center text-white border-0" 
                           style="background-color: #d81b60; letter-spacing: 0.3px; transition: all 0.2s ease;">
                            <i class="bi bi-plus-circle-fill me-2 fs-5"></i> Tambah Produk Baru
                        </a>
                    @endcan
                </div>

                {{-- Form Pencarian Pink Border --}}
                <div class="col-12 col-md-5 col-lg-4">
                    <form action="{{ route('produk.index') }}" method="GET">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden border" style="border-color: #ffe4e8 !important;">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-0 py-2 px-3 fst-italic"
                                placeholder="Search nama produk..."
                                style="font-size: 0.95rem; background-color: #fff5f6;"
                            >
                            <button class="btn fw-semibold text-white px-4 border-0" type="submit" style="background-color: #d81b60;">
                                🔍 Search
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            {{-- Grid Data Produk (Card Sepatu) --}}
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @forelse ($products as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card bg-white" style="border: 1px solid #ffd6e0 !important;">
                            
                            {{-- Area Foto Produk --}}
                            <div class="position-relative text-center p-3 d-flex align-items-center justify-content-center" style="height: 220px; background-color: #fff5f6;">
                                @if($product->foto)
                                    <img src="{{ asset('storage/'.$product->foto) }}"
                                         alt="{{ $product->nama }}"
                                         class="img-fluid h-100 object-fit-contain">
                                @else
                                    <div class="text-muted small">
                                        📷 No Image
                                    </div>
                                @endif

                                {{-- Badge Stok di Atas Foto --}}
                                <div class="position-absolute top-0 end-0 m-3">
                                    @if($product->stok > 10)
                                        <span class="badge fw-bold rounded-pill px-3 py-2 shadow-sm text-white" style="background-color: #20c997;">
                                            Stok: {{ $product->stok }}
                                        </span>
                                    @elseif($product->stok > 0)
                                        <span class="badge fw-bold rounded-pill px-3 py-2 shadow-sm text-dark" style="background-color: #fff2a8;">
                                            Stok: {{ $product->stok }}
                                        </span>
                                    @else
                                        <span class="badge fw-bold rounded-pill px-3 py-2 shadow-sm text-white" style="background-color: #ff4d6d;">
                                            Habis
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Informasi Produk --}}
                            <div class="card-body p-3 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="card-title fw-bold mb-2 text-truncate" style="color: #880e4f;" title="{{ $product->nama }}">
                                        {{ $product->nama }}
                                    </h6>
                                    
                                    {{-- Harga --}}
                                    <p class="card-text fw-bold fs-5 mb-3" style="color: #880e4f;">
                                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- Tombol Aksi Imut --}}
                                <div class="d-flex justify-content-between align-items-center gap-1 pt-2 border-top" style="border-color: #ffd6e0 !important;">
                                    
                                    {{-- Tombol Detail Soft Cyan Pastel --}}
                                    <a href="{{ route('produk.show', $product) }}" 
                                       class="btn btn-sm fw-bold rounded-pill flex-fill border-0 d-inline-flex justify-content-center align-items-center gap-1"
                                       style="background-color: #e0f7fa; color: #006064; transition: all 0.2s ease;"
                                       onmouseover="this.style.transform='scale(1.05)'" 
                                       onmouseout="this.style.transform='scale(1)'">
                                         <span>Detail</span>
                                    </a>

                                    {{-- Tombol Edit Soft Yellow Pastel --}}
                                    @can('update', $product)
                                        <a href="{{ route('produk.edit', $product) }}" 
                                           class="btn btn-sm fw-bold rounded-pill flex-fill border-0 d-inline-flex justify-content-center align-items-center gap-1"
                                           style="background-color: #fff2a8; color: #7a5e00; transition: all 0.2s ease;"
                                           onmouseover="this.style.transform='scale(1.05)'" 
                                           onmouseout="this.style.transform='scale(1)'">
                                             <span>Edit</span>
                                        </a>
                                    @endcan

                                    {{-- Tombol Hapus Soft Pink Pastel --}}
                                    @can('delete', $product)
                                        <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline flex-fill">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm fw-bold rounded-pill w-100 border-0 d-inline-flex justify-content-center align-items-center gap-1" 
                                                    style="background-color: #ffd6e0; color: #800020; transition: all 0.2s ease;"
                                                    onmouseover="this.style.transform='scale(1.05)'" 
                                                    onmouseout="this.style.transform='scale(1)'"
                                                    onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 w-100 text-center py-5">
                        <div class="text-muted">
                            <h6 class="fw-bold mb-1" style="color: #880e4f;">Data Produk Tidak Tersedia</h6>
                            <small>Belum ada barang yang ditambahkan atau hasil pencarian tidak ditemukan.</small>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

</div>

@endsection