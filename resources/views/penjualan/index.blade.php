@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    {{-- Main Container Card --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-body p-4">
            
            {{-- Header Judul & Ringkasan --}}
            <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom">
                <div>
                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold mb-1 rounded-pill px-3 py-1" style="font-size: 0.75rem;">
                        💳 Kasir & Transaksi
                    </span>
                    <h5 class="fw-bold text-dark mb-0">
                        Halaman Penjualan 🛒
                    </h5>
                </div>
                <div class="fs-4">
                    🧾
                </div>
            </div>

            {{-- Alert Error jika ada --}}
            @if(session('errors'))
                <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center">
                    <span class="me-2 fs-5">⚠️</span>
                    <div>{{ session('errors') }}</div>
                </div>
            @endif

            {{-- Action Row: Tombol Create & Search Form --}}
            <div class="row g-3 justify-content-between align-items-center mb-4">
                
                {{-- Tombol Tambah Transaksi --}}
                <div class="col-12 col-md-auto">
                    <a href="{{ route('penjualan.create') }}" class="btn btn-primary fw-bold px-4 py-2 rounded-3 shadow-sm d-inline-flex align-items-center">
                        ➕ Buat Transaksi Baru
                    </a>
                </div>

                {{-- Form Pencarian --}}
                <div class="col-12 col-md-5 col-lg-4">
                    <form action="{{ route('penjualan.index') }}" method="GET">
                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                            <input 
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-end-0 py-2 fst-italic"
                                placeholder="Search transaksi / kasir..."
                                style="font-size: 0.95rem;"
                            >
                            <button class="btn btn-primary px-3 fw-semibold" type="submit">
                                🔍 Search
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            {{-- Table Data Penjualan --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-secondary small">
                            <th scope="col" class="py-3" style="width: 5%;">#</th>
                            <th scope="col" class="py-3">Tanggal Transaksi</th>
                            <th scope="col" class="py-3">Kasir</th>
                            <th scope="col" class="py-3">Total Pembayaran</th>
                            <th scope="col" class="py-3 text-center">Metode</th>
                            <th scope="col" class="py-3 text-center">Status</th>
                            <th scope="col" class="py-3 text-center" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td class="fw-bold text-muted">{{ $sales->firstItem() + $loop->index }}</td>
                            
                            {{-- Tanggal Transaksi --}}
                            <td class="fw-semibold text-dark">
                                🕒 {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                            </td>

                            {{-- Nama Kasir --}}
                            <td>
                                <span class="badge bg-light text-dark border fw-normal px-2 py-1 rounded-2">
                                    👤 {{ $sale->user->name }}
                                </span>
                            </td>

                            {{-- Total Pembayaran --}}
                            <td class="fw-bold text-success">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </td>

                            {{-- Metode Pembayaran --}}
                            <td class="text-center">
                                @if(strtoupper($sale->metode_pembayaran) == 'CASH')
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-20 rounded-2 px-2 py-1" style="font-size: 0.75rem;">
                                        💵 CASH
                                    </span>
                                @elseif(strtoupper($sale->metode_pembayaran) == 'QRIS')
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-20 rounded-2 px-2 py-1" style="font-size: 0.75rem;">
                                        📱 QRIS
                                    </span>
                                @else
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 rounded-2 px-2 py-1" style="font-size: 0.75rem;">
                                        🏦 {{ $sale->metode_pembayaran }}
                                    </span>
                                @endif
                            </td>

                            {{-- Status Transaksi --}}
                            <td class="text-center">
                                @if(strtoupper($sale->status) == 'COMPLETED')
                                    <span class="badge bg-success bg-opacity-10 text-success fw-bold rounded-pill px-3 py-1">
                                        Selesai
                                    </span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning fw-bold rounded-pill px-3 py-1">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    {{-- Tombol Detail (Selalu Tampil) --}}
                                    <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-info btn-sm text-white fw-semibold rounded-3 px-2 shadow-sm">
                                        👁️ Detail
                                    </a>

                                    {{-- Tombol Edit & Hapus Hanya Tampil Jika Status Belum Selesai (Pending/OPEN) --}}
                                    @if(strtoupper($sale->status) !== 'COMPLETED')
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-warning btn-sm text-white fw-semibold rounded-3 px-2 shadow-sm">
                                            ✏️ Edit
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        @can('delete', $sale)
                                        <form action="{{ route('penjualan.destroy', $sale) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm fw-semibold rounded-3 px-2 shadow-sm">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                        @endcan
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <div class="fs-1 mb-2">🧾</div>
                                    <h6 class="fw-bold mb-1">Data Penjualan Tidak Ditemukan</h6>
                                    <small>Belum ada transaksi penjualan yang dibuat.</small>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $sales->links() }}
            </div>

        </div>
    </div>

</div>

@endsection