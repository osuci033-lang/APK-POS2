@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    {{-- Banner Ringkasan Hari Ini - Warna Presisi Sama Persis Dengan Halaman Login --}}
    <div class="card border-0 shadow-sm mb-4 position-relative overflow-hidden" 
         style="background-color: #ffb2cc; border-radius: 28px;">
        <div class="card-body p-4 p-md-5 d-flex align-items-center justify-content-between position-relative z-index-1">
            
            {{-- Sisi Kiri: Judul, Subtitle, & Tombol Tanggal --}}
            <div class="pe-md-4">
                <h1 class="fw-bold mb-2 text-white" style="font-size: 2.2rem; letter-spacing: -0.5px;">
                    Ringkasan Hari Ini
                </h1>
                <p class="mb-4 fw-semibold" style="color: #ffffff; opacity: 0.95; font-size: 1.05rem;">
                    Pantau kinerja penjualan dan stok sepatu kamu hari ini 
                </p>

                <div class="d-flex flex-wrap gap-2 align-items-center">
                    {{-- Badge Tanggal Style Putih Bersih --}}
                    <span class="btn btn-light fw-bold px-4 py-2 shadow-sm rounded-pill border-0 d-inline-flex align-items-center" 
                          style="color: #ff5e83; font-size: 0.9rem; background-color: #ffffff;">
                        <i class="fas fa-calendar-alt me-2"></i> {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>

            {{-- Sisi Kanan: Foto Sepatu Estetik Pink/Pastel --}}
            <div class="d-none d-md-block text-end position-relative" style="max-width: 260px;">
                <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=500&auto=format&fit=crop" 
                     alt="Shoes Banner" 
                     class="img-fluid rounded-4 shadow-sm"
                     style="max-height: 160px; object-fit: cover; border: 4px solid #ffffff;">
            </div>

        </div>
    </div>

    @can('viewAny', App\Models\User::class)
    <div class="mb-3">
        <h5 class="fw-bold text-dark mb-0">Penjualan Hari Ini</h5>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white position-relative overflow-hidden" style="border-left: 5px solid #ff758c !important;">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Total Nilai Penjualan Hari Ini</span>
                        <h3 class="fw-bold mb-0" style="color: #d81b60;">Rp {{ number_format($ringkasan['total_penjualan']) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white position-relative overflow-hidden" style="border-left: 5px solid #0d6efd !important;">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Jumlah Transaksi Hari Ini</span>
                        <h3 class="fw-bold mb-0 text-dark">{{ number_format($ringkasan['total_transaksi']) }} <span class="fs-6 text-muted fw-normal">Transaksi</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <h5 class="fw-bold text-dark mb-0">Status Pembayaran Tunai & QRIS</h5>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white position-relative overflow-hidden" style="border-left: 5px solid #198754 !important;">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Total Pembayaran Tunai</span>
                        <h3 class="fw-bold text-success mb-0">Rp {{ number_format($ringkasan['total_cash']) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white position-relative overflow-hidden" style="border-left: 5px solid #ffc107 !important;">
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
        <h5 class="fw-bold text-dark mb-0">Status Inventaris Kritis</h5>
    </div>

    {{-- Stok Rendah --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4 p-4">
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
                                <h5 class="fw-bold mb-3" style="color: #d81b60;">
                                    Rp {{ number_format($produk->harga_jual ?? $produk->harga ?? 0, 0, ',', '.') }}
                                </h5>
                            </div>
                            <div class="pt-2">
                                <a href="{{ isset($produk->id) ? route('produk.show', $produk->id) : '#' }}" 
                                   class="btn btn-sm w-100 rounded-pill fw-semibold border-0 py-2" 
                                   style="background-color: #e0f7fa; color: #00838f;">
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
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4 p-4">
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
                                <h5 class="fw-bold mb-3" style="color: #d81b60;">
                                    Rp {{ number_format($produk->harga_jual ?? $produk->harga ?? 0, 0, ',', '.') }}
                                </h5>
                            </div>
                            <div class="pt-2">
                                <a href="{{ isset($produk->id) ? route('produk.show', $produk->id) : '#' }}" 
                                   class="btn btn-sm w-100 rounded-pill fw-semibold border-0 py-2" 
                                   style="background-color: #e0f7fa; color: #00838f;">
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
        <h5 class="fw-bold text-dark mb-0">Produk Terlaris</h5>
    </div>

    {{-- Produk Paling Laris --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="color: #6f42c1;">Produk Paling Laris</h6>
            <span class="badge rounded-pill px-3 py-2" style="background-color: #f3e8ff; color: #6f42c1;"></span>
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
                                <h5 class="fw-bold mb-3" style="color: #d81b60;">
                                    Rp {{ number_format($detailProduk->harga_jual ?? $detailProduk->harga ?? 0, 0, ',', '.') }}
                                </h5>
                            </div>
                            <div class="pt-2">
                                <a href="{{ isset($detailProduk->id) ? route('produk.show', $detailProduk->id) : '#' }}" 
                                   class="btn btn-sm w-100 rounded-pill fw-semibold border-0 py-2" 
                                   style="background-color: #f3e8ff; color: #6f42c1;">
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