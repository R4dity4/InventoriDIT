<?php

namespace App\Http\Controllers;

use App\Models\Stokout;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StokoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stokouts = Stokout::with('produk')->latest()->paginate(10);
        return view('stokout.index', compact('stokouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::where('stok', '>', 0)->get(); // Only show products with stock
        return view('stokout.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'required|string|max:100',
            'tgl_keluar' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi data.');
        }

        // Check if product has enough stock
        $produk = Produk::find($request->produk_id);
        if ($produk->stok < $request->jumlah) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Stok tidak mencukupi. Stok tersedia: {$produk->stok}");
        }

        $stokout = Stokout::create([
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'tgl_keluar' => $request->tgl_keluar ?? now(),
            'keterangan' => $request->keterangan,
        ]);

        // Update product stock (decrease)
        $produk->update([
            'stok' => $produk->stok - $request->jumlah
        ]);

        return redirect()->route('stokout.index')
            ->with('success', 'Stok keluar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stokout $stokout)
    {
        $stokout->load('produk');
        return view('stokout.show', compact('stokout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stokout $stokout)
    {
        $produks = Produk::all();
        return view('stokout.edit', compact('stokout', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stokout $stokout)
    {
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'required|string|max:100',
            'tgl_keluar' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi data.');
        }

        // Get the old values
        $oldJumlah = $stokout->jumlah;
        $newJumlah = $request->jumlah;
        $oldProdukId = $stokout->produk_id;
        $newProdukId = $request->produk_id;

        // If product changed, restore old product stock and check new product stock
        if ($oldProdukId != $newProdukId) {
            // Restore old product stock
            $oldProduk = Produk::find($oldProdukId);
            $oldProduk->update([
                'stok' => $oldProduk->stok + $oldJumlah
            ]);

            // Check new product stock
            $newProduk = Produk::find($newProdukId);
            if ($newProduk->stok < $newJumlah) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Stok produk baru tidak mencukupi. Stok tersedia: {$newProduk->stok}");
            }

            // Update new product stock
            $newProduk->update([
                'stok' => $newProduk->stok - $newJumlah
            ]);
        } else {
            // Same product, just check if we have enough stock for the difference
            $produk = Produk::find($oldProdukId);
            $stockDifference = $newJumlah - $oldJumlah;
            
            if ($stockDifference > 0 && $produk->stok < $stockDifference) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Stok tidak mencukupi untuk perubahan ini. Stok tersedia: {$produk->stok}");
            }

            // Update product stock
            $produk->update([
                'stok' => $produk->stok + $oldJumlah - $newJumlah
            ]);
        }

        // Update the stokout record
        $stokout->update([
            'produk_id' => $newProdukId,
            'jumlah' => $newJumlah,
            'tgl_keluar' => $request->tgl_keluar ?? $stokout->tgl_keluar,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('stokout.index')
            ->with('success', 'Data stok keluar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stokout $stokout)
    {
        // Get the product and jumlah before deleting
        $produk = $stokout->produk;
        $jumlah = $stokout->jumlah;

        // Delete the stokout record
        $stokout->delete();

        // Restore the product stock (add back the quantity)
        $produk->update([
            'stok' => $produk->stok + $jumlah
        ]);

        return redirect()->route('stokout.index')
            ->with('success', 'Data stok keluar berhasil dihapus dan stok produk dikembalikan.');
    }
}
