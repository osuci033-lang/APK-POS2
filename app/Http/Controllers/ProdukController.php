<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);
        $keyword = $request->input('search');

        if ($keyword) {
            // Menggunakan ->get() agar semua data hasil pencarian langsung tampil
            $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%')
                      ->orWhere('jenis', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();
        } else {
            // Menggunakan ->get() agar semua produk tampil sekaligus tanpa halaman (1 2 dst)
            $products = Produk::latest()->get();
        }

        return view('produk.index', compact('products'));
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

        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}