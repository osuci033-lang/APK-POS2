@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 bg-light min-vh-100">

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom" style="border-color: #f8bbd0 !important;">
                    <div>
                        <h5 class="fw-bold mb-0" style="color: #880e4f;">
                            Tambah Produk Sepatu Baru 👟
                        </h5>
                    </div>
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