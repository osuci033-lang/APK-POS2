@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                
                {{-- Card Utama --}}
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="border: 1px solid #f8bbd0 !important;">
                    
                    {{-- Aksen Garis Warna di Atas Card --}}
                    <div class="py-1" style="background-color: #d81b60;"></div>

                    <div class="card-body p-4 p-sm-5">
                        
                        {{-- Header / Logo Icon --}}
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 64px; height: 64px; background-color: #fce4ec; color: #d81b60;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shop-window" viewBox="0 0 16 16">
                                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 .5.5v5a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </div>
                            <h3 class="fw-bold mb-1" style="color: #880e4f;">SoleStation POS</h3>
                            <p class="text-muted small">Masuk ke akun Anda untuk mulai bertransaksi</p>
                        </div>

                        {{-- Form --}}
                        <form action="{{ route('auth') }}" method="POST">
                            @csrf

                            {{-- Input Email --}}
                            <div class="mb-3 text-start">
                                <label class="form-label fw-semibold small mb-1" style="color: #880e4f;">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="email" 
                                           name="email" 
                                           class="form-control form-control-lg fst-italic @error('email') is-invalid @enderror" 
                                           placeholder="Masukkan alamat email Anda" 
                                           value="{{ old('email') }}"
                                           style="font-size: 0.95rem; border-color: #f8bbd0; background-color: #fff0f5; color: #880e4f;">
                                </div>

                                @error('email')
                                    <div class="invalid-feedback d-block mt-1 small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Input Password --}}
                            <div class="mb-4 text-start">
                                <label class="form-label fw-semibold small mb-1" style="color: #880e4f;">
                                    Kata Sandi <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           name="password" 
                                           class="form-control form-control-lg fst-italic @error('password') is-invalid @enderror" 
                                           placeholder="Masukan password Anda"
                                           style="font-size: 0.95rem; border-color: #f8bbd0; background-color: #fff0f5; color: #880e4f;">
                                </div>

                                @error('password')
                                    <div class="invalid-feedback d-block mt-1 small">
                                        {{ $message }}
                                    </div>
                                @enderror        
                            </div>

                            {{-- Tombol Submit --}}
                            <button type="submit" 
                                    class="btn btn-lg w-100 fw-bold shadow-sm rounded-3 py-2 text-white border-0" 
                                    style="letter-spacing: 0.5px; background-color: #d81b60;"
                                    onmouseover="this.style.backgroundColor='#ad1457';"
                                    onmouseout="this.style.backgroundColor='#d81b60';">
                                Masuk Sekarang
                            </button>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection