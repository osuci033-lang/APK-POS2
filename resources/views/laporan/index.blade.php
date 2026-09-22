@extends('layouts.app')

@section('title', 'Laporan Penjualan Toko')

@section('content')

@include('layouts.navbar')

<div class="py-4" style="background-color: #fff5f7; background-image: linear-gradient(to right, rgba(232, 62, 140, 0.05) 1px, transparent 1px), linear-gradient(to bottom, rgba(232, 62, 140, 0.05) 1px, transparent 1px); background-size: 20px 20px; min-height: 90vh; margin-top: -1.5rem;">
    <div class="container-fluid px-3 pt-2">
        
        {{-- Header & Tombol Filter (Ikon dokumen sudah dihapus) --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="color: #5a1835;">
                    Laporan Penjualan Toko
                </h4>
                <p class="text-muted small mb-0">Rekapitulasi transaksi lengkap dengan rincian produk yang terjual.</p>
            </div>
            
            <div class="bg-white p-1 rounded-pill shadow-sm d-flex gap-1 border">
                <a href="{{ route('laporan.index', ['filter' => 'harian']) }}" class="btn btn-sm rounded-pill px-3 {{ $filter == 'harian' ? 'bg-dark text-white fw-bold' : 'text-dark bg-transparent' }}" style="transition: all 0.2s;">Harian</a>
                <a href="{{ route('laporan.index', ['filter' => 'mingguan']) }}" class="btn btn-sm rounded-pill px-3 {{ $filter == 'mingguan' ? 'bg-dark text-white fw-bold' : 'text-dark bg-transparent' }}" style="transition: all 0.2s;">Mingguan</a>
                <a href="{{ route('laporan.index', ['filter' => 'bulanan']) }}" class="btn btn-sm rounded-pill px-3 {{ $filter == 'bulanan' ? 'bg-dark text-white fw-bold' : 'text-dark bg-transparent' }}" style="transition: all 0.2s;">Bulanan</a>
            </div>
        </div>

        {{-- Kotak Total Pendapatan (Warna Pink) --}}
        <div class="card border-0 shadow-sm mb-4 text-white" style="background: linear-gradient(135deg, #e83e8c 0%, #d63384 100%); border-radius: 12px;">
            <div class="card-body p-4">
                <span class="text-white-50 small text-uppercase fw-bold tracking-wider">TOTAL PENDAPATAN ({{ strtoupper($filter) }})</span>
                <h2 class="fw-bold display-6 my-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                <p class="mb-0 text-white-50 small">Dari {{ $jumlahTransaksi }} transaksi berhasil</p>
            </div>
        </div>

        {{-- Tabel Rincian Transaksi --}}
        <div class="card border-0 shadow-sm bg-white" style="border-radius: 12px; overflow: hidden;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase fs-7 text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            <tr>
                                <th class="py-3 px-4">ID Transaksi & Waktu</th>
                                <th class="py-3">Kasir / Pembayaran</th>
                                <th class="py-3">Rincian Produk Terjual (Nama, Harga, Qty)</th>
                                <th class="py-3 text-end px-4">Subtotal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $trx)
                            <tr>
                                {{-- ID Transaksi & Waktu --}}
                                <td class="px-4 py-3">
                                    <span class="fw-bold text-dark">#TRX-{{ $trx->id }}</span><br>
                                    <small class="text-muted" style="font-size: 0.8rem;">{{ $trx->created_at->format('d M Y, H:i') }}</small>
                                </td>

                                {{-- Kasir / Pembayaran --}}
                                <td class="py-3">
                                    <span class="text-dark d-block">{{ $trx->user->name ?? '-' }}</span>
                                    <span class="badge bg-light text-muted border px-2 py-1 mt-1" style="font-size: 0.7rem;">{{ strtolower($trx->metode_pembayaran) }}</span>
                                </td>

                                {{-- Rincian Produk Terjual --}}
                                <td class="py-3">
                                    @foreach($trx->itemPenjualan as $item)
                                        <div class="mb-1">
                                            <i class="bi bi-box me-1 text-muted"></i>
                                            <span class="fw-medium text-dark">{{ $item->produk->nama ?? 'Produk Dihapus' }}</span> 
                                            <span class="text-muted small">(Rp {{ number_format($item->harga, 0, ',', '.') }} x {{ $item->kuantitas }})</span>
                                        </div>
                                    @endforeach
                                </td>

                                {{-- Subtotal Transaksi --}}
                                <td class="text-end px-4 py-3 fw-bold text-success">
                                    Rp {{ number_format($trx->total_pembayaran, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <div class="my-3">
                                        <i class="bi bi-folder2-open display-4 text-secondary opacity-50"></i>
                                    </div>
                                    <p class="mb-0">Tidak ada data laporan penjualan untuk periode {{ $filter }} ini.</p>
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
@endsection