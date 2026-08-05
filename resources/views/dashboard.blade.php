@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    {{-- Banner Ringkasan Hari Ini --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 text-white overflow-hidden" style="position: relative; background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);">
        <div class="card-body p-4 d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
            <div>
                <h2 class="fw-bold mb-1">
                    Ringkasan Hari Ini 
                </h2>
                <p class="mb-0 opacity-75">
                     {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="d-none d-md-block opacity-25">
                <img src="https://cdn-icons-png.flaticon.com/512/5499/5499206.png" alt="Illustration" width="100">
            </div>
        </div>
    </div>

    @can('viewAny', App\Models\User::class)
    {{-- SECTION 1: TODAY'S SALES --}}
    <div class="mb-3">
        <h5 class="fw-bold text-dark mb-0">Today's Sales</h5>
    </div>

    <div class="row g-3 mb-4">
        {{-- Total Nilai Penjualan --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Total Nilai Penjualan Hari Ini</span>
                        <h3 class="fw-bold mb-0" style="color: #d81b60;">Rp {{ number_format($ringkasan['total_penjualan']) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jumlah Transaksi --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Jumlah Transaksi Hari Ini</span>
                        <h3 class="fw-bold mb-0" style="color: #e83e8c;">{{ number_format($ringkasan['total_transaksi']) }} <span class="fs-6 text-muted fw-normal">Transaksi</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 2: CASH & PAYMENT STATUS --}}
    <div class="mb-3">
        <h5 class="fw-bold text-dark mb-0">Cash & Payment Status</h5>
    </div>

    <div class="row g-3 mb-4">
        {{-- Total Pembayaran Tunai --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Total Pembayaran Tunai</span>
                        <h3 class="fw-bold text-success mb-0">Rp {{ number_format($ringkasan['total_cash']) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Pembayaran Non-Tunai --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Total Pembayaran Non-Tunai</span>
                        <h3 class="fw-bold text-warning mb-0">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    {{-- SECTION 3: CRITICAL INVENTORY STATUS --}}
    <div class="mb-3">
        <h5 class="fw-bold text-dark mb-0">Critical Inventory Status</h5>
    </div>

    {{-- Daftar Produk Stok Rendah --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-warning mb-0">Daftar Produk Stok Rendah</h6>
            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2">Perhatian</span>
        </div>

        <div class="row g-3">
            @forelse ($produkStokRendah as $produk)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="background-color: #fff0f5;">
                        <div class="position-relative p-3 pb-0 text-center">
                            <span class="badge position-absolute top-0 end-0 m-4 px-3 py-2 rounded-pill text-dark fw-bold" style="background-color: #ffc107; z-index: 10; font-size: 0.8rem;">
                                Stok: {{ $produk->stok }}
                            </span>
                            <div class="rounded-3 overflow-hidden bg-white shadow-sm" style="height: 200px;">
                                <img src="{{ !empty($produk->foto) ? asset('storage/' . $produk->foto) : 'https://cdn-icons-png.flaticon.com/512/2589/2589901.png' }}" 
                                     onerror="this.onerror=null;this.src='https://cdn-icons-png.flaticon.com/512/2589/2589901.png';" 
                                     alt="{{ $produk->nama }}" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>

                        <div class="card-body p-3 bg-white mt-3 rounded-bottom-4 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-2 text-truncate" title="{{ $produk->nama }}">
                                    {{ $produk->nama }}
                                </h6>
                                <h5 class="fw-bold mb-3" style="color: #d81b60;">
                                    Rp {{ number_format($produk->harga_jual ?? $produk->harga ?? 0, 0, ',', '.') }}
                                </h5>
                            </div>
                            <div class="pt-1 border-top">
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
            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">Segera Restok</span>
        </div>

        <div class="row g-3">
            @forelse ($produkStokHabis as $produk)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="background-color: #fff0f5;">
                        <div class="position-relative p-3 pb-0 text-center">
                            <span class="badge position-absolute top-0 end-0 m-4 px-3 py-2 rounded-pill bg-danger text-white fw-bold" style="z-index: 10; font-size: 0.8rem;">
                                Stok: 0
                            </span>
                            <div class="rounded-3 overflow-hidden bg-white shadow-sm" style="height: 200px;">
                                <img src="{{ !empty($produk->foto) ? asset('storage/' . $produk->foto) : 'https://cdn-icons-png.flaticon.com/512/2589/2589901.png' }}" 
                                     onerror="this.onerror=null;this.src='https://cdn-icons-png.flaticon.com/512/2589/2589901.png';" 
                                     alt="{{ $produk->nama }}" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>

                        <div class="card-body p-3 bg-white mt-3 rounded-bottom-4 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-2 text-truncate" title="{{ $produk->nama }}">
                                    {{ $produk->nama }}
                                </h6>
                                <h5 class="fw-bold mb-3" style="color: #d81b60;">
                                    Rp {{ number_format($produk->harga_jual ?? $produk->harga ?? 0, 0, ',', '.') }}
                                </h5>
                            </div>
                            <div class="pt-1 border-top">
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

    {{-- SECTION 4: BEST SELLER PRODUCTS --}}
    <div class="mb-3">
        <h5 class="fw-bold text-dark mb-0">Best Seller Products</h5>
    </div>

    {{-- Produk Paling Laris --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="color: #d81b60;">Produk Paling Laris</h6>
            <span class="badge rounded-pill px-3 py-2" style="background-color: #fce4ec; color: #d81b60;">Top Sales</span>
        </div>

        <div class="row g-3">
            @forelse ($produkTerlaris as $produk)
                @php
                    $detailProduk = $produk->produk ?? $produk;
                @endphp
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="background-color: #fff0f5;">
                        <div class="position-relative p-3 pb-0 text-center">
                            <span class="badge position-absolute top-0 start-0 m-4 px-3 py-2 rounded-pill text-white fw-bold shadow-sm" style="background-color: #ff758c; z-index: 10; font-size: 0.8rem;">
                                Terjual: {{ number_format($produk->total_terjual ?? 0) }}
                            </span>
                            <span class="badge position-absolute top-0 end-0 m-4 px-3 py-2 rounded-pill text-dark fw-bold" style="background-color: #ffc107; z-index: 10; font-size: 0.8rem;">
                                Stok: {{ $detailProduk->stok ?? 0 }}
                            </span>
                            <div class="rounded-3 overflow-hidden bg-white shadow-sm" style="height: 200px;">
                                <img src="{{ !empty($detailProduk->foto) ? asset('storage/' . $detailProduk->foto) : 'https://cdn-icons-png.flaticon.com/512/2589/2589901.png' }}" 
                                     onerror="this.onerror=null;this.src='https://cdn-icons-png.flaticon.com/512/2589/2589901.png';" 
                                     alt="{{ $detailProduk->nama ?? 'Produk' }}" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>

                        <div class="card-body p-3 bg-white mt-3 rounded-bottom-4 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-2 text-truncate" title="{{ $detailProduk->nama ?? '-' }}">
                                    {{ $detailProduk->nama ?? 'Nama Produk' }}
                                </h6>
                                <h5 class="fw-bold mb-3" style="color: #d81b60;">
                                    Rp {{ number_format($detailProduk->harga_jual ?? $detailProduk->harga ?? 0, 0, ',', '.') }}
                                </h5>
                            </div>
                            <div class="pt-1 border-top">
                                <a href="{{ isset($detailProduk->id) ? route('produk.show', $detailProduk->id) : '#' }}" 
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
                    Belum ada data produk terlaris.
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection