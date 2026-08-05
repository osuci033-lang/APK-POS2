@extends('layouts.app')

@section('title', 'Kasir / Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    {{-- Alert Error jika ada --}}
    @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4 rounded-3" role="alert" style="background-color: #f8d7da; color: #842029;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header Halaman --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: #880e4f;">
                Kasir POS & Transaksi
            </h4>
            <p class="mb-0 text-muted small">Pilih produk di katalog sebelah kiri untuk dimasukkan ke keranjang.</p>
        </div>
        
        <a href="{{ route('penjualan.index') }}" 
           class="btn fw-semibold px-4 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2 border-0"
           style="background-color: #fce4ec; color: #880e4f; transition: all 0.2s ease;"
           onmouseover="this.style.backgroundColor='#f8bbd0';" 
           onmouseout="this.style.backgroundColor='#fce4ec';">
            <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
        </a>
    </div>

    <div class="row g-4">

        {{-- =================== SISI KIRI: KATALOG FOTO PRODUK (SHOPEE STYLE) =================== --}}
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="border: 1px solid #f8bbd0 !important;">
                
                {{-- Search Bar Katalog --}}
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-2">
                    <form method="GET" action="{{ isset($sale) ? route('penjualan.edit', $sale->id) : route('penjualan.create') }}" id="searchForm">
                        @if(isset($sale))
                            <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                        @endif
                        <div class="input-group shadow-sm rounded-pill overflow-hidden" style="border: 1px solid #f8bbd0;">
                            <span class="input-group-text border-0 py-2 ps-3" style="background-color: #fff0f5; color: #d81b60;">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text"
                                   id="inputSearchProduk"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control border-0 py-2"
                                   style="background-color: #fff0f5; color: #880e4f;"
                                   placeholder="Ketik nama produk (misal: adidas)..."
                                   autocomplete="off"
                                   autofocus>
                        </div>
                    </form>
                </div>
                
                {{-- Grid Katalog Produk --}}
                <div class="card-body px-4 pb-4" style="max-height: 65vh; overflow-y: auto;">
                    <div class="row row-cols-2 row-cols-md-3 g-3">
                        @forelse($products as $product)
                            <div class="col">
                                <form method="POST" action="{{ route('itempenjualan.store') }}" class="h-150">
                                    @csrf
                                    @if(isset($sale))
                                        <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                                    @endif
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">

                                    <div class="card h-100 border-0 shadow-sm rounded-4 position-relative product-card" 
                                         style="background-color: #fff0f5; border: 1px solid #f8bbd0 !important; cursor: pointer; transition: transform 0.2s ease;"
                                         onclick="this.closest('form').submit()"
                                         onmouseover="this.style.transform='translateY(-4px)'" 
                                         onmouseout="this.style.transform='translateY(0)'">
                                        
                                        {{-- Badge Stok di Pojok Kanan Atas Foto --}}
                                        <span class="position-absolute top-0 end-0 m-2 badge rounded-pill px-2 py-1 shadow-sm fw-bold" 
                                              style="background-color: #ffc107; color: #000; font-size: 0.7rem; z-index: 2;">
                                            Stok: {{ $product->stok ?? 5 }}
                                        </span>

                                        {{-- Gambar Produk --}}
                                        <div class="overflow-hidden rounded-top-4" style="height: 120px; background-color: #fff;">
                                            @if(!empty($product->foto))
                                                <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="w-100 h-100 object-fit-cover">
                                            @elseif(!empty($product->image))
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nama }}" class="w-100 h-100 object-fit-cover">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted" style="background-color: #fce4ec;">
                                                    <i class="bi bi-image fs-3" style="color: #d81b60;"></i>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Informasi Produk --}}
                                        <div class="card-body p-2 d-flex flex-column justify-content-between text-center">
                                            <h6 class="card-title fw-bold text-truncate mb-1" style="color: #880e4f; font-size: 0.85rem;" title="{{ $product->nama }}">
                                                {{ $product->nama }}
                                            </h6>
                                            <div>
                                                <div class="fw-bold mb-2" style="color: #d81b60; font-size: 0.85rem;">
                                                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                                </div>
                                                <span class="btn btn-sm w-100 fw-bold py-1 rounded-pill text-white border-0"
                                                    style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); font-size: 0.75rem;">
                                                    <i class="bi bi-plus-lg me-1"></i> Pilih
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-muted small">Produk tidak ditemukan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        {{-- =================== SISI KANAN: KERANJANG BELANJA =================== --}}
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column justify-content-between" style="border: 1px solid #f8bbd0 !important;">
                
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0" style="color: #880e4f;">
                        <i class="bi bi-cart3 me-2"></i> Keranjang Belanja
                    </h5>
                </div>

                <div class="table-responsive px-3" style="max-height: 40vh; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #fce4ec;">
                            <tr style="color: #880e4f;" class="small fw-bold">
                                <th class="ps-3">Produk</th>
                                <th>Harga</th>
                                <th style="width: 80px;" class="text-center">Qty</th>
                                <th>SubTotal</th>
                                <th class="text-center pe-3" style="width: 50px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @if(isset($sale) && $sale->itemPenjualan && $sale->itemPenjualan->count() > 0)
                                @foreach($sale->itemPenjualan as $item)
                                <tr style="border-bottom: 1px solid #fce4ec;">
                                    <td class="ps-3 fw-semibold text-truncate" style="color: #880e4f; max-width: 120px;" title="{{ $item->produk->nama }}">
                                        {{ $item->produk->nama }}
                                    </td>
                                    <td class="text-nowrap small" style="color: #ad1457;">
                                        Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf @method('PUT')
                                            <input type="number" name="quantity"
                                                   value="{{ $item->kuantitas }}"
                                                   min="1"
                                                   class="form-control form-control-sm text-center fw-bold rounded-pill"
                                                   style="border-color: #f8bbd0; color: #880e4f; font-size: 0.8rem;"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="fw-bold text-nowrap small" style="color: #20c997;">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center pe-3">
                                        @can('delete', $item)
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm rounded-circle p-1 border-0" title="Hapus" style="color: #e91e63;">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center py-5" style="color: #ad1457; background-color: #fff0f5;">
                                        <div class="py-2">
                                            <i class="bi bi-cart-x fs-2 opacity-50 d-block mb-2"></i>
                                            <span class="small">Keranjang masih kosong</span>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-top-0 p-4">
                    {{-- Total Pembayaran --}}
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3 shadow-sm" style="background-color: #fff0f5; border: 1px solid #f8bbd0;">
                        <span class="fw-bold small" style="color: #ad1457;">Total Pembayaran</span>
                        <strong class="fs-5" style="color: #20c997;">
                            Rp {{ isset($sale) ? number_format($sale->total_pembayaran, 0, ',', '.') : '0' }}
                        </strong>
                    </div>

                    @if(isset($sale))
                    <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" onsubmit="return confirm('Yakin ingin checkout transaksi ini?')">
                        @csrf
                        @method('PUT')

                        <select name="metode_pembayaran" class="form-select form-select-sm mb-3 rounded-pill" style="border-color: #f8bbd0; color: #880e4f; background-color: #fff0f5;" required>
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            <option value="CASH">Cash</option>
                            <option value="QRIS">QRIS</option>
                        </select>

                        <button type="submit" class="btn w-100 fw-bold shadow-sm py-2 rounded-pill text-white border-0" style="background-color: #20c997;" onmouseover="this.style.backgroundColor='#12b886'" onmouseout="this.style.backgroundColor='#20c997'">
                            <i class="bi bi-check-circle me-1"></i> Checkout Sekarang
                        </button>
                    </form>

                    {{-- Tombol Batalkan Transaksi (PASTI MUNCUL) --}}
                    <div class="pt-3 mt-3 border-top text-center" style="border-color: #fce4ec !important;">
                        <button type="button" 
                                class="btn btn-outline-danger w-100 fw-bold rounded-pill py-2 shadow-sm"
                                style="font-size: 0.85rem;"
                                data-bs-toggle="modal" 
                                data-bs-target="#modalBatalTransaksi">
                            <i class="bi bi-x-circle me-1"></i> Batalkan Transaksi Ini
                        </button>
                    </div>

                    {{-- Modal Konfirmasi Batal --}}
                    <div class="modal fade" id="modalBatalTransaksi" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                            <div class="modal-content border-0 shadow-lg rounded-4" style="border: 1px solid #f8bbd0 !important;">
                                <div class="modal-body text-center p-4">
                                    <div class="mb-3 text-danger">
                                        <i class="bi bi-exclamation-circle fs-1"></i>
                                    </div>
                                    <h6 class="fw-bold mb-2" style="color: #880e4f;">Batalkan Transaksi?</h6>
                                    <p class="text-muted small mb-4">Semua item di keranjang akan dihapus dan transaksi dibatalkan.</p>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn w-50 btn-sm fw-semibold rounded-pill border-0" style="background-color: #fce4ec; color: #880e4f;" data-bs-dismiss="modal">Tidak</button>
                                        <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="w-50">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn w-100 btn-sm fw-semibold rounded-pill text-white border-0 bg-danger">Ya, Batalkan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>

            </div>
        </div>

    </div>
</div>

{{-- Skrip Debounce Search & Auto-Focus --}}
<script>
    let timer;
    const inputSearch = document.getElementById('inputSearchProduk');
    const searchForm = document.getElementById('searchForm');

    inputSearch.addEventListener('keyup', function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
            searchForm.submit();
        }, 600); // Otomatis mencari setelah kasir selesai mengetik (jeda 0.6 detik) tanpa terpotong.
    });

    // Mengembalikan fokus kursor ke input pencarian secara otomatis tanpa hilang
    window.onload = function() {
        if (inputSearch) {
            inputSearch.focus();
            inputSearch.setSelectionRange(inputSearch.value.length, inputSearch.value.length);
        }
    };
</script>
@endsection