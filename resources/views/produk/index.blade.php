@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')

@include('layouts.navbar')

{{-- Style Tambahan untuk Efek Hover Card --}}
<style>
    .product-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }
</style>

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    {{-- Header Banner --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 text-white" 
         style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-primary fw-bold mb-2 rounded-pill px-3 py-2 shadow-sm">
                    📦 Inventaris Barang
                </span>
                <h2 class="fw-bold mb-1">
                    Katalog Sepatu 👟
                </h2>
                <p class="mb-0 opacity-75">
                    Daftar koleksi produk dan stok sepatu yang tersedia
                </p>
            </div>
            <div class="d-none d-md-block fs-1 opacity-75 me-3">
                👟 📦 🛍️
            </div>
        </div>
    </div>

    {{-- Main Container --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-body p-4">
            
            {{-- Action Row: Tombol Create & Search Form --}}
            <div class="row g-3 justify-content-between align-items-center mb-4">
                
                {{-- Tombol Tambah Produk --}}
                <div class="col-12 col-md-auto">
                    @can('create', App\Models\Produk::class)
                        <a href="{{ route('produk.create') }}" class="btn btn-primary fw-bold px-4 py-2 rounded-3 shadow-sm d-inline-flex align-items-center">
                            ➕ Create Produk Baru
                        </a>
                    @endcan
                </div>

                {{-- Form Pencarian --}}
                <div class="col-12 col-md-5 col-lg-4">
                    <form action="{{ route('produk.index') }}" method="GET">
                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-end-0 py-2 fst-italic"
                                placeholder="Search nama produk..."
                                style="font-size: 0.95rem;"
                            >
                            <button class="btn btn-primary px-3 fw-semibold" type="submit">
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
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card bg-white">
                            
                            {{-- Area Foto Produk --}}
                            <div class="position-relative bg-light text-center p-3 d-flex align-items-center justify-content-center" style="height: 220px;">
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
                                        <span class="badge bg-success bg-opacity-90 fw-bold rounded-pill px-3 py-2 shadow-sm">
                                            Stok: {{ $product->stok }}
                                        </span>
                                    @elseif($product->stok > 0)
                                        <span class="badge bg-warning text-dark fw-bold rounded-pill px-3 py-2 shadow-sm">
                                            Stok: {{ $product->stok }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger fw-bold rounded-pill px-3 py-2 shadow-sm">
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
                                    <p class="card-text text-primary fw-bold fs-5 mb-3">
                                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="d-flex justify-content-between align-items-center gap-1 pt-2 border-top">
                                    <a href="{{ route('produk.show', $product) }}" class="btn btn-info btn-sm text-white fw-semibold rounded-3 flex-fill">
                                        👁️ Detail
                                    </a>

                                    @can('update', $product)
                                        <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning btn-sm text-dark fw-semibold rounded-3 flex-fill">
                                            ✏️ Edit
                                        </a>
                                    @endcan

                                    @can('delete', $product)
                                        <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline flex-fill">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm fw-semibold rounded-3 w-100" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
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