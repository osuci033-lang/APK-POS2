@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden" style="border: 1px solid #f8bbd0 !important;">
                <div class="card-header p-4 text-white d-flex align-items-center justify-content-between border-0" 
                     style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);">
                    <div>
                        <h5 class="fw-bold mb-0 text-white">
                            Detail Penjualan 
                        </h5>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="row g-3 p-3 rounded-4 mb-4 shadow-sm" style="background-color: #fff0f5; border: 1px solid #f8bbd0;">
                        <div class="col-sm-4 text-start">
                            <small class="d-block small" style="color: #ad1457;">Nama Kasir</small>
                            <span class="fw-bold text-dark">
                                {{ $sale->user->name }}
                            </span>
                        </div>
                        <div class="col-sm-4 text-start">
                            <small class="d-block small" style="color: #ad1457;">Tanggal Transaksi</small>
                            <span class="fw-semibold text-secondary">
                                {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                            </span>
                        </div>
                        <div class="col-sm-4 text-start text-sm-end">
                            <small class="d-block small" style="color: #ad1457;">Total Pembayaran</small>
                            <span class="fw-bold fs-5" style="color: #20c997;">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3" style="color: #880e4f;">
                        Daftar Barang yang Dibeli
                    </h6>
                    <div class="table-responsive rounded-4 shadow-sm" style="border: 1px solid #f8bbd0;">
                        <table class="table table-hover align-middle mb-0">
                            <thead style="background-color: #fce4ec;">
                                <tr style="color: #880e4f;" class="small fw-bold">
                                    <th scope="col" class="py-3 text-center" style="width: 5%;">No</th>
                                    <th scope="col" class="py-3 text-center" style="width: 15%;">Foto</th>
                                    <th scope="col" class="py-3">Nama Produk</th>
                                    <th scope="col" class="py-3 text-end pe-4" style="width: 25%;">Harga Jual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($sale->itempenjualan as $item)
                                <tr style="border-bottom: 1px solid #fce4ec;">
                                    <td class="text-center fw-bold" style="color: #d81b60;">{{ $i++ }}</td>
                                    
                                    {{-- Foto Produk --}}
                                    <td class="text-center">
                                        @if($item->produk && $item->produk->foto)
                                            <img src="{{ asset('storage/' . $item->produk->foto) }}" 
                                                 alt="{{ $item->produk->nama }}" 
                                                 class="img-thumbnail rounded-3 shadow-sm" 
                                                 style="width: 60px; height: 60px; object-fit: cover; border-color: #f8bbd0;">
                                        @else
                                            <div class="text-muted rounded-3 d-flex align-items-center justify-content-center mx-auto border"
                                                 style="width: 60px; height: 60px; font-size: 0.7rem; background-color: #fff0f5; border-color: #f8bbd0 !important;">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Nama Produk --}}
                                    <td class="fw-bold text-dark">
                                        {{ $item->produk->nama ?? 'Produk Tidak Ditemukan' }}
                                    </td>

                                    {{-- Harga Produk --}}
                                    <td class="text-end fw-semibold pe-4" style="color: #20c997;">
                                        Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- Footer & Tombol Kembali Pink Cute --}}
                <div class="card-footer p-3 d-flex justify-content-between align-items-center" style="background-color: #fff0f5; border-top: 1px solid #f8bbd0 !important;">
                    <a href="{{ route('penjualan.index') }}" 
                       class="btn fw-semibold px-4 rounded-pill shadow-sm border-0"
                       style="background-color: #fce4ec; color: #880e4f; transition: all 0.2s ease;"
                       onmouseover="this.style.transform='scale(1.03)'; this.style.backgroundColor='#f8bbd0';" 
                       onmouseout="this.style.transform='scale(1)'; this.style.backgroundColor='#fce4ec';">
                        Kembali ke Daftar Penjualan
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection