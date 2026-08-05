@csrf

{{-- Foto Saat Ini --}}
@if (!empty($produk->foto))
<div class="mb-3 p-3 rounded-3" style="background-color: #fff0f5; border: 1px dashed #f8bbd0;">
    <label class="fw-semibold small text-muted mb-2">Foto Saat Ini</label><br>
    <img src="{{ asset('storage/' . $produk->foto) }}" 
         width="150" 
         class="img-thumbnail rounded-3 shadow-sm border-0">
</div>
@endif

{{-- Input Foto & Preview --}}
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <div>
            <label class="form-label fw-semibold text-dark small mb-1">Upload Gambar</label>
            <input type="file" 
                   name="foto" 
                   onchange="previewImage(this)" 
                   class="form-control py-2 @error('foto') is-invalid @enderror rounded-3 shadow-sm"
                   style="border-color: #f8bbd0; background-color: #fff0f5;">

            @error('foto')
            <div class="invalid-feedback d-block mt-1 small text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div>
            <img id="preview" 
                 class="img-thumbnail rounded-3 shadow-sm border-0" 
                 style="display:none; max-width: 150px; background-color: #fff0f5;" 
                 width="150">
        </div>
    </div>
</div>

{{-- Nama Produk --}}
<div class="mb-3">
    <label class="form-label fw-semibold text-dark small mb-1">Nama Produk <span class="text-danger">*</span></label>
    <input type="text" name="name"
        class="form-control py-2 @error('name') is-invalid @enderror rounded-3 shadow-sm"
        style="border-color: #f8bbd0;"
        value="{{ old('name', $produk->nama ?? '') }}">
    @error('name')
        <div class="invalid-feedback mt-1 small text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Harga Beli --}}
<div class="mb-3">
    <label class="form-label fw-semibold text-dark small mb-1">Harga Beli <span class="text-danger">*</span></label>
    <input type="number" name="purchase_price"
        class="form-control py-2 @error('purchase_price') is-invalid @enderror rounded-3 shadow-sm"
        style="border-color: #f8bbd0;"
        value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">
    @error('purchase_price')
        <div class="invalid-feedback mt-1 small text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Harga Jual --}}
<div class="mb-3">
    <label class="form-label fw-semibold text-dark small mb-1">Harga Jual <span class="text-danger">*</span></label>
    <input type="number" name="selling_price"
        class="form-control py-2 @error('selling_price') is-invalid @enderror rounded-3 shadow-sm"
        style="border-color: #f8bbd0;"
        value="{{ old('selling_price', $produk->harga_jual ?? '') }}">
    @error('selling_price')
        <div class="invalid-feedback mt-1 small text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Stok --}}
<div class="mb-4">
    <label class="form-label fw-semibold text-dark small mb-1">Jumlah Stok <span class="text-danger">*</span></label>
    <input type="number" name="stock"
        class="form-control py-2 @error('stock') is-invalid @enderror rounded-3 shadow-sm"
        style="border-color: #f8bbd0;"
        value="{{ old('stock', $produk->stok ?? '') }}">
    @error('stock')
        <div class="invalid-feedback mt-1 small text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Tombol Aksi --}}
<div class="d-flex justify-content-end gap-2 pt-3 border-top" style="border-color: #f8bbd0 !important;">
    <a href="{{ route('produk.index') }}" 
       class="btn fw-semibold px-4 rounded-pill shadow-sm border-0" 
       style="background-color: #f8d7da; color: #721c24; transition: all 0.2s ease;"
       onmouseover="this.style.transform='scale(1.05)'" 
       onmouseout="this.style.transform='scale(1)'">
        Kembali
    </a>

    <button type="submit" 
            class="btn fw-bold px-4 rounded-pill shadow-sm border-0 text-white" 
            style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); transition: all 0.2s ease;"
            onmouseover="this.style.transform='scale(1.05)'" 
            onmouseout="this.style.transform='scale(1)'">
        Simpan
    </button>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const file = input.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
}
</script>