@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    html, body {
        height: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden !important;
    }

    /* Menghilangkan margin bawaan container layout utama */
    main, #app, .container-fluid, div[class*="container"] {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Menghilangkan garis biru Bootstrap saat input diklik & memberi border pink soft */
    .custom-input:focus {
        box-shadow: none !important;
        outline: none !important;
    }

    .custom-group:focus-within {
        border: 2px solid #f48fb1 !important;
        box-shadow: 0 0 8px rgba(244, 143, 177, 0.4) !important;
    }
</style>

{{-- Container Background Full Screen --}}
<div class="d-flex align-items-center justify-content-center w-100 min-vh-100" 
     style="background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 40%, #e1f5fe 100%); margin: 0; padding: 20px 0; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 9999;">
    
    <div class="container" style="max-width: 1140px;">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-8 col-md-5 col-lg-4 position-relative">
                
                {{-- Lingkaran Icon Avatar di Atas Card --}}
                <div class="position-absolute top-0 start-50 translate-middle" style="z-index: 10;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
                         style="width: 75px; height: 75px; background-color: #f48fb1; border: 3px solid #ffffff;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="#ffffff" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                    </div>
                </div>

                {{-- Card Transparan Glassmorphism --}}
                <div class="card border-0 rounded-4 shadow-sm overflow-hidden mt-4 pt-4" 
                     style="background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(12px); border: 2px solid rgba(255, 255, 255, 0.8) !important;">

                    <div class="card-body p-4 p-sm-5 text-center">
                        
                        {{-- Header / Title --}}
                        <div class="mt-3 mb-4">
                            <h4 class="fw-bold mb-1" style="color: #880e4f; letter-spacing: 0.5px;">SoleStation POS</h4>
                            <p class="text-muted small mb-0">Masuk ke akun Anda untuk mulai bertransaksi</p>
                        </div>

                        {{-- Form Login --}}
                        <form action="{{ route('auth') }}" method="POST">
                            @csrf

                            {{-- Input Email --}}
                            <div class="mb-3 text-start">
                                <div class="input-group custom-group shadow-sm rounded-3 overflow-hidden" style="background-color: #ffffff; border: 1px solid #f8bbd0; padding: 2px 8px;">
                                    <span class="input-group-text border-0 pe-1 bg-transparent" style="color: #880e4f;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                        </svg>
                                    </span>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control custom-input border-0 bg-transparent py-2 ps-2 @error('email') is-invalid @enderror" 
                                           placeholder="Masukkan alamat email Anda" 
                                           value="{{ old('email') }}"
                                           style="font-size: 0.875rem; color: #880e4f;">
                                </div>

                                @error('email')
                                    <div class="invalid-feedback d-block mt-1 small text-danger fw-semibold">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Input Password --}}
                            <div class="mb-4 text-start">
                                <div class="input-group custom-group shadow-sm rounded-3 overflow-hidden" style="background-color: #ffffff; border: 1px solid #f8bbd0; padding: 2px 8px;">
                                    <span class="input-group-text border-0 pe-1 bg-transparent" style="color: #880e4f;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                            <path d="M8 1a2 2 0 0 0-2 2v4H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zm2 6H6V3a2 2 0 1 1 4 0z"/>
                                        </svg>
                                    </span>
                                    <input type="password" 
                                           name="password" 
                                           class="form-control custom-input border-0 bg-transparent py-2 ps-2 @error('password') is-invalid @enderror" 
                                           placeholder="Masukan password Anda"
                                           style="font-size: 0.875rem; color: #880e4f;">
                                </div>

                                @error('password')
                                    <div class="invalid-feedback d-block mt-1 small text-danger fw-semibold">
                                        {{ $message }}
                                    </div>
                                @enderror        
                            </div>

                            {{-- Tombol Login --}}
                            <button type="submit" 
                                    class="btn btn-lg w-100 fw-bold shadow-sm rounded-3 py-2 text-white border-0" 
                                    style="letter-spacing: 1px; background-color: #f48fb1; font-size: 0.95rem;"
                                    onmouseover="this.style.backgroundColor='#ec407a';"
                                    onmouseout="this.style.backgroundColor='#f48fb1';">
                                MASUK SEKARANG
                            </button>
                        </form>  

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection