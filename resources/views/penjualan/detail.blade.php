@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden" style="border: 1px solid #fcc2d7 !important;">
                
                {{-- Header Warna Pink Soft Sesuai Panel Salam Kenal --}}
                <div class="card-header p-4 text-white d-flex align-items-center justify-content-between border-0" 
                     style="background-color: #ffb6c1;">
                    <div>
                        <h5 class="fw-bold mb-0 text-white">
                            Detail Penjualan 
                        </h5>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="row g-3 p-3 rounded-4 mb-4 shadow-sm" style="background-color: #fff0f5; border: 1px solid #fcc2d7;">
                        <div class="col-sm-4 text-start">
                            <small class="d-block small fw-bold" style="color: #701a35;">Nama Kasir</small>
                            <span class="fw-bold text-dark">
                                {{ $sale->user->name }}
                            </span>
                        </div>
                        <div class="col-sm-4 text-start">
                            <small class="d-block small fw-bold" style="color: #701a35;">Tanggal Transaksi</small>
                            <span class="fw-semibold text-secondary">
                                {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                            </span>
                        </div>
                        <div class="col-sm-4 text-start text-sm-end">
                            <small class="d-block small fw-bold" style="color: #701a35;">Total Pembayaran</small>
                            <span class="fw-bold fs-5" style="color: #701a35;">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3" style="color: #701a35;">
                        Daftar Barang yang Dibeli
                    </h6>
                    <div class="table-responsive rounded-4 shadow-sm" style="border: 1px solid #fcc2d7;">
                        <table class="table table-hover align-middle mb-0">
                            <thead style="background-color: #fff0f5;">
                                <tr style="color: #701a35;" class="small fw-bold">
                                    <th scope="col" class="py-3 text-center" style="width: 5%;">No</th>
                                    <th scope="col" class="py-3 text-center" style="width: 15%;">Foto</th>
                                    <th scope="col" class="py-3">Nama Produk</th>
                                    <th scope="col" class="py-3 text-end pe-4" style="width: 25%;">Harga Jual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($sale->itempenjualan as $item)
                                <tr style="border-bottom: 1px solid #fcc2d7;">
                                    <td class="text-center fw-bold" style="color: #701a35;">{{ $i++ }}</td>
                                    
                                    {{-- Foto Produk --}}
                                    <td class="text-center">
                                        @if($item->produk && $item->produk->foto)
                                            <img src="{{ asset('storage/' . $item->produk->foto) }}" 
                                                 alt="{{ $item->produk->nama }}" 
                                                 class="img-thumbnail rounded-3 shadow-sm" 
                                                 style="width: 60px; height: 60px; object-fit: cover; border-color: #fcc2d7;">
                                        @else
                                            <div class="text-muted rounded-3 d-flex align-items-center justify-content-center mx-auto border"
                                                 style="width: 60px; height: 60px; font-size: 0.7rem; background-color: #fff0f5; border-color: #fcc2d7 !important;">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Nama Produk --}}
                                    <td class="fw-bold text-dark">
                                        {{ $item->produk->nama ?? 'Produk Tidak Ditemukan' }}
                                    </td>

                                    {{-- Harga Produk --}}
                                    <td class="text-end fw-semibold pe-4" style="color: #701a35;">
                                        Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- Footer & Tombol Kembali Soft Pink Kapsul --}}
                <div class="card-footer p-3 d-flex justify-content-start align-items-center bg-white border-0">
                    <a href="{{ route('penjualan.index') }}" 
                       class="btn fw-semibold px-4 rounded-pill border-0"
                       style="background-color: #fde2e4; color: #701a35;">
                        Kembali
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection