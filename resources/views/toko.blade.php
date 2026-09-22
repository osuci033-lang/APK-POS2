@extends('layouts.app')

@section('title', 'Tentang Toko - SoleStation POS')

@section('content')

@include('layouts.navbar')

{{-- Ubah container utama menjadi fluid dan sesuaikan padding --}}
<div class="py-4 px-3 px-md-4" style="margin-top: -1.5rem; background-color: #fff5f8; background-image: linear-gradient(90deg, rgba(245, 169, 184, 0.15) 1px, transparent 1px), linear-gradient(0deg, rgba(245, 169, 184, 0.15) 1px, transparent 1px); background-size: 20px 20px; min-height: 85vh;">
    <div class="container-fluid pt-2">
        
        {{-- Hero Header Section (Warna disamakan persis dengan kartu total pendapatan laporan: #e91e63) --}}
        <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 mb-4 text-white position-relative overflow-hidden" 
             style="background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);">
            <div class="position-relative z-1 text-center">
                <span class="badge bg-white text-dark px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">
                    <i class="bi bi-shop me-1 text-danger"></i> SoleStation POS Universe
                </span>
                <h1 class="fw-bold display-6 mb-2">Melangkah Pasti, Mengelola Lebih Mudah.</h1>
                <p class="lead opacity-85 mb-0 mx-auto" style="max-width: 750px;">
                    Lebih dari sekadar aplikasi kasir—ini adalah ruang kendali penuh yang merangkum seni melayani dan ketepatan teknologi dalam satu genggaman.
                </p>
            </div>
        </div>

        {{-- Seksi Pengertian / Definisi --}}
        <div class="card border-0 shadow-sm p-4 p-md-4 rounded-4 mb-4" style="background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(5px);">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <span class="text-uppercase small fw-bold tracking-wider" style="color: #e91e63;">Definisi Kami</span>
                    <h3 class="fw-bold text-dark mt-1 mb-3">Apa itu SoleStation POS?</h3>
                    <p class="text-secondary mb-0" style="line-height: 1.8;">
                        <strong>SoleStation POS</strong> merupakan sistem Point of Sales generasi modern yang dirancang secara khusus untuk menjawab kompleksitas ritel sepatu. Kami memadukan manajemen inventaris multi-ukuran yang detail, pencatatan transaksi kasir yang kilat, serta laporan keuangan real-time agar pemilik toko dapat fokus pada pertumbuhan bisnis tanpa pusing memikirkan pembukuan yang berantakan.
                    </p>
                </div>
                <div class="col-md-3 text-center mt-3 mt-md-0">
                    <div class="p-4 rounded-4 d-inline-block shadow-sm" style="background-color: rgba(255, 230, 235, 0.9); color: #e91e63;">
                        <i class="bi bi-box-seam display-4"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Seksi Visi & Misi --}}
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 border-top border-4" style="background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(5px); border-color: #e91e63 !important;">
                    <div class="p-3 rounded-3 d-inline-block mb-3 shadow-sm" style="background-color: rgba(255, 230, 235, 0.9); color: #e91e63; width: fit-content;">
                        <i class="bi bi-eye-fill fs-3"></i>
                    </div>
                    <span class="text-uppercase small fw-bold" style="color: #e91e63;">Visi Utama</span>
                    <h4 class="fw-bold text-dark mt-1 mb-3">Menjadi Standar Baru Ritel</h4>
                    <p class="text-secondary m-0" style="line-height: 1.7;">
                        Menjadi ekosistem POS digital paling intuitif, terpercaya, andalan bagi seluruh toko sepatu lokal di Indonesia untuk naik kelas ke tingkat efisiensi operasional yang lebih tinggi.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 border-top border-4" style="background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(5px); border-color: #c2185b !important;">
                    <div class="p-3 rounded-3 d-inline-block mb-3 shadow-sm" style="background-color: rgba(255, 230, 235, 0.9); color: #e91e63; width: fit-content;">
                        <i class="bi bi-bullseye fs-3"></i>
                    </div>
                    <span class="text-uppercase small fw-bold" style="color: #e91e63;">Misi Kami</span>
                    <ul class="text-secondary ps-3 m-0" style="line-height: 1.8;">
                        <li>Menghadirkan antarmuka kasir yang cepat, bersih, dan anti-ribet.</li>
                        <li>Menyediakan manajemen stok ukuran produk yang presisi tanpa selisih.</li>
                        <li>Menerapkan sistem hak akses ketat (Admin & Kasir) demi keamanan data.</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Core Values / Prinsip Kerja --}}
        <div class="card border-0 shadow-sm p-4 rounded-4 mb-3" style="background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(5px);">
            <h5 class="fw-bold mb-3 text-center" style="color: #e91e63;">Prinsip Kerja Kami</h5>
            <div class="row g-3 text-center">
                <div class="col-md-4">
                    <div class="p-3 rounded-3 shadow-sm h-100" style="background-color: rgba(255, 230, 235, 0.8);">
                        <i class="bi bi-lightning-charge-fill text-danger fs-4 mb-2 d-block"></i>
                        <h6 class="fw-bold mb-1">Cepat & Responsif</h6>
                        <p class="text-muted small m-0">Transaksi selesai dalam hitungan detik.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-3 shadow-sm h-100" style="background-color: rgba(255, 230, 235, 0.8);">
                        <i class="bi bi-shield-lock-fill text-danger fs-4 mb-2 d-block"></i>
                        <h6 class="fw-bold mb-1">Aman & Terkendali</h6>
                        <p class="text-muted small m-0">Kontrol penuh di tangan pemilik dan admin.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-3 shadow-sm h-100" style="background-color: rgba(255, 230, 235, 0.8);">
                        <i class="bi bi-heart-fill text-danger fs-4 mb-2 d-block"></i>
                        <h6 class="fw-bold mb-1">Ramah Pengguna</h6>
                        <p class="text-muted small m-0">Siap digunakan kasir baru tanpa bingung.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection