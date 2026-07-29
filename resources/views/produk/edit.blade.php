@extends('layouts.app')

@section('title','Edit Produk')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    {{-- Form Container Card --}}
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-6">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body p-4 p-md-5">
                    
                    {{-- Header Judul Kecil & Presisi --}}
                    <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom">
                        <div>
                            <span class="badge bg-warning bg-opacity-10 text-warning fw-bold mb-1 rounded-pill px-3 py-1" style="font-size: 0.75rem;">
                                ✏️ Mode Edit
                            </span>
                            <h5 class="fw-bold text-dark mb-0">
                                Edit Data Produk 📦
                            </h5>
                        </div>
                        <div class="fs-4">
                            🛍️
                        </div>
                    </div>

                    {{-- Form Update --}}
                    <form action="{{ route('produk.update', $produk) }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- Memanggil Partial Form --}}
                        @include('produk._form')

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection