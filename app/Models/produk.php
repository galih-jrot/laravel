<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $fillable = ['nama_produk', 'harga', 'stok'];
    protected $visible = ['nama_produk', 'harga', 'stok'];

    public function transaksis()
    {
        
        return $this->belongsToMany(Transaksi::class, 'detail_transaksi', 'id_produk', 'id_transaksi')
        ->withPivot('jumlah', 'sub_total')
        ->withTimestamps();

        
    }

}