@extends('layouts.app')

@section('title', 'POS')

@section('content')

@if(session('errors'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4 rounded-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('errors') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Header Judul & Tombol Kembali --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="fw-bold mb-0 text-dark">
        <i class="bi bi-cart shadow-sm rounded-circle p-2 bg-primary text-white me-2 fs-6"></i> Tambah dan Edit
    </h4>
    
    <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row g-4">

    {{-- =================== PRODUK =================== --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-2">
                <form method="GET" action="{{ $mode === 'edit' ? route('penjualan.edit', $sale->id) : route('penjualan.create') }}">
                    <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control bg-light border-start-0 rounded-end-3 py-2"
                               placeholder="Cari produk..."
                               onkeyup="this.form.submit()">
                    </div>
                </form>
            </div>
            
            <div class="card-body px-4 pb-4" style="max-height:65vh; overflow-y:auto">
                <div class="d-flex flex-column gap-2">
                    @foreach($products as $product)
                        <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 align-items-center m-0 p-2 bg-light rounded-3 hover-shadow transition">
                            @csrf
                            <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- Nama Produk (Teks biasa, bukan button submit) --}}
                            <div class="col-7">
                                <div class="p-1">
                                    <div class="fw-bold text-dark mb-1">{{ $product->nama }}</div>
                                    <small class="badge bg-primary-subtle text-primary fw-semibold px-2 py-1">Rp {{ number_format($product->harga_jual) }}</small>
                                </div>
                            </div>

                            {{-- Input Jumlah --}}
                            <div class="col-3">
                                <input type="number" name="quantity" value="1" min="1"
                                       class="form-control form-control-sm text-center font-monospace fw-bold py-2">
                            </div>

                            {{-- Tombol Tambah --}}
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-sm w-100 py-2 fw-bold shadow-sm">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- =================== KERANJANG =================== --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column justify-content-between">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Produk</th>
                            <th>Harga</th>
                            <th style="width: 100px;">Qty</th>
                            <th>SubTotal</th>
                            <th class="text-center pe-4" style="width: 80px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($sale->itemPenjualan as $item)
                        <tr>
                            <td class="ps-4 fw-semibold text-dark">{{ $item->produk->nama }}</td>
                            <td class="text-nowrap">Rp {{ number_format($item->produk->harga_jual) }}</td>
                            <td>
                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                    @csrf @method('PUT')
                                    <input type="number" name="quantity"
                                           value="{{ $item->kuantitas }}"
                                           class="form-control form-control-sm text-center fw-bold"
                                           onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="fw-bold text-primary text-nowrap">Rp {{ number_format($item->subtotal) }}</td>
                            <td class="text-center pe-4">
                                @can('delete', $item)
                                <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-circle p-1 px-2 border-0" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div class="py-3">
                                    <i class="bi bi-cart-x fs-1 opacity-50 d-block mb-2"></i>
                                    <span>Keranjang kosong</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-top-0 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded-3">
                    <span class="text-muted fw-bold">Total Pembayaran</span>
                    <strong class="fs-4 text-success">Rp {{ number_format($sale->total_pembayaran) }}</strong>
                </div>

                <form method="POST"
                    action="{{ route('penjualan.update', $sale->id) }}"
                    onsubmit="return confirm('Yakin ingin checkout?')" class="mt-2">
                    @csrf
                    @method('PUT')

                    <select name="payment_method" class="form-select form-select-lg mb-3 fs-6 rounded-3">
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <button class="btn btn-success btn-lg w-100 fw-bold shadow-sm py-2 fs-6 rounded-3">
                        <i class="bi bi-check-circle me-1"></i> Checkout
                    </button>
                </form>

                {{-- Section Batal Transaksi --}}
                @can('delete', $sale)
                <div class="pt-3 mt-3 border-top text-center">
                    <button type="button" 
                            class="btn btn-link text-danger text-decoration-none fw-semibold btn-sm p-0 d-inline-flex align-items-center gap-1"
                            data-bs-toggle="modal" 
                            data-bs-target="#modalBatalTransaksi">
                        <i class="bi bi-x-circle"></i> Batalkan Transaksi Ini
                    </button>
                </div>

                <div class="modal fade" id="modalBatalTransaksi" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-body text-center p-4">
                                <div class="text-danger mb-3">
                                    <i class="bi bi-exclamation-circle display-4"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-2">Batalkan Transaksi?</h6>
                                <p class="text-muted small mb-4">Semua item di keranjang akan dihapus dan stok akan dikembalikan.</p>
                                
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-light w-50 fw-semibold rounded-3" data-bs-dismiss="modal">Batal</button>
                                    
                                    <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="w-50">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100 fw-semibold rounded-3">Ya, Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan

            </div>
        </div>
    </div>

</div>
@endsection