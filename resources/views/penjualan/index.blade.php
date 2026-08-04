@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    {{-- Main Container Card --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #f8bbd0 !important;">
        <div class="card-body p-4">
            
            {{-- Header Judul & Ringkasan Pink Aesthetic --}}
            <div class="d-flex align-items-center justify-content-between pb-3 mb-4" style="border-bottom: 1px solid #f8bbd0 !important;">
                <div>
                    <span class="badge fw-bold mb-1 rounded-pill px-3 py-1 shadow-sm" style="background-color: #fce4ec; color: #d81b60; font-size: 0.75rem;">
                        💳 Kasir & Transaksi
                    </span>
                    <h5 class="fw-bold mb-0" style="color: #880e4f;">
                        Halaman Penjualan 🛒
                    </h5>
                </div>
                <div class="fs-4">
                    🧾
                </div>
            </div>

            {{-- Alert Error jika ada --}}
            @if(session('errors'))
                <div class="alert border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" style="background-color: #f8d7da; color: #721c24;">
                    <span class="me-2 fs-5">⚠️</span>
                    <div>{{ session('errors') }}</div>
                </div>
            @endif

            {{-- Action Row: Tombol Create & Search Form --}}
            <div class="row g-3 justify-content-between align-items-center mb-4">
                
                {{-- Tombol Tambah Transaksi Pink Cute --}}
                <div class="col-12 col-md-auto">
                    <a href="{{ route('penjualan.create') }}" 
                       class="btn fw-bold px-4 py-2 rounded-pill shadow-sm text-white border-0 d-inline-flex align-items-center gap-1"
                       style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); transition: all 0.2s ease;"
                       onmouseover="this.style.transform='scale(1.05)'" 
                       onmouseout="this.style.transform='scale(1)'">
                        ➕ <span>Buat Transaksi Baru</span>
                    </a>
                </div>

                {{-- Form Pencarian --}}
                <div class="col-12 col-md-5 col-lg-4">
                    <form action="{{ route('penjualan.index') }}" method="GET">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden" style="border: 1px solid #f8bbd0;">
                            <input 
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-0 py-2 ps-3 fst-italic"
                                placeholder="Search transaksi / kasir..."
                                style="font-size: 0.95rem; background-color: #fff0f5;"
                            >
                            <button class="btn px-3 fw-semibold text-white border-0" type="submit" style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);">
                                🔍 Search
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            {{-- Table Data Penjualan --}}
            <div class="table-responsive rounded-4 shadow-sm" style="border: 1px solid #f8bbd0;">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #fce4ec;">
                        <tr style="color: #880e4f;" class="small fw-bold">
                            <th scope="col" class="py-3 ps-3" style="width: 5%;">#</th>
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
                        <tr style="border-bottom: 1px solid #fce4ec;">
                            <td class="fw-bold ps-3" style="color: #d81b60;">{{ $sales->firstItem() + $loop->index }}</td>
                            
                            {{-- Tanggal Transaksi --}}
                            <td class="fw-semibold text-dark">
                                🕒 {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                            </td>

                            {{-- Nama Kasir --}}
                            <td>
                                <span class="badge fw-normal px-2 py-1 rounded-pill shadow-sm" style="background-color: #fce4ec; color: #880e4f;">
                                    👤 {{ $sale->user->name }}
                                </span>
                            </td>

                            {{-- Total Pembayaran --}}
                            <td class="fw-bold" style="color: #20c997;">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </td>

                            {{-- Metode Pembayaran --}}
                            <td class="text-center">
                                @if(strtoupper($sale->metode_pembayaran) == 'CASH')
                                    <span class="badge rounded-pill px-3 py-1 shadow-sm" style="background-color: #e8f5e9; color: #2e7d32; font-size: 0.75rem;">
                                        💵 CASH
                                    </span>
                                @elseif(strtoupper($sale->metode_pembayaran) == 'QRIS')
                                    <span class="badge rounded-pill px-3 py-1 shadow-sm" style="background-color: #e0f7fa; color: #006064; font-size: 0.75rem;">
                                        📱 QRIS
                                    </span>
                                @else
                                    <span class="badge rounded-pill px-3 py-1 shadow-sm" style="background-color: #f3e5f5; color: #6a1b9a; font-size: 0.75rem;">
                                        🏦 {{ $sale->metode_pembayaran }}
                                    </span>
                                @endif
                            </td>

                            {{-- Status Transaksi --}}
                            <td class="text-center">
                                @if(strtoupper($sale->status) == 'COMPLETED')
                                    <span class="badge fw-bold rounded-pill px-3 py-1 shadow-sm" style="background-color: #e8f5e9; color: #2e7d32;">
                                        Selesai
                                    </span>
                                @else
                                    <span class="badge fw-bold rounded-pill px-3 py-1 shadow-sm" style="background-color: #fff3cd; color: #856404;">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    {{-- Tombol Detail (Selalu Tampil) --}}
                                    <a href="{{ route('penjualan.show', $sale) }}" 
                                       class="btn btn-sm fw-semibold rounded-pill px-3 shadow-sm text-white"
                                       style="background: linear-gradient(135deg, #4dd0e1 0%, #26c6da 100%); transition: all 0.2s ease;"
                                       onmouseover="this.style.transform='scale(1.05)'" 
                                       onmouseout="this.style.transform='scale(1)'">
                                        👁️ Detail
                                    </a>

                                    {{-- Tombol Edit & Hapus Hanya Tampil Jika Status Belum Selesai (Pending/OPEN) --}}
                                    @if(strtoupper($sale->status) !== 'COMPLETED')
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('penjualan.edit', $sale) }}" 
                                           class="btn btn-sm fw-semibold rounded-pill px-3 shadow-sm text-dark"
                                           style="background: linear-gradient(135deg, #ffc107 0%, #ffca28 100%); transition: all 0.2s ease;"
                                           onmouseover="this.style.transform='scale(1.05)'" 
                                           onmouseout="this.style.transform='scale(1)'">
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
                                            <button type="submit" 
                                                    class="btn btn-sm fw-semibold rounded-pill px-3 shadow-sm text-white"
                                                    style="background: linear-gradient(135deg, #ff5252 0%, #ff1744 100%); transition: all 0.2s ease;"
                                                    onmouseover="this.style.transform='scale(1.05)'" 
                                                    onmouseout="this.style.transform='scale(1)'">
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
                            <td colspan="7" class="text-center py-5" style="background-color: #fff0f5;">
                                <div class="text-muted">
                                    <div class="fs-1 mb-2">🧾</div>
                                    <h6 class="fw-bold mb-1" style="color: #880e4f;">Data Penjualan Tidak Ditemukan</h6>
                                    <small style="color: #d81b60;">Belum ada transaksi penjualan yang dibuat.</small>
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