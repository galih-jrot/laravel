<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Mycontroller extends Controller
{
    public function hello(){
        $nama ="galih nurrohman";
        $umur = 16;

        return view('hello', compact('nama','umur')); 
    }

    public function siswa(){
        $data = [
            ['nama'=>'rehan',   'kelas' =>'xi rpl 3'],
            ['nama' => 'galih', 'kelas' => 'xi rpl 3'],
            ['nama' => 'amul',  'kelas' => 'xi rpl 3'],
        ];

        return view('siswa', compact('data'));
    }
}
