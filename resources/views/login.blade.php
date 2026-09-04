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
    main, #app, .container-fluid, div[class*="container"] {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    .custom-input:focus {
        box-shadow: none !important;
        outline: none !important;
    }
    .custom-group:focus-within {
        border: 2px solid #f48fb1 !important;
        box-shadow: 0 0 8px rgba(244, 143, 177, 0.4) !important;
    }
</style>

<div class="d-flex align-items-center justify-content-center w-100 min-vh-100" 
     style="background-color: #fff0f5; background-image: linear-gradient(90deg, rgba(255, 182, 193, 0.25) 2px, transparent 2px), linear-gradient(0deg, rgba(255, 182, 193, 0.25) 2px, transparent 2px); background-size: 40px 40px; margin: 0; padding: 20px 0; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 9999;">
    
    <div class="container" style="max-width: 1140px;">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-8 col-md-5 col-lg-4 position-relative">
                
                {{-- Ilustrasi Kucing Hiasan --}}
                <div class="position-absolute" style="top: -35px; left: 15px; z-index: 20;">
                    <svg width="65" height="50" viewBox="0 0 100 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 45C5 45 2 30 10 20C15 14 22 18 20 25C18 32 12 35 15 45Z" fill="white" stroke="#d8b4bc" stroke-width="3"/>
                        <path d="M20 40C20 30 35 25 50 35C60 30 75 35 70 45C65 55 30 55 20 40Z" fill="white" stroke="#d8b4bc" stroke-width="3"/>
                        <circle cx="75" cy="35" r="14" fill="white" stroke="#d8b4bc" stroke-width="3"/>
                        <path d="M66 25L69 16L75 24Z" fill="white" stroke="#d8b4bc" stroke-width="2"/>
                        <path d="M78 24L83 16L85 26Z" fill="white" stroke="#d8b4bc" stroke-width="2"/>
                        <circle cx="71" cy="33" r="1.5" fill="#555"/>
                        <circle cx="78" cy="33" r="1.5" fill="#555"/>
                        <path d="M74 36C74 36 75 38 76 36" stroke="#555" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M84 18L87 12M87 18L84 12" stroke="#d8b4bc" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>

                <div class="position-absolute d-flex gap-1" style="top: -15px; right: 25px; z-index: 20; transform: rotate(15deg);">
                    <div style="width: 12px; height: 12px; background-color: #ffe082; border: 1.5px solid #ffca28; border-radius: 3px;"></div>
                    <div style="width: 14px; height: 14px; background-color: #ffd54f; border: 1.5px solid #ffb300; border-radius: 3px;"></div>
                    <div style="width: 16px; height: 16px; background-color: #ffca28; border: 1.5px solid #ffa000; border-radius: 3px;"></div>
                </div>

                <div class="card border-0 rounded-4 shadow-sm overflow-hidden mt-4 pt-2" 
                     style="background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(12px); border: 2px solid rgba(255, 255, 255, 0.9) !important;">

                    <div class="card-body p-4 p-sm-5 text-center">
                        
                        <div class="mt-2 mb-4">
                            <h1 class="fw-bolder mb-1" style="color: #ff69b4; font-size: 2.75rem; font-family: 'Comic Sans MS', cursive, sans-serif; text-shadow: 2px 2px 0px #fff, 4px 4px 0px rgba(255, 105, 180, 0.3); letter-spacing: 2px;">LOGIN</h1>
                            <p class="text-muted small mb-0" style="font-size: 0.8rem;">Masuk ke akun Anda untuk mulai bertransaksi</p>
                        </div>

                        <form action="{{ route('auth') }}" method="POST">
                            @csrf

                            <div class="mb-3 text-start">
                                <div class="input-group custom-group shadow-sm rounded-pill overflow-hidden align-items-center" style="background-color: #ffffff; border: 1.5px solid #f8bbd0; padding: 4px 12px;">
                                    <span class="input-group-text border-0 pe-2 bg-transparent" style="color: #d8b4bc;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                        </svg>
                                    </span>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control custom-input border-0 bg-transparent py-2 ps-1 @error('email') is-invalid @enderror" 
                                           placeholder="Masukkan alamat email Anda" 
                                           value="{{ old('email') }}"
                                           style="font-size: 0.875rem; color: #6c757d; -webkit-text-fill-color: #6c757d; background-color: transparent !important;">
                                </div>

                                @error('email')
                                    <div class="invalid-feedback d-block mt-1 small text-danger fw-semibold">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4 text-start position-relative">
                                <div class="position-absolute" style="top: -22px; right: 20px; z-index: 25;">
                                    <svg width="40" height="25" viewBox="0 0 50 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 30C5 15 15 10 25 10C35 10 45 15 45 30H5Z" fill="white" stroke="#d8b4bc" stroke-width="2.5"/>
                                        <path d="M10 13L13 5L18 12Z" fill="white" stroke="#d8b4bc" stroke-width="2"/>
                                        <path d="M32 12L37 5L40 13Z" fill="white" stroke="#d8b4bc" stroke-width="2"/>
                                        <circle cx="18" cy="20" r="1.5" fill="#555"/>
                                        <circle cx="32" cy="20" r="1.5" fill="#555"/>
                                        <path d="M24 22C24 21 26 21 26 22" stroke="#555" stroke-width="1.2" stroke-linecap="round"/>
                                    </svg>
                                </div>

                                <div class="input-group custom-group shadow-sm rounded-pill overflow-hidden align-items-center" style="background-color: #ffffff; border: 1.5px solid #f8bbd0; padding: 4px 12px;">
                                    <span class="input-group-text border-0 pe-2 bg-transparent" style="color: #d8b4bc;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                            <path d="M8 1a2 2 0 0 0-2 2v4H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zm2 6H6V3a2 2 0 1 1 4 0z"/>
                                        </svg>
                                    </span>
                                    <input type="password" 
                                           name="password" 
                                           class="form-control custom-input border-0 bg-transparent py-2 ps-1 @error('password') is-invalid @enderror" 
                                           placeholder="Masukkan password Anda"
                                           style="font-size: 0.875rem; color: #6c757d; -webkit-text-fill-color: #6c757d; background-color: transparent !important;">
                                    <span class="input-group-text border-0 bg-transparent text-muted" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </span>
                                </div>

                                @error('password')
                                    <div class="invalid-feedback d-block mt-1 small text-danger fw-semibold">
                                        {{ $message }}
                                    </div>
                                @enderror     
                            </div>

                            <button type="submit" 
                                    class="btn btn-lg w-100 fw-bold shadow-sm rounded-pill py-2 text-white border-0 mt-2" 
                                    style="letter-spacing: 0.5px; background-color: #d88ca0; font-size: 0.95rem;">
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