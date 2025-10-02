<?php

namespace App\Http\Controllers;

use App\Models\Post;

class postController extends Controller
{
    //daftar post
    public function index()
    {
       //menampilkan semua data diri model post 
       $post = post::all();
       return view('post.index', compact('post'));
    }
}
