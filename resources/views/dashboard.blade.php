@extends('layouts.app')

@section('title', 'Beranda')

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

    {{-- Banner Ringkasan Hari Ini - Warna Presisi Sama Persis Dengan Halaman Login & Efek Glassmorphism --}}
    <div class="card border-0 shadow-sm mb-4 position-relative overflow-hidden rounded-4" 
         style="background: linear-gradient(135deg, rgba(255, 182, 193, 0.65) 0%, rgba(248, 187, 208, 0.75) 100%); backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.8) !important;">

        <div class="card-body p-4 p-md-5 d-flex align-items-center justify-content-between position-relative z-index-1">
            
            {{-- Sisi Kiri: Judul, Subtitle, & Tombol Tanggal --}}
            <div class="pe-md-4 text-start">
                <h1 class="fw-bold mb-2" style="color: #880e4f; font-family: 'Comic Sans MS', 'Bubblegum Sans', cursive, sans-serif; letter-spacing: 0.5px; font-size: 2.2rem;">
                    Ringkasan Hari Ini
                </h1>
                <p class="mb-4 fw-semibold text-white" style="opacity: 0.95; font-size: 1.05rem;">
                    Pantau kinerja penjualan dan stok sepatu kamu hari ini 
                </p>

                <div class="d-flex flex-wrap gap-2 align-items-center">
                    {{-- Badge Tanggal Style Putih Bersih --}}
                    <span class="btn btn-light fw-bold px-4 py-2 shadow-sm rounded-pill border-0 d-inline-flex align-items-center" 
                          style="color: #880e4f; font-size: 0.9rem; background-color: #ffffff;">
                        <i class="fas fa-calendar-alt me-2"></i> {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>

            {{-- Sisi Kanan: Ilustrasi Estetik ala Kucing --}}
            <div class="d-none d-md-block text-end position-relative">
                <div class="bg-white p-2 rounded-4 shadow-sm d-inline-block" style="transform: rotate(3deg);">
                    <div class="rounded-3 overflow-hidden" style="width: 90px; height: 90px; background-color: #fce4ec; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#f48fb1" class="bi bi-bag-heart-fill" viewBox="0 0 16 16">
                            <path d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @can('viewAny', App\Models\User::class)
    <div class="mb-3">
        <h5 class="fw-bold mb-0 text-start" style="color: #880e4f;">Penjualan Hari Ini</h5>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden" 
                 style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-left: 6px solid #f48fb1 !important;">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Total Nilai Penjualan Hari Ini</span>
                        <h3 class="fw-bold mb-0" style="color: #880e4f;">Rp {{ number_format($ringkasan['total_penjualan']) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden" 
                 style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-left: 6px solid #ab47bc !important;">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Jumlah Transaksi Hari Ini</span>
                        <h3 class="fw-bold mb-0" style="color: #ab47bc;">{{ number_format($ringkasan['total_transaksi']) }} <span class="fs-6 text-muted fw-normal">Transaksi</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <h5 class="fw-bold mb-0 text-start" style="color: #880e4f;">Status Pembayaran Tunai & QRIS</h5>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden" 
                 style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-left: 6px solid #81c784 !important;">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Total Pembayaran Tunai</span>
                        <h3 class="fw-bold text-success mb-0">Rp {{ number_format($ringkasan['total_cash']) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden" 
                 style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-left: 6px solid #ffb74d !important;">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Total Pembayaran Non-Tunai</span>
                        <h3 class="fw-bold text-warning mb-0" style="color: #ff9800 !important;">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <div class="mb-3">
        <h5 class="fw-bold mb-0 text-start" style="color: #880e4f;">Status Inventaris Kritis</h5>
    </div>

    {{-- Stok Rendah --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 p-4" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px);">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-warning mb-0">Daftar Produk Stok Rendah</h6>
        </div>

        <div class="row g-3">
            @forelse ($produkStokRendah as $produk)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="background-color: #ffffff; border: 1px solid #f8d7da !important;">
                        <div class="position-relative p-3 pb-0 text-center">
                            <span class="badge position-absolute top-0 end-0 m-4 px-3 py-2 rounded-pill text-dark fw-bold" style="background-color: #ffc107; z-index: 10; font-size: 0.8rem;">
                                Stok: {{ $produk->stok }}
                            </span>
                            <div class="rounded-3 overflow-hidden bg-light shadow-sm" style="height: 180px;">
                                <img src="{{ !empty($produk->foto) ? asset('storage/' . $produk->foto) : 'https://cdn-icons-png.flaticon.com/512/2589/2589901.png' }}" 
                                     onerror="this.onerror=null;this.src='https://cdn-icons-png.flaticon.com/512/2589/2589901.png';" 
                                     alt="{{ $produk->nama }}" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>

                        <div class="card-body p-3 bg-white d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-2 text-truncate" title="{{ $produk->nama }}">
                                    {{ $produk->nama }}
                                </h6>
                                <h5 class="fw-bold mb-3" style="color: #880e4f;">
                                    Rp {{ number_format($produk->harga_jual ?? $produk->harga ?? 0, 0, ',', '.') }}
                                </h5>
                            </div>
                            <div class="pt-2">
                                <a href="{{ isset($produk->id) ? route('produk.show', $produk->id) : '#' }}" 
                                   class="btn btn-sm w-100 rounded-pill fw-semibold border-0 py-2" 
                                   style="background-color: #fce4ec; color: #880e4f;">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">
                    Seluruh produk berada dalam kondisi stok aman.
                </div>
            @endforelse
        </div>
    </div>

    {{-- Produk Habis Stok --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 p-4" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px);">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-danger mb-0">Produk Habis Stok</h6>
            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2"></span>
        </div>

        <div class="row g-3">
            @forelse ($produkStokHabis as $produk)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="background-color: #ffffff; border: 1px solid #e2e8f0 !important;">
                        <div class="position-relative p-3 pb-0 text-center">
                            <span class="badge position-absolute top-0 end-0 m-4 px-3 py-2 rounded-pill bg-secondary text-white fw-bold" style="z-index: 10; font-size: 0.8rem;">
                                Stok: 0
                            </span>
                            <div class="rounded-3 overflow-hidden bg-light shadow-sm" style="height: 180px;">
                                <img src="{{ !empty($produk->foto) ? asset('storage/' . $produk->foto) : 'https://cdn-icons-png.flaticon.com/512/2589/2589901.png' }}" 
                                     onerror="this.onerror=null;this.src='https://cdn-icons-png.flaticon.com/512/2589/2589901.png';" 
                                     alt="{{ $produk->nama }}" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>

                        <div class="card-body p-3 bg-white d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-2 text-truncate" title="{{ $produk->nama }}">
                                    {{ $produk->nama }}
                                </h6>
                                <h5 class="fw-bold mb-3" style="color: #880e4f;">
                                    Rp {{ number_format($produk->harga_jual ?? $produk->harga ?? 0, 0, ',', '.') }}
                                </h5>
                            </div>
                            <div class="pt-2">
                                <a href="{{ isset($produk->id) ? route('produk.show', $produk->id) : '#' }}" 
                                   class="btn btn-sm w-100 rounded-pill fw-semibold border-0 py-2" 
                                   style="background-color: #fce4ec; color: #880e4f;">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">
                    Tidak ada produk yang habis stok.
                </div>
            @endforelse
        </div>
    </div>

    <div class="mb-3">
        <h5 class="fw-bold mb-0 text-start" style="color: #880e4f;">Produk Terlaris</h5>
    </div>

    {{-- Produk Paling Laris --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 p-4" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px);">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="color: #880e4f;">Produk Paling Laris</h6>
            <span class="badge rounded-pill px-3 py-2" style="background-color: #fce4ec; color: #880e4f;"></span>
        </div>

        <div class="row g-3">
            @forelse ($produkTerlaris as $produk)
                @php
                    $detailProduk = $produk->produk ?? $produk;
                @endphp
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="background-color: #ffffff; border: 1px solid #e9d5ff !important;">
                        <div class="position-relative p-3 pb-0 text-center">
                            <span class="badge position-absolute top-0 start-0 m-4 px-3 py-2 rounded-pill text-white fw-bold shadow-sm" style="background-color: #8b5cf6; z-index: 10; font-size: 0.8rem;">
                                Terjual: {{ number_format($produk->total_terjual ?? 0) }}
                            </span>
                            
                            <div class="rounded-3 overflow-hidden bg-light shadow-sm" style="height: 180px;">
                                <img src="{{ !empty($detailProduk->foto) ? asset('storage/' . $detailProduk->foto) : 'https://cdn-icons-png.flaticon.com/512/2589/2589901.png' }}" 
                                     onerror="this.onerror=null;this.src='https://cdn-icons-png.flaticon.com/512/2589/2589901.png';" 
                                     alt="{{ $detailProduk->nama ?? 'Produk' }}" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>

                        <div class="card-body p-3 bg-white d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-2 text-truncate" title="{{ $detailProduk->nama ?? '-' }}">
                                    {{ $detailProduk->nama ?? 'Nama Produk' }}
                                </h6>
                                <h5 class="fw-bold mb-3" style="color: #880e4f;">
                                    Rp {{ number_format($detailProduk->harga_jual ?? $detailProduk->harga ?? 0, 0, ',', '.') }}
                                </h5>
                            </div>
                            <div class="pt-2">
                                <a href="{{ isset($detailProduk->id) ? route('produk.show', $detailProduk->id) : '#' }}" 
                                   class="btn btn-sm w-100 rounded-pill fw-semibold border-0 py-2" 
                                   style="background-color: #fce4ec; color: #880e4f;">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">
                    Belum ada data produk terlaris.
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection