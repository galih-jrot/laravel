<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index()
    {
        $produk = Produk::latest()->paginate(5);
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        //validate form
        $validated = $request->validate([
            'nama' => 'required|min:5',
            'harga' => 'required',
            'stok'  => 'required|integer',
        ]);

        $produk               = new Produk();
        $produk->nama_produk  = $request->nama;
        $produk->harga        = $request->harga;
        $produk->stok         = $request->stok;
        
        $produk->save();
        return redirect()->route('produk.index');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|min:5',
            'harga' => 'required',
            'stok'  => 'required|integer',
        ]);

        $produk               = Produk::findOrFail($id);
        $produk->nama_produk  = $request->nama;
        $produk->harga        = $request->harga;
        $produk->stok         = $request->stok;
       
        $produk->save();
        return redirect()->route('produk.index');

    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        // Storage::disk('public')->delete($produk->image);
        $produk->delete();
        return redirect()->route('produk.index');

    }
}
