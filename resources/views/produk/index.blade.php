@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')

@include('layouts.navbar')

<style>
    .product-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(255, 117, 140, 0.15) !important;
    }
</style>

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">
    <div class="card border-0 shadow-sm rounded-4 mb-4 text-white" 
         style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">
                    Katalog Sepatu 👟
                </h2>
                <p class="mb-0 opacity-75">
                    Daftar koleksi produk dan stok sepatu yang tersedia
                </p>
            </div>
            <div class="d-none d-md-block fs-1 opacity-75 me-3">
                 📦 🛍️
            </div>
        </div>
    </div>

    {{-- Main Container --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-body p-4">
            
            {{-- Action Row: Tombol Create & Search Form --}}
            <div class="row g-3 justify-content-between align-items-center mb-4">
                
                {{-- Tombol Tambah Produk Pink --}}
                <div class="col-12 col-md-auto">
                    @can('create', App\Models\Produk::class)
                        <a href="{{ route('produk.create') }}" class="btn fw-bold px-4 py-2 rounded-pill shadow-sm d-inline-flex align-items-center text-white" style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); border: none;">
                            ✨ Create Produk Baru
                        </a>
                    @endcan
                </div>

                {{-- Form Pencarian Pink Border --}}
                <div class="col-12 col-md-5 col-lg-4">
                    <form action="{{ route('produk.index') }}" method="GET">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden border" style="border-color: #f8bbd0 !important;">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-0 py-2 px-3 fst-italic"
                                placeholder="Search nama produk..."
                                style="font-size: 0.95rem; background-color: #fff0f5;"
                            >
                            <button class="btn fw-semibold text-white px-4 border-0" type="submit" style="background-color: #ff758c;">
                                🔍 Search
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            {{-- Grid Data Produk (Card Sepatu) --}}
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @forelse ($products as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card bg-white" style="border: 1px solid #f8bbd0 !important;">
                            
                            {{-- Area Foto Produk --}}
                            <div class="position-relative text-center p-3 d-flex align-items-center justify-content-center" style="height: 220px; background-color: #fff0f5;">
                                @if($product->foto)
                                    <img src="{{ asset('storage/'.$product->foto) }}"
                                         alt="{{ $product->nama }}"
                                         class="img-fluid h-100 object-fit-contain">
                                @else
                                    <div class="text-muted small">
                                        📷 No Image
                                    </div>
                                @endif

                                {{-- Badge Stok di Atas Foto --}}
                                <div class="position-absolute top-0 end-0 m-3">
                                    @if($product->stok > 10)
                                        <span class="badge fw-bold rounded-pill px-3 py-2 shadow-sm text-white" style="background-color: #20c997;">
                                            Stok: {{ $product->stok }}
                                        </span>
                                    @elseif($product->stok > 0)
                                        <span class="badge fw-bold rounded-pill px-3 py-2 shadow-sm" style="background-color: #ffc107; color: #000;">
                                            Stok: {{ $product->stok }}
                                        </span>
                                    @else
                                        <span class="badge fw-bold rounded-pill px-3 py-2 shadow-sm text-white" style="background-color: #ff4d6d;">
                                            Habis
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Informasi Produk --}}
                            <div class="card-body p-3 d-flex flex-column justify-content-between">
                                <div>
                                    {{-- Name & User --}}
                                    <small class="text-muted d-block mb-1">👤 {{ $product->user->name }}</small>
                                    <h6 class="card-title fw-bold text-dark mb-2 text-truncate" title="{{ $product->nama }}">
                                        {{ $product->nama }}
                                    </h6>
                                    
                                    {{-- Harga --}}
                                    <p class="card-text fw-bold fs-5 mb-3" style="color: #d81b60;">
                                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- Tombol Aksi Imut --}}
                                <div class="d-flex justify-content-between align-items-center gap-1 pt-2 border-top" style="border-color: #f8bbd0 !important;">
                                    
                                    {{-- Tombol Detail Soft Cyan Pastel --}}
                                    <a href="{{ route('produk.show', $product) }}" 
                                       class="btn btn-sm fw-bold rounded-pill flex-fill border-0 d-inline-flex justify-content-center align-items-center gap-1"
                                       style="background-color: #e0f7fa; color: #006064; transition: all 0.2s ease;"
                                       onmouseover="this.style.transform='scale(1.05)'" 
                                       onmouseout="this.style.transform='scale(1)'">
                                        👁️ <span>Detail</span>
                                    </a>

                                    {{-- Tombol Edit Soft Yellow Pastel --}}
                                    @can('update', $product)
                                        <a href="{{ route('produk.edit', $product) }}" 
                                           class="btn btn-sm fw-bold rounded-pill flex-fill border-0 d-inline-flex justify-content-center align-items-center gap-1"
                                           style="background-color: #fff3cd; color: #856404; transition: all 0.2s ease;"
                                           onmouseover="this.style.transform='scale(1.05)'" 
                                           onmouseout="this.style.transform='scale(1)'">
                                            ✏️ <span>Edit</span>
                                        </a>
                                    @endcan

                                    {{-- Tombol Hapus Soft Pink Pastel --}}
                                    @can('delete', $product)
                                        <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline flex-fill">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm fw-bold rounded-pill w-100 border-0 d-inline-flex justify-content-center align-items-center gap-1" 
                                                    style="background-color: #f8d7da; color: #721c24; transition: all 0.2s ease;"
                                                    onmouseover="this.style.transform='scale(1.05)'" 
                                                    onmouseout="this.style.transform='scale(1)'"
                                                    onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                                🗑️
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 w-100 text-center py-5">
                        <div class="text-muted">
                            <div class="fs-1 mb-2">📦</div>
                            <h6 class="fw-bold mb-1">Data Produk Tidak Tersedia</h6>
                            <small>Belum ada barang yang ditambahkan atau hasil pencarian tidak ditemukan.</small>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4 pt-3">
                {{ $products->links() }}
            </div>

        </div>
    </div>

</div>

@endsection