<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'nama'       => 'required|string|max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok'       => 'required|integer|min:0',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Pesan error kustom dalam bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'nama.required'       => 'Nama produk wajib diisi.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.numeric'  => 'Harga beli harus berupa angka.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.numeric'  => 'Harga jual harus berupa angka.',
            'stok.required'       => 'Stok wajib diisi.',
            'stok.integer'        => 'Stok harus berupa angka bulat.',
            'foto.image'          => 'File harus berupa gambar.',
            'foto.max'            => 'Ukuran foto maksimal 2MB.',
        ];
    }
}