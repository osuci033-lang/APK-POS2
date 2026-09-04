@extends('layouts.app')

@section('title', 'SoleStation POS - Koleksi Sepatu')

@section('content')

{{-- CDN Bootstrap Icons untuk icon di Footer --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

<style>
    html, body {
        height: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden !important;
    }
    main, #app, .container-fluid, div[class*="container"] {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)), url('https://images.unsplash.com/photo-1543163521-1bf539c55dd2?auto=format&fit=crop&w=1200&q=80') no-repeat center center;
        background-size: cover;
        min-height: 85vh;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .btn-custom-shop {
        background-color: #d88ca0;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-custom-shop:hover {
        background-color: #c5788d;
        color: white;
    }
    .product-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(216, 140, 160, 0.15);
        transition: transform 0.2s;
        background: #ffffff;
    }
    .product-card:hover {
        transform: translateY(-5px);
    }
    .btn-main-buy {
        background-color: #3d3b40;
        color: white;
        border: none;
        padding: 14px 45px;
        border-radius: 50px;
        font-weight: bold;
        letter-spacing: 1px;
        transition: 0.3s;
    }
    .btn-main-buy:hover {
        background-color: #2b2b2b;
        color: white;
    }
    .about-section {
        background: rgba(255, 255, 255, 0.85);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(216, 140, 160, 0.1);
    }
    .footer-custom {
        background-color: #ffffff;
        color: #555555;
        border-top: 1px solid rgba(216, 140, 160, 0.2);
    }
    .footer-custom h5, .footer-custom h6 {
        color: #d88ca0;
        font-family: 'Comic Sans MS', cursive, sans-serif;
    }
    .footer-custom a {
        color: #6c757d;
        text-decoration: none;
        transition: 0.2s;
    }
    .footer-custom a:hover {
        color: #d88ca0;
        padding-left: 5px;
    }
    .social-icon {
        width: 36px;
        height: 36px;
        background-color: #fff0f5;
        color: #d88ca0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: 0.3s;
    }
    .social-icon:hover {
        background-color: #d88ca0;
        color: #fff;
        transform: translateY(-3px);
    }
</style>

<div class="w-100 min-vh-100" style="background-color: #fff0f5; background-image: linear-gradient(90deg, rgba(255, 182, 193, 0.25) 2px, transparent 2px), linear-gradient(0deg, rgba(255, 182, 193, 0.25) 2px, transparent 2px); background-size: 40px 40px; overflow-y: auto; position: absolute; top: 0; left: 0; z-index: 9999;">

    {{-- Navbar Atas --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 px-4 sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#" style="color: #d88ca0; font-family: 'Comic Sans MS', cursive, sans-serif;">
                SoleStation POS
            </a>
            <div class="ms-auto d-flex align-items-center gap-4">
                <a href="{{ route('login') }}" class="btn btn-sm px-4 rounded-pill text-white fw-bold shadow-sm" style="background-color: #d88ca0;">
                    Sign In / Masuk
                </a>
            </div>
        </div>
    </nav>

    {{-- Banner Utama --}}
    <header class="hero-section px-3">
        <div>
            <h1 class="display-4 fw-bold mb-3" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Step into Elegance & Style</h1>
            <p class="lead mb-4" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Temukan koleksi sepatu impian terbaik dengan kualitas terkurasi hanya untukmu.</p>
            <a href="#katalog" class="btn btn-custom-shop shadow-lg">Jelajahi Koleksi</a>
        </div>
    </header>

    {{-- Katalog Produk --}}
    <section id="katalog" class="container py-5 my-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #d88ca0; font-family: 'Comic Sans MS', cursive, sans-serif;">Koleksi Pilihan Minggu Ini</h2>
            <p class="text-muted small">Produk terfavorit yang paling banyak dicari di SoleStation POS</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            
            {{-- Produk 1 --}}
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card product-card h-100 p-3 border-0 shadow-sm rounded-4">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1543163521-1bf539c55dd2?auto=format&fit=crop&w=400&q=80" class="card-img-top rounded-4" alt="Sepatu 1" style="height: 210px; object-fit: cover;">
                    </div>
                    <div class="card-body px-1 py-3 text-start">
                        <h6 class="card-title fw-bold text-dark mb-2" style="font-size: 0.95rem; min-height: 40px;">Elegant Pearl High Heels</h6>
                        <p class="fw-bold mb-0" style="color: #2b2b2b; font-size: 0.95rem;">Rp. 470.000</p>
                    </div>
                </div>
            </div>

            {{-- Produk 2 --}}
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card product-card h-100 p-3 border-0 shadow-sm rounded-4">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?auto=format&fit=crop&w=400&q=80" class="card-img-top rounded-4" alt="Sepatu 2" style="height: 210px; object-fit: cover;">
                    </div>
                    <div class="card-body px-1 py-3 text-start">
                        <h6 class="card-title fw-bold text-dark mb-2" style="font-size: 0.95rem; min-height: 40px;">Floral Lace Mary Jane</h6>
                        <p class="fw-bold mb-0" style="color: #2b2b2b; font-size: 0.95rem;">Rp. 265.000</p>
                    </div>
                </div>
            </div>

            {{-- Produk 3 --}}
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card product-card h-100 p-3 border-0 shadow-sm rounded-4">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&w=400&q=80" class="card-img-top rounded-4" alt="Sepatu 3" style="height: 210px; object-fit: cover;">
                    </div>
                    <div class="card-body px-1 py-3 text-start">
                        <h6 class="card-title fw-bold text-dark mb-2" style="font-size: 0.95rem; min-height: 40px;">Coco Insulated Puffer</h6>
                        <p class="fw-bold mb-0" style="color: #2b2b2b; font-size: 0.95rem;">Rp. 4.700.000</p>
                    </div>
                </div>
            </div>

            {{-- Produk 4 --}}
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card product-card h-100 p-3 border-0 shadow-sm rounded-4">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?auto=format&fit=crop&w=400&q=80" class="card-img-top rounded-4" alt="Sepatu 4" style="height: 210px; object-fit: cover;">
                    </div>
                    <div class="card-body px-1 py-3 text-start">
                        <h6 class="card-title fw-bold text-dark mb-2" style="font-size: 0.95rem; min-height: 40px;">Chunky Heels Coquette</h6>
                        <p class="fw-bold mb-0" style="color: #2b2b2b; font-size: 0.95rem;">Rp. 290.000</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Tombol Beli Sekarang di Bawah --}}
        <div class="text-center mt-5 pt-3">
            <a href="{{ route('login') }}" class="btn btn-main-buy shadow-lg">
                BELI SEKARANG
            </a>
        </div>
    </section>

    {{-- Bagian Tentang Toko (About Us) --}}
    <section id="tentang" class="container py-5">
        <div class="about-section p-4 p-md-5 text-center">
            <h3 class="fw-bold mb-3" style="color: #d88ca0; font-family: 'Comic Sans MS', cursive, sans-serif;">Tentang SoleStation POS</h3>
            <p class="text-muted mx-auto" style="max-width: 750px; line-height: 1.8;">
                **SoleStation POS** hadir sebagai destinasi utama bagi para pecinta fashion dan sneakers yang mengutamakan kenyamanan serta gaya. Kami menyediakan kurasi produk alas kaki terbaik mulai dari *high heels* elegan, *sneakers* kasual trendi, hingga model *coquette* menggemaskan yang dirancang khusus untuk menemani setiap langkah percaya dirimu. Melalui sistem pelayanan yang cepat dan terpercaya, kami siap memberikan pengalaman berbelanja terbaik untukmu setiap hari.
            </p>
        </div>
    </section>

    {{-- Footer Panjang Lengkap --}}
    <footer class="footer-custom pt-5 pb-4 mt-5">
        <div class="container">
            <div class="row g-4 mb-4 justify-content-center">
                {{-- Kolom 1: Profil Brand SoleStation POS --}}
                <div class="col-12 col-md-4 offset-md-1">
                    <h5 class="fw-bold mb-3"><i class="bi bi-shop me-2"></i>SoleStation POS</h5>
                    <p class="text-muted small" style="line-height: 1.7;">
                        Pusat perbelanjaan sepatu terkurasi dengan kualitas terbaik, menghadirkan gaya, kenyamanan, dan elegansi dalam setiap langkah Anda.
                    </p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-icon" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="social-icon" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon" title="TikTok"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>

                {{-- Kolom 2: Menu Utama --}}
                <div class="col-6 col-md-3">
                    <h6 class="fw-bold mb-3">Menu Utama</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="#"><i class="bi bi-chevron-right small me-1"></i>Beranda</a></li>
                        <li><a href="#katalog"><i class="bi bi-chevron-right small me-1"></i>Produk</a></li>
                        <li><a href="{{ route('login') }}"><i class="bi bi-chevron-right small me-1"></i>Sign In Staff</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Hubungi Kami --}}
                <div class="col-12 col-md-4">
                    <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                    <ul class="list-unstyled small text-muted d-flex flex-column gap-2">
                        <li><i class="bi bi-geo-alt-fill text-danger me-2"></i> Jl. Fashionista No. 88, Bandung, Indonesia</li>
                        <li><i class="bi bi-telephone-fill text-success me-2"></i> +62 812-3456-7890</li>
                        <li><i class="bi bi-envelope-fill text-primary me-2"></i> support@solestationpos.com</li>
                        <li><i class="bi bi-clock-fill text-warning me-2"></i> Setiap Hari: 09.00 - 21.00 WIB</li>
                    </ul>
                </div>
            </div>

            <hr class="text-muted opacity-25 my-4">

            {{-- Copyright Bawah --}}
            <div class="row align-items-center">
                <div class="col-12 text-center text-muted small">
                    <p class="mb-0">&copy; {{ date('Y') }} <span class="fw-bold" style="color: #d88ca0;">SoleStation POS</span>. Hak Cipta Dilindungi. Melangkah Nyaman, Bergaya Setiap Saat.</p>
                </div>
            </div>
        </div>
    </footer>

</div>

@endsection