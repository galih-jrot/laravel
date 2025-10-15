<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['nama', 'nim'];

    public function wali()
    {
        return $this->hasOne(Wali::class, 'id_mahasiswa');
    }

    public function Dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function hobis()
    {
        return $this->belongsToMany(Hobi::class, 'mahasiswa_hobi', 'id_mahasiswa', 'id_hobi');
    }
}
