<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function index()
    {
        $detailTransaksis = DetailTransaksi::with(['transaksi.pelanggan', 'produk'])->latest()->paginate(5);
        return view('detail-transaksi.index', compact('detailTransaksis'));
    }

    public function create()
    {
        $transaksis = transaksi::all();
        $produks = Produk::all();
        return view('detail-transaksi.create', compact('transaksis', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        // Cek stok produk
        $produk = Produk::findOrFail($request->produk_id);
        if ($produk->stok < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Stok produk tidak mencukupi. Stok tersedia: ' . $produk->stok]);
        }

        $subtotal = $request->quantity * $request->harga_satuan;
        $request->merge(['subtotal' => $subtotal]);

        // Kurangi stok produk
        $produk->stok -= $request->quantity;
        $produk->save();

        DetailTransaksi::create($request->all());

        // Recalculate transaksi total
        $detailTransaksi = DetailTransaksi::latest()->first(); // Get the newly created one
        $detailTransaksi->transaksi->load('detailTransaksis');
        $detailTransaksi->transaksi->calculateTotal();
        $detailTransaksi->transaksi->save();

        return redirect()->route('detail-transaksi.index')->with('success', 'Detail Transaksi berhasil ditambahkan');
    }

    public function show(DetailTransaksi $detailTransaksi)
    {
        $detailTransaksi->load(['transaksi.pelanggan', 'produk']);
        return view('detail-transaksi.show', compact('detailTransaksi'));
    }

    public function edit(DetailTransaksi $detailTransaksi)
    {
        $transaksis = transaksi::all();
        $produks = Produk::all();
        return view('detail-transaksi.edit', compact('detailTransaksi', 'transaksis', 'produks'));
    }

    public function update(Request $request, DetailTransaksi $detailTransaksi)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        // Cek stok produk
        $produk = Produk::findOrFail($request->produk_id);
        $quantityDifference = $request->quantity - $detailTransaksi->quantity;

        if ($quantityDifference > 0 && $produk->stok < $quantityDifference) {
            return redirect()->back()->withErrors(['quantity' => 'Stok produk tidak mencukupi. Stok tersedia: ' . $produk->stok]);
        }

        $subtotal = $request->quantity * $request->harga_satuan;
        $request->merge(['subtotal' => $subtotal]);

        // Update stok produk
        $produk->stok -= $quantityDifference;
        $produk->save();

        $detailTransaksi->update($request->all());

        // Recalculate transaksi total
        $detailTransaksi->transaksi->load('detailTransaksis');
        $detailTransaksi->transaksi->calculateTotal();
        $detailTransaksi->transaksi->save();

        return redirect()->route('detail-transaksi.index')->with('success', 'Detail Transaksi berhasil diperbarui');
    }

    public function destroy(DetailTransaksi $detailTransaksi)
    {
        // Kembalikan stok produk saat detail transaksi dihapus
        $produk = $detailTransaksi->produk;
        $produk->stok += $detailTransaksi->quantity;
        $produk->save();

        $detailTransaksi->delete();

        // Recalculate transaksi total
        $transaksi = transaksi::find($detailTransaksi->transaksi_id);
        $transaksi->load('detailTransaksis');
        $transaksi->calculateTotal();
        $transaksi->save();

        return redirect()->route('detail-transaksi.index')->with('success', 'Detail Transaksi berhasil dihapus');
    }
}
