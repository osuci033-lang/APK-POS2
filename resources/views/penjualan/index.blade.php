@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">
    
    {{-- Main Container Card --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden" style="border: 1px solid #ffd6e0 !important;">
        
        {{-- Banner Header Penjualan - Warna Presisi Same With Login (#ffb2cc) --}}
        <div class="p-4 p-md-5 text-white position-relative" style="background-color: #ffb2cc; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
            <h2 class="fw-bold mb-1 text-white" style="letter-spacing: -0.5px;">
                Halaman Penjualan 
            </h2>
            <p class="mb-0 text-white opacity-90 fw-semibold">
                Kelola daftar transaksi dan riwayat penjualan toko
            </p>
        </div>

        <div class="card-body p-4">

            {{-- Alert Error jika ada --}}
            @if(session('errors'))
                <div class="alert border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" style="background-color: #f8d7da; color: #721c24;">
                    <div>{{ session('errors') }}</div>
                </div>
            @endif

            {{-- Action Row: Tombol Create & Search Form --}}
            <div class="row g-3 justify-content-between align-items-center mb-4">
                <div class="col-12 col-md-auto">
                    <a href="{{ route('penjualan.create') }}" 
                       class="btn fw-bold px-4 py-2 rounded-pill shadow-sm text-white border-0 d-inline-flex align-items-center gap-1"
                       style="background-color: #ffb2cc; letter-spacing: 0.3px; transition: all 0.2s ease;"
                       onmouseover="this.style.transform='scale(1.03)'" 
                       onmouseout="this.style.transform='scale(1)'">
                        <span>Buat Transaksi Baru</span>
                    </a>
                </div>

                {{-- Form Pencarian --}}
                <div class="col-12 col-md-5 col-lg-4">
                    <form action="{{ route('penjualan.index') }}" method="GET">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden border" style="border-color: #ffe4e8 !important;">
                            <input 
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-0 py-2 ps-3 fst-italic"
                                placeholder="Search transaksi / kasir..."
                                style="font-size: 0.95rem; background-color: #fff5f6;"
                            >
                            <button class="btn px-4 fw-semibold text-white border-0" type="submit" style="background-color: #ffb2cc;">
                                🔍 Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Table Data Penjualan --}}
            <div class="table-responsive rounded-4 shadow-sm" style="border: 1px solid #ffd6e0;">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #fff0f3;">
                        <tr style="color: #900c3f;" class="small fw-bold">
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
                        <tr style="border-bottom: 1px solid #ffe4e8;">
                            <td class="fw-bold ps-3" style="color: #d81b60;">{{ $sales->firstItem() + $loop->index }}</td>
                            
                            {{-- Tanggal Transaksi --}}
                            <td class="fw-semibold text-dark">
                                {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                            </td>

                            {{-- Nama Kasir --}}
                            <td>
                                <span class="badge fw-normal px-3 py-2 rounded-pill shadow-sm" style="background-color: #fff5f6; color: #880e4f; border: 1px solid #ffd6e0;">
                                     {{ $sale->user->name }}
                                     @if(isset($sale->user->role))
                                         ({{ ucfirst(is_object($sale->user->role) ? $sale->user->role->name : $sale->user->role) }})
                                     @endif
                                </span>
                            </td>

                            {{-- Total Pembayaran --}}
                            <td class="fw-bold" style="color: #20c997;">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </td>

                            {{-- Metode Pembayaran --}}
                            <td class="text-center">
                                @if(strtoupper($sale->metode_pembayaran) == 'CASH')
                                    <span class="badge rounded-pill px-3 py-2 fw-bold" style="background-color: #fff0f3; color: #d81b60; border: 1px solid #ffd6e0; font-size: 0.75rem;">
                                         CASH
                                    </span>
                                @elseif(strtoupper($sale->metode_pembayaran) == 'QRIS')
                                    <span class="badge rounded-pill px-3 py-2 fw-bold" style="background-color: #f3e5f5; color: #8e24aa; border: 1px solid #e1bee7; font-size: 0.75rem;">
                                         QRIS
                                    </span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2 fw-bold" style="background-color: #f5f5f5; color: #616161; border: 1px solid #e0e0e0; font-size: 0.75rem;">
                                         {{ $sale->metode_pembayaran }}
                                    </span>
                                @endif
                            </td>

                            {{-- Status Transaksi --}}
                            <td class="text-center">
                                @if(strtoupper($sale->status) == 'COMPLETED' || strtoupper($sale->status) == 'SELESAI')
                                    <span class="badge fw-bold rounded-pill px-3 py-2" style="background-color: #e6f4ea; color: #1e8e3e; border: 1px solid #ceead6; font-size: 0.75rem;">
                                        Selesai
                                    </span>
                                @else
                                    <span class="badge fw-bold rounded-pill px-3 py-2" style="background-color: #fff8e1; color: #b78103; border: 1px solid #ffe082; font-size: 0.75rem;">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    {{-- Detail Button (Pastel Cyan) --}}
                                    <a href="{{ route('penjualan.show', $sale) }}" 
                                       class="btn btn-sm fw-bold rounded-pill px-3 border-0"
                                       style="background-color: #e0f7fa; color: #006064; transition: all 0.2s ease;"
                                       onmouseover="this.style.transform='scale(1.05)'" 
                                       onmouseout="this.style.transform='scale(1)'">
                                         Detail
                                    </a>

                                    @if(strtoupper($sale->status) !== 'COMPLETED' && strtoupper($sale->status) !== 'SELESAI')
                                        {{-- Edit Button (Pastel Yellow) --}}
                                        <a href="{{ route('penjualan.edit', $sale) }}" 
                                           class="btn btn-sm fw-bold rounded-pill px-3 border-0"
                                           style="background-color: #fff2a8; color: #7a5e00; transition: all 0.2s ease;"
                                           onmouseover="this.style.transform='scale(1.05)'" 
                                           onmouseout="this.style.transform='scale(1)'">
                                            Edit
                                        </a>

                                        {{-- Delete Button (Pastel Red/Pink) --}}
                                        @can('delete', $sale)
                                        <form action="{{ route('penjualan.destroy', $sale) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm fw-bold rounded-pill px-3 border-0"
                                                    style="background-color: #ffd6e0; color: #800020; transition: all 0.2s ease;"
                                                    onmouseover="this.style.transform='scale(1.05)'" 
                                                    onmouseout="this.style.transform='scale(1)'">
                                               Hapus
                                            </button>
                                        </form>
                                        @endcan
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5" style="background-color: #fff5f6;">
                                <div class="text-muted">
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