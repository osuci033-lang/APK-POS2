<?php

namespace App\Services;

use App\Models\Produk;

class MonitoringStokService
{
    public function produkStokRendah()
    {
        // Pastikan select mengambil harga_jual sebagai harga, foto, dan nama
        return Produk::select('id', 'nama', 'stok', 'harga_jual as harga', 'foto', 'user_id')
            ->where('stok', '>', 0)
            ->where('stok', '<=', 5) // Batas stok rendah kamu
            ->get(); // Diubah dari paginate(4) menjadi get()
    }

    public function produkStokHabis()
    {
        return Produk::select('id', 'nama', 'stok', 'harga_jual as harga', 'foto', 'user_id')
            ->where('stok', '=', 0)
            ->get(); // Diubah dari paginate(4) menjadi get()
    }
}