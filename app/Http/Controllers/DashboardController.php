<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __construct(
        protected LaporanPenjualanService $laporanService,
        protected MonitoringStokService $stokService
    ) {}

    public function index()
    {
        $ringkasan = $this->laporanService->ringkasanHarian();
        
        $produkTerlaris = $this->laporanService->produkTerlarisHariIni();
        foreach ($produkTerlaris as $item) {
            if (isset($item->produk)) {
                $item->harga = $item->produk->harga;
                $item->nama = $item->produk->nama;
                $item->foto = $item->produk->foto;
            }
        }

        // Menggunakan get() agar data tampil penuh ke bawah tanpa halaman terpisah
        return view('dashboard', [
            'tanggalHariIni' => Carbon::now(),
            'ringkasan' => $ringkasan,
            'produkTerlaris' => $produkTerlaris,
            'produkStokRendah' => $this->stokService->produkStokRendah(),
            'produkStokHabis' => $this->stokService->produkStokHabis(),
        ]);
    }
}