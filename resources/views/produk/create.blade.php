@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            
            {{-- Card Container --}}
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                
                {{-- Header Form --}}
                <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom">
                    <div>
                        <span class="badge bg-success bg-opacity-10 text-success fw-bold mb-1 rounded-pill px-3 py-1" style="font-size: 0.75rem;">
                            ➕ Mode Tambah
                        </span>
                        <h5 class="fw-bold text-dark mb-0">
                            Tambah Produk Sepatu Baru 👟
                        </h5>
                    </div>
                    <div class="fs-3">📦</div>
                </div>

                {{-- Form Tambah (Menggunakan route store & method POST) --}}
                <form action="{{ route('produk.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- Form Utama --}}
                    @include('produk._form')

                </form>

            </div>

        </div>
    </div>

</div>

@endsection