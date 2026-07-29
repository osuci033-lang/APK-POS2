@extends('layouts.app')

@section('title', 'Produk')

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
                        📦 Inventaris Barang
                    </span>
                    <h5 class="fw-bold text-dark mb-0">
                        Halaman Produk 🛍️
                    </h5>
                </div>
                <div class="fs-4">
                    📦
                </div>
            </div>

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

            {{-- Table Data Produk --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-secondary small">
                            <th scope="col" class="py-3" style="width: 5%;">#</th>
                            <th scope="col" class="py-3">User</th>
                            <th scope="col" class="py-3 text-center">Foto</th>
                            <th scope="col" class="py-3">Nama</th>
                            <th scope="col" class="py-3">Harga Beli</th>
                            <th scope="col" class="py-3">Harga Jual</th>
                            <th scope="col" class="py-3 text-center">Stok</th>
                            <th scope="col" class="py-3 text-center" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td class="fw-bold text-muted">{{ $products->firstItem() + $loop->index }}</td>
                            
                            {{-- User/Penginput --}}
                            <td class="fw-semibold text-secondary">
                                <span class="badge bg-light text-dark border fw-normal px-2 py-1 rounded-2">
                                    👤 {{ $product->user->name }}
                                </span>
                            </td>

                            {{-- Foto Produk --}}
                            <td class="text-center">
                                @if($product->foto)
                                    <img src="{{ asset('storage/'.$product->foto) }}"
                                         alt="{{ $product->nama }}"
                                         class="img-thumbnail rounded-3 shadow-sm"
                                         style="width: 70px; height: 70px; object-fit: cover;">
                                @else
                                    <div class="bg-light text-muted rounded-3 d-flex align-items-center justify-content-center mx-auto border"
                                         style="width: 70px; height: 70px; font-size: 0.75rem;">
                                        No Image
                                    </div>
                                @endif
                            </td>

                            {{-- Nama Produk --}}
                            <td class="fw-bold text-dark">
                                {{ $product->nama }}
                            </td>

                            {{-- Harga Beli --}}
                            <td class="text-muted">
                                Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                            </td>

                            {{-- Harga Jual --}}
                            <td class="fw-bold text-success">
                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                            </td>

                            {{-- Stok Barang dengan Badge --}}
                            <td class="text-center">
                                @if($product->stok > 10)
                                    <span class="badge bg-success bg-opacity-10 text-success fw-bold rounded-pill px-3 py-2">
                                        {{ $product->stok }} pcs
                                    </span>
                                @elseif($product->stok > 0)
                                    <span class="badge bg-warning bg-opacity-10 text-warning fw-bold rounded-pill px-3 py-2">
                                        {{ $product->stok }} pcs
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger fw-bold rounded-pill px-3 py-2">
                                        Habis
                                    </span>
                                @endif
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    <a href="{{ route('produk.show', $product) }}" class="btn btn-info btn-sm text-white fw-semibold rounded-3 px-2 shadow-sm">
                                        👁️ Detail
                                    </a>

                                    @can('update', $product)
                                        <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning btn-sm fw-semibold rounded-3 px-2 shadow-sm text-dark">
                                            ✏️ Edit
                                        </a>
                                    @endcan

                                    @can('delete', $product)
                                        <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm fw-semibold rounded-3 px-2 shadow-sm" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted">
                                    <div class="fs-1 mb-2">📦</div>
                                    <h6 class="fw-bold mb-1">Data Produk Tidak Tersedia</h6>
                                    <small>Belum ada barang yang ditambahkan atau hasil pencarian tidak ditemukan.</small>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>

        </div>
    </div>

</div>

@endsection