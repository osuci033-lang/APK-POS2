@extends('layouts.app')

@section('title', 'Tentang') 

@section('content')

@include('layouts.navbar')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <!-- Tambahkan h-100 di sini agar card menyesuaikan tinggi konten -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100" style="border: 1px solid #ffd6e0 !important;">
                <!-- Tambahkan align-items-stretch agar kedua kolom di dalam row tingginya sama rata -->
                <div class="row g-0 align-items-stretch">
                    
                    {{-- Sisi Kiri - Profil (Warna Pink Presisi #ffb2cc) --}}
                    <div class="col-md-5 p-4 p-lg-5 text-center text-white d-flex flex-column justify-content-between position-relative" style="background-color: #ffb2cc;">
                        <div>
                            <div class="position-relative d-inline-block mt-2 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm overflow-hidden" 
                                     style="width: 100px; height: 100px; background-color: #ffffff; border: 4px solid rgba(255, 255, 255, 0.6);">
                                    
                                    <img src="{{ asset('images/foto.jpg') }}" alt="Foto Profil" class="w-100 h-100 object-fit-cover">
                                    
                                </div>
                            </div>
                            
                            <h4 class="fw-bold mb-1 text-white">Salam Kenal! 👋</h4>
                            <p class="small opacity-90 mb-3 fw-semibold text-white">Penyanyi & Musisi Performer</p>

                            {{-- Cerita Singkat / Biografi Diri --}}
                            <div class="p-3 rounded-4 mb-3 text-start shadow-sm" style="background: rgba(255, 255, 255, 0.25); backdrop-filter: blur(5px);">
                                <p class="small mb-0 lh-base text-white" style="font-size: 0.85rem; text-align: justify;">
                                    Halo! Saya <strong>Suci Oktaviani</strong>, siswi kelas <strong>XII PPLG 1</strong> yang memiliki kecintaan mendalam pada dunia musik. Saya adalah seorang penyanyi yang aktif tampil dari panggung ke panggung sejak SMP. Pengalaman manggung mengajarkan saya arti kemandirian untuk menghasilkan karya dan penghasilan sendiri dari bakat yang saya miliki.
                                </p>
                            </div>

                            {{-- Email & Instagram --}}
                            <div class="d-flex flex-column gap-2 text-start">
                                <a href="mailto:sucioktaviani@gmail.com" class="text-decoration-none text-white p-2 rounded-3 d-flex align-items-center gap-2" style="background: rgba(255, 255, 255, 0.2);">
                                    <span style="font-size: 1.1rem;">✉️</span>
                                    <span class="small truncate">sucioktaviani@gmail.com</span>
                                </a>
                                <a href="https://instagram.com/username_suci" target="_blank" class="text-decoration-none text-white p-2 rounded-3 d-flex align-items-center gap-2" style="background: rgba(255, 255, 255, 0.2);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a3.55 3.55 0 1 0 0 7.1 3.55 3.55 0 0 0 0-7.1m0 5.658a2.108 2.108 0 1 1 0-4.216 2.108 2.108 0 0 1 0 4.216"/>
                                    </svg>
                                    <span class="small">@username_suci</span>
                                </a>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top border-white-50">
                            <small class="opacity-90 fw-semibold text-white">Created by Suci Oktaviani</small>
                        </div>
                    </div>

                    {{-- Sisi Kanan - Info Aplikasi --}}
                    <div class="col-md-7 p-4 p-lg-5 bg-white d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom" style="border-color: #ffe4e8 !important;">
                                <div>
                                    <h4 class="fw-bold mb-0 d-flex align-items-center gap-2" style="color: #900c3f;">
                                        <span>👟</span> SoleStation POS
                                    </h4>
                                    <small class="text-muted fw-semibold">Point of Sales System</small>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-2 rounded-pill d-flex align-items-center gap-1">
                                    <span class="spinner-grow spinner-grow-sm text-success" role="status" style="width: 6px; height: 6px;"></span>
                                    Active Project
                                </span>
                            </div>

                            {{-- 01. Deskripsi --}}
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark mb-2 d-flex align-items-center gap-2">
                                    <span class="badge rounded-pill" style="background-color: #fff0f3; color: #d81b60; border: 1px solid #ffd6e0;">01</span>
                                    Deskripsi Aplikasi
                                </h6>
                                <div class="p-3 rounded-3" style="background-color: #fff5f6; border: 1px dashed #ffd6e0;">
                                    <p class="text-secondary lh-lg mb-0" style="font-size: 0.9rem; text-align: justify;">
                                        <strong style="color: #900c3f;">SoleStation POS</strong> adalah aplikasi Point of Sales (Admin/Kasir) modern yang dirancang khusus untuk mempermudah operasional toko sepatu. Sistem ini mencakup manajemen data produk, stok barang, transaksi penjualan kasir, hingga laporan riwayat penjualan secara real-time.
                                    </p>
                                </div>
                            </div>

                            {{-- 02. Fitur Utama --}}
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark mb-2 d-flex align-items-center gap-2">
                                    <span class="badge rounded-pill" style="background-color: #fff0f3; color: #d81b60; border: 1px solid #ffd6e0;">02</span>
                                    Fitur Utama Aplikasi
                                </h6>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="p-2 rounded-3 border d-flex align-items-center gap-2" style="background-color: #ffffff; border-color: #ffd6e0 !important;">
                                            <span class="p-1 rounded bg-light">📦</span>
                                            <span class="small text-dark fw-medium" style="font-size: 0.8rem;">Kelola Produk & Stok</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 rounded-3 border d-flex align-items-center gap-2" style="background-color: #ffffff; border-color: #ffd6e0 !important;">
                                            <span class="p-1 rounded bg-light">💳</span>
                                            <span class="small text-dark fw-medium" style="font-size: 0.8rem;">Transaksi Kasir Cepat</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 rounded-3 border d-flex align-items-center gap-2" style="background-color: #ffffff; border-color: #ffd6e0 !important;">
                                            <span class="p-1 rounded bg-light">👥</span>
                                            <span class="small text-dark fw-medium" style="font-size: 0.8rem;">Multi-User (Admin/Kasir)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 03. Keunggulan Sistem --}}
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark mb-2 d-flex align-items-center gap-2">
                                    <span class="badge rounded-pill" style="background-color: #fff0f3; color: #d81b60; border: 1px solid #ffd6e0;">03</span>
                                    Keunggulan Sistem
                                </h6>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="p-3 rounded-4 h-100 shadow-sm border" style="background: linear-gradient(145deg, #ffffff, #fff5f6); border-color: #ffd6e0 !important;">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <span class="p-2 rounded-3 text-white" style="background-color: #ffb2cc; font-size: 0.8rem;">📱</span>
                                                <strong class="text-dark small">Desain Responsif</strong>
                                            </div>
                                            <span class="text-muted small d-block mt-2" style="font-size: 0.8rem; line-height: 1.4;">Tampilan nyaman di laptop maupun tablet.</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="p-3 rounded-4 h-100 shadow-sm border" style="background: linear-gradient(145deg, #ffffff, #fff5f6); border-color: #ffd6e0 !important;">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <span class="p-2 rounded-3 text-white" style="background-color: #ffb2cc; font-size: 0.8rem;">🔐</span>
                                                <strong class="text-dark small">Manajemen Hak Akses</strong>
                                            </div>
                                            <span class="text-muted small d-block mt-2" style="font-size: 0.8rem; line-height: 1.4;">Pemisahan akses Admin dan Kasir.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 04. Teknologi --}}
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                                    <span class="badge rounded-pill" style="background-color: #fff0f3; color: #d81b60; border: 1px solid #ffd6e0;">04</span>
                                    Teknologi yang Digunakan
                                </h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge px-3 py-2 rounded-3 fw-medium d-flex align-items-center gap-2 shadow-sm" style="background-color: #ffffff; color: #900c3f; border: 1px solid #ffd6e0;">
                                        <span style="width: 8px; height: 8px; background-color: #ff2d20;" class="rounded-circle d-inline-block"></span> Laravel
                                    </span>
                                    <span class="badge px-3 py-2 rounded-3 fw-medium d-flex align-items-center gap-2 shadow-sm" style="background-color: #ffffff; color: #900c3f; border: 1px solid #ffd6e0;">
                                        <span style="width: 8px; height: 8px; background-color: #7952b3;" class="rounded-circle d-inline-block"></span> Bootstrap 5
                                    </span>
                                    <span class="badge px-3 py-2 rounded-3 fw-medium d-flex align-items-center gap-2 shadow-sm" style="background-color: #ffffff; color: #900c3f; border: 1px solid #ffd6e0;">
                                        <span style="width: 8px; height: 8px; background-color: #777bb4;" class="rounded-circle d-inline-block"></span> PHP
                                    </span>
                                    <span class="badge px-3 py-2 rounded-3 fw-medium d-flex align-items-center gap-2 shadow-sm" style="background-color: #ffffff; color: #900c3f; border: 1px solid #ffd6e0;">
                                        <span style="width: 8px; height: 8px; background-color: #00758f;" class="rounded-circle d-inline-block"></span> MySQL
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection