<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);
        $keyword = $request->input('search');

        if ($keyword) {
            $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%')
                      ->orWhere('jenis', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();
        } else {
            $products = Produk::latest()->get();
        }

        // PERBAIKAN: Menghitung berdasarkan frekuensi transaksi di item_penjualan 
        // sehingga aman dari error nama kolom.
        $bestSellers = Produk::select('produk.*', DB::raw('COUNT(item_penjualan.produk_id) as total_terjual'))
            ->leftJoin('item_penjualan', 'produk.id', '=', 'item_penjualan.produk_id')
            ->groupBy('produk.id', 'produk.user_id', 'produk.nama', 'produk.jenis', 'produk.harga_beli', 'produk.harga_jual', 'produk.stok', 'produk.foto', 'produk.created_at', 'produk.updated_at')
            ->orderByDesc('total_terjual')
            ->take(3)
            ->get();

        return view('produk.index', compact('products', 'bestSellers'));
    }

    public function create()
    {
        $this->authorize('create', Produk::class);
        return view('produk.create');
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $dataReq = $request->validated();

        $data['user_id']    = Auth::id();
        $data['nama']       = $dataReq['nama'];
        $data['jenis']      = $dataReq['jenis'] ?? 'Sneakers';
        $data['harga_beli'] = $dataReq['harga_beli'];
        $data['harga_jual'] = $dataReq['harga_jual'];
        $data['stok']       = $dataReq['stok'];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        } else {
            $data['foto'] = 'default.png';
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $this->authorize('view', $produk);
        return view('produk.detail', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);
        return view('produk.edit', compact('produk'));
    }

    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id(),
            'nama'       => $dataReq['nama'],
            'jenis'      => $dataReq['jenis'] ?? $produk->jenis ?? 'Sneakers',
            'harga_beli' => $dataReq['harga_beli'],
            'harga_jual' => $dataReq['harga_jual'],
            'stok'       => $dataReq['stok'],
        ];

        if ($request->hasFile('foto')) {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        DB::table('item_penjualan')->where('produk_id', $produk->id)->delete();

        if ($produk->foto && $produk->foto !== 'default.png' && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }
        
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}