<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\ItemPenjualan;
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
            ->when($user->role && $user->role->name == 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
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
     * Show the form for creating a new resource (Halaman Kasir Utama).
     */
    public function create(SearchRequest $request)
    {
        // 1. Cek apakah ada transaksi OPEN / PENDING milik user yang belum selesai
        $sale = Penjualan::where('user_id', Auth::id())
            ->whereIn('status', ['OPEN', 'PENDING'])
            ->latest()
            ->first();

        // 2. Jika tidak ada, buat transaksi baru secara otomatis
        if (!$sale) {
            $sale = Penjualan::create([
                'user_id'           => Auth::id(),
                'status'            => 'OPEN',
                'total_pembayaran'  => 0,
                'metode_pembayaran' => 'CASH'
            ]);
        }

        // 3. Load item keranjang beserta produknya
        $sale->load('itemPenjualan.produk');

        // 4. Search Produk (Hanya tampilkan stok > 0 agar bisa dibeli)
        $keyword = $request->input('search');
        $products = Produk::where('stok', '>', 0)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store: Digunakan untuk AKSI KLIK PRODUK (Tambah ke keranjang otomatis ala Shopee).
     */
    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualan,id',
            'produk_id'    => 'required|exists:produk,id',
        ]);

        DB::transaction(function () use ($request) {
            $penjualan = Penjualan::findOrFail($request->penjualan_id);
            $produk = Produk::findOrFail($request->produk_id);

            // Cek apakah stok produk mencukupi
            if ($produk->stok <= 0) {
                return;
            }

            // Cek apakah item sudah ada di keranjang transaksi ini
            $item = ItemPenjualan::where('penjualan_id', $penjualan->id)
                ->where('produk_id', $produk->id)
                ->first();

            if ($item) {
                // Tambah kuantitas jika sudah ada
                $item->kuantitas += 1;
                $item->subtotal = $item->kuantitas * $produk->harga_jual;
                $item->save();
            } else {
                // Buat baru jika belum ada di keranjang
                ItemPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id'    => $produk->id,
                    'kuantitas'    => 1,
                    'harga'        => $produk->harga_jual,
                    'subtotal'     => $produk->harga_jual,
                ]);
            }

            // Kurangi stok produk secara langsung
            $produk->decrement('stok', 1);

            // Update total pembayaran di tabel penjualan
            $totalBaru = ItemPenjualan::where('penjualan_id', $penjualan->id)->sum('subtotal');
            $penjualan->update(['total_pembayaran' => $totalBaru]);
        });

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
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

        abort_if($sale->status === 'COMPLETED' || $sale->status === 'SELESAI', 403);

        $sale->load('itemPenjualan.produk');

        $keyword = $request->input('search');
        $products = Produk::where('stok', '>', 0)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();

        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update: Proses FINAL CHECKOUT transaksi.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        // Sesuaikan validasi dengan nama kolom database Anda ('metode_pembayaran')
        $request->validate([
            'metode_pembayaran' => 'required|in:CASH,QRIS'
        ], [
            'metode_pembayaran.required' => 'Pilih metode pembayaran terlebih dahulu'
        ]);

        if ($penjualan->status === 'COMPLETED' || $penjualan->status === 'SELESAI') {
            return back()->with('errors', 'Transaksi ini sudah selesai');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang masih kosong');
        }

        DB::transaction(function () use ($penjualan, $request) {
            $total = $penjualan->itemPenjualan()->sum('subtotal');

            $penjualan->update([
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_pembayaran'  => $total,
                'status'            => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }

    /**
     * Remove: Batal Transaksi & Kembalikan Stok.
     */
    public function destroy(Penjualan $penjualan)
    {
        if ($penjualan->status === 'COMPLETED' || $penjualan->status === 'SELESAI') {
            return redirect()->route('penjualan.index')
                ->with('errors', 'Transaksi yang sudah selesai tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                if ($item->produk) {
                    $item->produk->increment('stok', $item->kuantitas);
                }
            }

            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}