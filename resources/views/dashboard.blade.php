@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    {{-- Banner Ringkasan Hari Ini (Header Lucu & Cantik) --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 text-white" 
         style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">
                    Ringkasan Hari Ini 🛍️
                </h2>
                <p class="mb-0 opacity-75">
                    📅 {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="d-none d-md-block fs-1 opacity-75 me-3">
                📊 🛒 
            </div>
        </div>
    </div>

    @can('viewAny', App\Models\User::class)
    {{-- SECTION 1: TODAY'S SALES --}}
    <div class="d-flex align-items-center mb-3">
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
            <i class="bi bi-graph-up-arrow fw-bold"></i>
        </div>
        <h5 class="fw-bold text-dark mb-0">Today's Sales</h5>
    </div>

    <div class="row g-3 mb-4">
        {{-- Total Nilai Penjualan --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block mb-1">Total Nilai Penjualan Hari Ini</span>
                        <h3 class="fw-bold text-primary mb-0">Rp {{ number_format($ringkasan['total_penjualan']) }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 fs-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        💰
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
                        <h3 class="fw-bold text-info mb-0">{{ number_format($ringkasan['total_transaksi']) }} <span class="fs-6 text-muted fw-normal">Transaksi</span></h3>
                    </div>
                    <div class="bg-info bg-opacity-10 text-info rounded-circle p-3 fs-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        🧾
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 2: CASH & PAYMENT STATUS --}}
    <div class="d-flex align-items-center mb-3">
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
            <i class="bi bi-wallet2 fw-bold"></i>
        </div>
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
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 fs-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        💵
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
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 fs-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        💳
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    {{-- SECTION 3: CRITICAL INVENTORY STATUS --}}
    <div class="d-flex align-items-center mb-3">
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
            <i class="bi bi-box-seam fw-bold"></i>
        </div>
        <h5 class="fw-bold text-dark mb-0">Critical Inventory Status</h5>
    </div>

    <div class="row g-3 mb-4">
        {{-- Produk Stok Rendah --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white overflow-hidden">
                <div class="card-header bg-white border-0 pt-3 px-4 pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-warning mb-0">⚠️ Daftar Produk Stok Rendah</h6>
                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Perhatian</span>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="text-secondary small">
                                    <th scope="col" style="width: 10%;">#</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col" class="text-end">Sisa Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokRendah as $index => $produk)
                                    <tr>
                                        <td class="fw-bold text-muted">{{ $produkStokRendah->firstItem() + $index }}</td>
                                        <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                        <td class="text-end">
                                            <span class="badge bg-warning text-dark rounded-pill px-3 py-1">
                                                {{ $produk->stok }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4">
                                            🎉 Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $produkStokRendah->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk Habis Stok --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white overflow-hidden">
                <div class="card-header bg-white border-0 pt-3 px-4 pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-danger mb-0">🚨 Produk Habis Stok</h6>
                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Segera Restok</span>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="text-secondary small">
                                    <th scope="col" style="width: 10%;">#</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col" class="text-end">Sisa Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokHabis as $index => $produk)
                                    <tr>
                                        <td class="fw-bold text-muted">{{ $produkStokHabis->firstItem() + $index }}</td>
                                        <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                        <td class="text-end">
                                            <span class="badge bg-danger rounded-pill px-3 py-1">
                                                {{ $produk->stok }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4">
                                            ✨ Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $produkStokHabis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 4: BEST SELLER PRODUCTS --}}
    <div class="d-flex align-items-center mb-3">
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
            <i class="bi bi-star-fill fw-bold"></i>
        </div>
        <h5 class="fw-bold text-dark mb-0">Best Seller Products</h5>
    </div>

    <div class="row g-3">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                <div class="card-header bg-white border-0 pt-3 px-4 pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-primary mb-0">🔥 Produk Paling Laris</h6>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">Top Sales</span>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="text-secondary small">
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col" class="text-center">Sisa Stok</th>
                                    <th scope="col" class="text-end">Unit Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkTerlaris as $produk)
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            ⭐ {{ $produk->nama }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3">
                                                {{ $produk->stok }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold">
                                                {{ number_format($produk->total_terjual) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4">
                                            🌸 Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection