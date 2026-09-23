@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<style>
    :root {
        --lux-primary: #d63384; /* Mengubah warna utama menjadi pink */
        --lux-primary-hover: #b02a6b;
        --lux-gold: #ff69b4;
        --lux-gold-light: #fff0f5; /* Background pink soft */
        --lux-dark: #212529;
        --lux-card-bg: #ffffff;
        --lux-border: #f8d7da; /* Border nuansa pink lembut */
        --lux-shadow: 0 10px 25px -5px rgba(214, 51, 132, 0.1);
    }

    /* Tambahan Styling Latar Belakang Kotak-kotak (Grid) */
    .bg-grid-pattern {
        background-color: #fff5f8;
        background-image: 
            linear-gradient(to right, rgba(244, 143, 177, 0.15) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(244, 143, 177, 0.15) 1px, transparent 1px);
        background-size: 20px 20px;
    }

    body {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    .page-title {
        color: #d63384 !important;
        font-weight: 850;
        letter-spacing: -0.5px;
    }

    /* Tombol Pink */
    .btn-lux-primary {
        background: linear-gradient(135deg, #d63384 0%, #c2185b 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 0.3px;
        transition: all 0.25s ease;
        border-radius: 50rem;
    }
    .btn-lux-primary:hover {
        background: linear-gradient(135deg, #b02a6b 0%, #ad1457 100%);
        color: #ffffff;
        transform: scale(1.02);
        box-shadow: 0 8px 20px rgba(214, 51, 132, 0.25);
    }

    /* Styling Product Card (Model Grid seperti referensi) */
    .product-grid-card {
        background: #ffffff;
        border: 1px solid var(--lux-border);
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .product-grid-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(214, 51, 132, 0.15);
        border-color: #f5c2c7;
    }

    .product-img-wrapper {
        position: relative;
        background: #fafafa;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #f8d7da;
    }
    .product-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .stock-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
    }

    /* Tombol Aksi di Card */
    .btn-action-detail {
        background-color: #cff4fc;
        color: #055160;
        border: none;
        font-size: 12px;
        font-weight: 700;
        border-radius: 8px;
        padding: 5px 0;
        transition: 0.2s;
    }
    .btn-action-detail:hover { background-color: #b6effb; color: #055160; }

    .btn-action-edit {
        background-color: #fff3cd;
        color: #856404;
        border: none;
        font-size: 12px;
        font-weight: 700;
        border-radius: 8px;
        padding: 5px 0;
        transition: 0.2s;
    }
    .btn-action-edit:hover { background-color: #ffeeba; color: #856404; }

    .btn-action-delete {
        background-color: #f8d7da;
        color: #842029;
        border: none;
        font-size: 12px;
        font-weight: 700;
        border-radius: 8px;
        padding: 5px 0;
        transition: 0.2s;
    }
    .btn-action-delete:hover { background-color: #f5c2c7; color: #842029; }
</style>

{{-- Diberikan kelas bg-grid-pattern di container-fluid utama --}}
<div class="container-fluid py-4 px-lg-4 bg-grid-pattern min-vh-100">

    {{-- Header Banner Nuansa Pink (Ikon kotak sudah dihapus) --}}
    <div class="p-4 mb-4 rounded-4 shadow-sm text-white" style="background: linear-gradient(135deg, #ffb6c1 0%, #ff69b4 100%);">
        <h2 class="mb-1 fw-bold fs-3 text-white">
            Halaman Produk
        </h2>
        <p class="mb-0 small text-white-50" style="color: #fff !important;">Daftar koleksi produk dan stok sepatu yang tersedia</p>
    </div>

    {{-- Bar Action Atas (Tombol Tambah & Search Bar) --}}
    <div class="card border-0 rounded-4 shadow-sm p-3 mb-4" style="background-color: #ffffff;">
        <form action="{{ route('produk.index') }}" method="GET">
            <div class="row align-items-center g-3">
                <div class="col-md-4">
                    @can('create', App\Models\Produk::class)
                        <a href="{{ route('produk.create') }}" class="btn btn-lux-primary px-4 py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm w-100">
                            <i class="bi bi-plus-lg fs-5"></i>
                            <span>Tambah Produk Baru</span>
                        </a>
                    @endcan
                </div>
                <div class="col-md-8">
                    <div class="input-group input-group-lg rounded-pill overflow-hidden" style="border: 1px solid #f8d7da;">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control border-0 shadow-none ps-4"
                            placeholder="Search nama produk..."
                            style="font-size: 14px;"
                        >
                        <button type="submit" class="btn px-4 text-white" style="background-color: #d63384;">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('produk.index') }}" class="btn btn-light border-0 d-flex align-items-center px-3 text-muted" title="Reset">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- ==================== GRID PRODUCT LIST (MODEL CARD BAWAH) ==================== --}}
    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-6 col-md-3">
                <div class="product-grid-card">
                    <div class="product-img-wrapper">
                        @if($product->foto)
                            <img src="{{ asset('storage/'.$product->foto) }}" alt="{{ $product->nama }}">
                        @else
                            <div class="text-muted text-center p-4">
                                <i class="bi bi-image fs-1 opacity-50"></i>
                            </div>
                        @endif
                        <span class="stock-badge">Stok: {{ $product->stok }}</span>
                    </div>
                    
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $product->nama }}" style="font-size: 13.5px;">
                            {{ $product->nama }}
                        </h6>
                        <div class="fw-bold mb-3" style="font-size: 14px; color: #d63384;">
                            Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                        </div>

                        <div class="row g-1 mt-auto">
                            <div class="col-4">
                                <a href="{{ route('produk.index', $product) }}" class="btn btn-action-detail w-100 text-center">Detail</a>
                            </div>
                            <div class="col-4">
                                @can('update', $product)
                                    <a href="{{ route('produk.edit', $product) }}" class="btn btn-action-edit w-100 text-center">Edit</a>
                                @endcan
                            </div>
                            <div class="col-4">
                                @can('delete', $product)
                                    <form action="{{ route('produk.destroy', $product) }}" method="POST" id="delete-form-{{ $product->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-action-delete w-100 text-center" onclick="confirmDelete({{ $product->id }})">Hapus</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 rounded-4 shadow-sm text-center py-5">
                    <div class="card-body my-4">
                        <i class="bi bi-inbox fs-1 text-secondary opacity-50 d-block mb-3"></i>
                        <h5 class="fw-bold text-secondary">Data Katalog Kosong</h5>
                        <p class="small text-muted mb-0">Belum ada produk terdaftar atau pencarian Anda tidak ditemukan.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

</div>

{{-- SweetAlert2 CDN & Script Konfirmasi Delete --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Produk?',
        text: "Apakah Anda yakin ingin menghapus produk ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d63384',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-4 shadow-lg border-0',
            confirmButton: 'px-4 py-2 rounded-3 fw-bold',
            cancelButton: 'px-4 py-2 rounded-3 fw-bold'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection