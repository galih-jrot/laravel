<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wali extends Model
{
  protected $fillable = ['nama', 'id_mahasiswa'];
   
  public function mahasiswa()
  {
    return $this->belongsTo(mahasiswa::class, 'id_mahasiswa ');
  }



}
