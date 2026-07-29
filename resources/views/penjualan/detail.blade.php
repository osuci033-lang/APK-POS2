@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            
            {{-- Main Container Card --}}
            <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                
                {{-- Header --}}
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-bold mb-1 rounded-pill px-3 py-1" style="font-size: 0.75rem;">
                            🧾 Struk Transaksi
                        </span>
                        <h5 class="fw-bold text-dark mb-0">
                            Detail Penjualan 🛍️
                        </h5>
                    </div>
                    <div class="fs-4">
                        💳
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    
                    {{-- Info Ringkasan Transaksi --}}
                    <div class="row g-3 p-3 bg-light rounded-4 border mb-4">
                        <div class="col-sm-4 text-start">
                            <small class="text-muted d-block small">Nama Kasir</small>
                            <span class="fw-bold text-dark">
                                👤 {{ $sale->user->name }}
                            </span>
                        </div>
                        <div class="col-sm-4 text-start">
                            <small class="text-muted d-block small">Tanggal Transaksi</small>
                            <span class="fw-semibold text-secondary">
                                🕒 {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                            </span>
                        </div>
                        <div class="col-sm-4 text-start text-sm-end">
                            <small class="text-muted d-block small">Total Pembayaran</small>
                            <span class="fw-bold text-success fs-5">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    {{-- Judul Tabel Item --}}
                    <h6 class="fw-bold text-dark mb-3">
                        🛍️ Daftar Barang yang Dibeli
                    </h6>

                    {{-- Tabel Item Penjualan --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="text-secondary small">
                                    <th scope="col" class="py-3 text-center" style="width: 5%;">No</th>
                                    <th scope="col" class="py-3 text-center" style="width: 15%;">Foto</th>
                                    <th scope="col" class="py-3">Nama Produk</th>
                                    <th scope="col" class="py-3 text-end" style="width: 25%;">Harga Jual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($sale->itempenjualan as $item)
                                <tr>
                                    <td class="text-center fw-bold text-muted">{{ $i++ }}</td>
                                    
                                    {{-- Foto Produk --}}
                                    <td class="text-center">
                                        @if($item->produk && $item->produk->foto)
                                            <img src="{{ asset('storage/' . $item->produk->foto) }}" 
                                                 alt="{{ $item->produk->nama }}" 
                                                 class="img-thumbnail rounded-3 shadow-sm" 
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light text-muted rounded-3 d-flex align-items-center justify-content-center mx-auto border"
                                                 style="width: 60px; height: 60px; font-size: 0.7rem;">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Nama Produk --}}
                                    <td class="fw-bold text-dark">
                                        {{ $item->produk->nama ?? 'Produk Tidak Ditemukan' }}
                                    </td>

                                    {{-- Harga Produk --}}
                                    <td class="text-end fw-semibold text-success">
                                        Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- Footer & Tombol Kembali --}}
                <div class="card-footer bg-light border-top p-3 d-flex justify-content-between align-items-center">
                    <a href="{{ route('penjualan.index') }}" class="btn btn-light fw-semibold px-4 rounded-3 border">
                        👈 Kembali ke Daftar Penjualan
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection