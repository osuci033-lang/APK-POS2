<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            // 🔒 Filter berdasarkan role
            ->when($user->role && $user->role->name == 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // 🔍 Search nama user/kasir
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        // 1. Cek apakah ada transaksi OPEN / PENDING milik user yang belum selesai
        $sale = Penjualan::where('user_id', Auth::id())
            ->whereIn('status', ['OPEN', 'PENDING'])
            ->latest()
            ->first();

        // 2. Hanya buat transaksi baru jika TIDAK ADA transaksi aktif
        if (!$sale) {
            $sale = Penjualan::create([
                'user_id'           => Auth::id(),
                'status'            => 'OPEN',
                'total_pembayaran'  => 0,
                'metode_pembayaran' => 'CASH'
            ]);
        }

        // 3. Search Produk
        $keyword = $request->input('search');
        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $sale = $penjualan;
        $sale->load('itemPenjualan.produk');
        $products = Produk::orderBy('nama')->get();
        $mode = 'view';

        return view('penjualan.detail', compact('sale', 'products', 'mode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan, Request $request)
    {
        $sale = $penjualan;

        // Jangan izinkan edit jika transaksi sudah SELESAI
        abort_if($sale->status === 'COMPLETED' || $sale->status === 'SELESAI', 403);

        // Load item keranjang beserta data produknya
        $sale->load('itemPenjualan.produk');

        // Pencarian Produk di Halaman Edit
        $keyword = $request->input('search');
        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();

        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage (Checkout).
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS'
        ], [
            'payment_method.required' => 'Pilih metode pembayaran terlebih dahulu'
        ]);

        // Cek status transaksi (Izinkan OPEN dan PENDING)
        if ($penjualan->status === 'COMPLETED' || $penjualan->status === 'SELESAI') {
            return back()->with('errors', 'Transaksi ini sudah selesai');
        }

        // Cek keranjang
        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang masih kosong');
        }

        DB::transaction(function () use ($penjualan, $request) {
            // Hitung ulang total pembayaran
            $total = $penjualan->itemPenjualan()->sum('subtotal');

            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran'  => $total,
                'status'            => 'COMPLETED' // Status diubah jadi Selesai
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }

    /**
     * Remove the specified resource from storage (Batal Transaksi).
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);

        // Pastikan bukan transaksi yang sudah selesai
        if ($penjualan->status === 'COMPLETED' || $penjualan->status === 'SELESAI') {
            return redirect()->route('penjualan.index')
                ->with('errors', 'Transaksi yang sudah selesai tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                // Kembalikan stok produk
                if ($item->produk) {
                    $item->produk->increment('stok', $item->kuantitas);
                }
            }

            // Hapus item keranjang & data penjualan
            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}