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
            <label class="form-label fw-semibold text-dark small mb-1">Unggah Gambar</label>
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
    <label class="form-label fw-semibold text-dark small mb-1">Nama Produk <span class="text-danger"></span></label>
    <input type="text" name="nama"
        class="form-control py-2 @error('nama') is-invalid @enderror rounded-3 shadow-sm"
        style="border-color: #f8bbd0;"
        value="{{ old('nama', $produk->nama ?? '') }}"
        placeholder="" required>
    @error('nama')
        <div class="invalid-feedback mt-1 small text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold text-dark small mb-1">Jenis <span class="text-danger"></span></label>
    <select name="jenis" 
            class="form-select py-2 @error('jenis') is-invalid @enderror rounded-3 shadow-sm"
            style="border-color: #f8bbd0;" required>
        <option value="" disabled {{ old('jenis', $produk->jenis ?? '') == '' ? 'selected' : '' }}>-- Pilih Jenis Sepatu --</option>
        <option value="Sneakers" {{ old('jenis', $produk->jenis ?? '') == 'Sneakers' ? 'selected' : '' }}>Sneakers / Kasual</option>
        <option value="Olahraga" {{ old('jenis', $produk->jenis ?? '') == 'Olahraga' ? 'selected' : '' }}>Olahraga / Basketball</option>
        <option value="Boots" {{ old('jenis', $produk->jenis ?? '') == 'Boots' ? 'selected' : '' }}>Boots & High Heels</option>
        <option value="Pantofel" {{ old('jenis', $produk->jenis ?? '') == 'Pantofel' ? 'selected' : '' }}>Pantofel / Formal</option>
        <option value="Sandal" {{ old('jenis', $produk->jenis ?? '') == 'Sandal' ? 'selected' : '' }}>Sandal / Slip On</option>
    </select>
    @error('jenis')
        <div class="invalid-feedback mt-1 small text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Harga Beli --}}
<div class="mb-3">
    <label class="form-label fw-semibold text-dark small mb-1">Harga Beli <span class="text-danger"></span></label>
    <input type="number" name="harga_beli"
        class="form-control py-2 @error('harga_beli') is-invalid @enderror rounded-3 shadow-sm"
        style="border-color: #f8bbd0;"
        value="{{ old('harga_beli', $produk->harga_beli ?? '') }}" required>
    @error('harga_beli')
        <div class="invalid-feedback mt-1 small text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Harga Jual --}}
<div class="mb-3">
    <label class="form-label fw-semibold text-dark small mb-1">Harga Jual <span class="text-danger"></span></label>
    <input type="number" name="harga_jual"
        class="form-control py-2 @error('harga_jual') is-invalid @enderror rounded-3 shadow-sm"
        style="border-color: #f8bbd0;"
        value="{{ old('harga_jual', $produk->harga_jual ?? '') }}" required>
    @error('harga_jual')
        <div class="invalid-feedback mt-1 small text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Stok --}}
<div class="mb-4">
    <label class="form-label fw-semibold text-dark small mb-1">Jumlah Stok <span class="text-danger"></span></label>
    <input type="number" name="stok"
        class="form-control py-2 @error('stok') is-invalid @enderror rounded-3 shadow-sm"
        style="border-color: #f8bbd0;"
        value="{{ old('stok', $produk->stok ?? '') }}" required>
    @error('stok')
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
        preview.onload = function() {
            URL.revokeObjectURL(preview.src); 
        }
    }
}
</script>