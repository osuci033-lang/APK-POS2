<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'nama'       => 'required|string|max:255',
            'jenis'      => 'required|string|max:100',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok'       => 'required|integer|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'foto.image'          => 'File yang diunggah harus berupa gambar.',
            'foto.mimes'          => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max'            => 'Ukuran gambar maksimal 2MB.',
            'nama.required'       => 'Nama produk wajib diisi.',
            'jenis.required'      => 'Jenis produk wajib dipilih.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.numeric'  => 'Harga beli harus berupa angka.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.numeric'  => 'Harga jual harus berupa angka.',
            'stok.required'       => 'Stok wajib diisi.',
            'stok.integer'        => 'Stok harus berupa bilangan bulat.',
        ];
    }
}