@extends('layouts.app')

@section('title', 'Tambah dan Edit')

@section('content')

@if(session('errors'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4 rounded-3" role="alert" style="background-color: #f8d7da; color: #842029;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('errors') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Header Judul & Tombol Kembali Pink --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="fw-bold mb-0" style="color: #880e4f;">
        <i class="bi bi-cart shadow-sm rounded-circle p-2 text-white me-2 fs-6" style="background-color: #d81b60;"></i> Tambah dan Edit
    </h4>
    
    <a href="{{ route('penjualan.index') }}" 
       class="btn fw-semibold px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 border-0"
       style="background-color: #fce4ec; color: #880e4f; transition: all 0.2s ease;"
       onmouseover="this.style.backgroundColor='#f8bbd0';" 
       onmouseout="this.style.backgroundColor='#fce4ec';">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row g-4">

    {{-- =================== PRODUK =================== --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100" style="border: 1px solid #f8bbd0 !important;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-2">
                <form method="GET" action="{{ $mode === 'edit' ? route('penjualan.edit', $sale->id) : route('penjualan.create') }}">
                    <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                    <div class="input-group">
                        <span class="input-group-text border-end-0 rounded-start-3" style="background-color: #fff0f5; color: #d81b60; border-color: #f8bbd0;">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control border-start-0 rounded-end-3 py-2"
                               style="background-color: #fff0f5; border-color: #f8bbd0; color: #880e4f;"
                               placeholder="Cari produk..."
                               onkeyup="this.form.submit()">
                    </div>
                </form>
            </div>
            
            <div class="card-body px-4 pb-4" style="max-height:65vh; overflow-y:auto">
                <div class="d-flex flex-column gap-2">
                    @foreach($products as $product)
                        <form method="POST" action="{{ route('itempenjualan.store') }}" 
                              class="row g-2 align-items-center m-0 p-2 rounded-3 shadow-sm transition"
                              style="background-color: #fff0f5; border: 1px solid #f8bbd0;">
                            @csrf
                            <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- Nama Produk --}}
                            <div class="col-7">
                                <div class="p-1">
                                    <div class="fw-bold mb-1" style="color: #880e4f;">{{ $product->nama }}</div>
                                    <small class="badge fw-semibold px-2 py-1" style="background-color: #fce4ec; color: #d81b60;">Rp {{ number_format($product->harga_jual) }}</small>
                                </div>
                            </div>

                            {{-- Input Jumlah --}}
                            <div class="col-3">
                                <input type="number" name="quantity" value="1" min="1"
                                       class="form-control form-control-sm text-center font-monospace fw-bold py-2"
                                       style="border-color: #f8bbd0; color: #880e4f; background-color: #ffffff;">
                            </div>

                            {{-- Tombol Tambah Pink --}}
                            <div class="col-2">
                                <button type="submit" class="btn btn-sm w-100 py-2 fw-bold shadow-sm border-0"
                                        style="background-color: #d81b60; color: #ffffff;"
                                        onmouseover="this.style.backgroundColor='#ad1457';"
                                        onmouseout="this.style.backgroundColor='#d81b60';">
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
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column justify-content-between" style="border: 1px solid #f8bbd0 !important;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #fce4ec;">
                        <tr style="color: #880e4f;" class="small fw-bold">
                            <th class="ps-4">Produk</th>
                            <th>Harga</th>
                            <th style="width: 100px;">Qty</th>
                            <th>SubTotal</th>
                            <th class="text-center pe-4" style="width: 80px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($sale->itemPenjualan as $item)
                        <tr style="border-bottom: 1px solid #fce4ec;">
                            <td class="ps-4 fw-semibold" style="color: #880e4f;">{{ $item->produk->nama }}</td>
                            <td class="text-nowrap" style="color: #ad1457;">Rp {{ number_format($item->produk->harga_jual) }}</td>
                            <td>
                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                    @csrf @method('PUT')
                                    <input type="number" name="quantity"
                                           value="{{ $item->kuantitas }}"
                                           class="form-control form-control-sm text-center fw-bold"
                                           style="border-color: #f8bbd0; color: #880e4f;"
                                           onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="fw-bold text-nowrap" style="color: #20c997;">Rp {{ number_format($item->subtotal) }}</td>
                            <td class="text-center pe-4">
                                @can('delete', $item)
                                <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-circle p-1 px-2 border-0" title="Hapus" style="color: #e91e63;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endcan {{-- DIPERBAIKI DARI @canend MENJADI @endcan --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5" style="color: #ad1457;">
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
                {{-- Box Total Pembayaran Soft Pink --}}
                <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3 shadow-sm" style="background-color: #fff0f5; border: 1px solid #f8bbd0;">
                    <span class="fw-bold" style="color: #ad1457;">Total Pembayaran</span>
                    <strong class="fs-4" style="color: #20c997;">Rp {{ number_format($sale->total_pembayaran) }}</strong>
                </div>

                <form method="POST"
                    action="{{ route('penjualan.update', $sale->id) }}"
                    onsubmit="return confirm('Yakin ingin checkout?')" class="mt-2">
                    @csrf
                    @method('PUT')

                    <select name="payment_method" class="form-select form-select-lg mb-3 fs-6 rounded-3" style="border-color: #f8bbd0; color: #880e4f; background-color: #fff0f5;">
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <button class="btn btn-lg w-100 fw-bold shadow-sm py-2 fs-6 rounded-3 text-white border-0" style="background-color: #20c997;" onmouseover="this.style.backgroundColor='#12b886';" onmouseout="this.style.backgroundColor='#20c997';">
                        <i class="bi bi-check-circle me-1"></i> Checkout
                    </button>
                </form>

                {{-- Section Batal Transaksi --}}
                @can('delete', $sale)
                <div class="pt-3 mt-3 border-top text-center" style="border-color: #fce4ec !important;">
                    <button type="button" 
                            class="btn btn-link text-decoration-none fw-semibold btn-sm p-0 d-inline-flex align-items-center gap-1"
                            style="color: #e91e63;"
                            data-bs-toggle="modal" 
                            data-bs-target="#modalBatalTransaksi">
                        <i class="bi bi-x-circle"></i> Batalkan Transaksi Ini
                    </button>
                </div>

                <div class="modal fade" id="modalBatalTransaksi" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content border-0 shadow-lg rounded-4" style="border: 1px solid #f8bbd0 !important;">
                            <div class="modal-body text-center p-4">
                                <div class="mb-3" style="color: #e91e63;">
                                    <i class="bi bi-exclamation-circle display-4"></i>
                                </div>
                                <h6 class="fw-bold mb-2" style="color: #880e4f;">Batalkan Transaksi?</h6>
                                <p class="text-muted small mb-4">Semua item di keranjang akan dihapus dan stok akan dikembalikan.</p>
                                
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn w-50 fw-semibold rounded-3 border-0" style="background-color: #fce4ec; color: #880e4f;" data-bs-dismiss="modal">Batal</button>
                                    
                                    <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="w-50">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn w-100 fw-semibold rounded-3 text-white border-0" style="background-color: #e91e63;">Ya, Hapus</button>
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