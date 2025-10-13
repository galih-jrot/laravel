<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;

class postController extends Controller
{
      //beri midlleware 'auth' untuk mengecek sudah login atau belum 
      public function __construct()
      {
        $this->middleware('auth');
      }

    //daftar post
    public function index()
    {
       //menampilkan semua data diri model post 
       $post = Post::all();
       return view('post.index', compact('post'));


    }

    //menampilkan halaman from create
    public function create()
    {
        return view('post.create');
    }

    public function updateRequest ($request, $id)
{
    //mencari data post berdasarkan parameter 'id'
    $post          = Post::findOrfail($id);
    $post->title   = $request->title;
    $post->content = $request->content;
    $post->save();
    // di alihkan ke halaman post melalui route 'post.index'
    return redirect()->route('post.index');
}


   //menampilkan data berdasarkan parameter id 
   public function show ($id)
{
    $post = post::findOrFail($id);
    return view('post.show', compact('post'));
}




    //menampilkan formulir 
    public function edit($id)
    {
        $post = post::findOrFail($id);
        return view('post.edit' , compact('post'));
    }

    public function update(Request $Request,$id)
    {
        $post =post::findOrFail($id);
        $post->title    = $Request->title;
        $post->content = $Request->content;
        $post->save();//disimpan ke db
        // di alihkan ke halaman post melalui reoute post.index
        return redirect()->Route('post.index');

    }

    public function destroy($id)
    {
        $post = post::findOrFail($id);
        $post->delete();//setelah data di temukan kemudia di delete
        return redirect()->route('post.index');
    }

}
