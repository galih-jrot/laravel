<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mycontroller; //contoller harus di import / di panggil
use App\Http\Controllers\postController;


Route::get('/', function () {
    return view('welcome');
});

//basic
Route::get('about', function () {
    return '<h1>hello</h1>' .
        '<br> selamat datang di perpusatakaan digital';
});

//buku
Route::get('buku', function () {
    return view('buku');
});

//pekenalan
Route::get('kenalan', function () {
    return '<h1>asalamualaikum</h1>' .
        '<br> nama aku satria maulana panggil aja satmul' .
        '<br> aku dari smk assalam bandung kelas 11 rpl 3' .
        '<br> alamat aku di komplek rancamanyar regency 1';
});

//menu
Route::get('menu', function () {
    $data = [
        ['nama_makanan' => 'bala-bala', 'harga' => 2000, 'jumlah' => 10],
        ['nama_makanan' => 'gehu pedas', 'harga' => 3000, 'jumlah' => 5],
        ['nama_makanan' => 'cireng', 'harga' => 2500, 'jumlah' => 15],

    ];
    $resto = "warung satmul";
    return view('menu', compact('data', 'resto'));
});

//route parameter
route::get('books/{judul}', function ($a) {return 'judul buku :' . $a;});

route::get('post/{title}/{category}/{halaman}', function ($a, $b, $c) {return view('post', ['judul' => $a, 'cat' => $b, 'halaman' => $c]);});

// route opsional parameter
route::get('profile/{nama?}', function ($a = "satmul") {
    return 'apa kabar perkenalkan nama saya: ' . $a;
});

route::get('order/{item?}', function ($a = "nasi remes spesial") {return view('order', compact('a'));});

//jwaban 1
Route::get('barang-total', function () {
    $barang = [
        ["nama" => "Buku", "harga" => 15000, "qty" => 2],
        ["nama" => "Pensil", "harga" => 3000, "qty" => 5],
        ["nama" => "Penggaris", "harga" => 7000, "qty" => 1],
    ];

    return view('barang-total', compact('barang'));
});
//jawaban2
Route::get('nilai/{nama}/{mapel}/{nilai}', function ($nama, $mapel, $nilai) {
    return view('nilai', compact('nama', 'mapel', 'nilai'));
});

//jawaban3
Route::get('grading/{nama?}/{nilai?}', function ($nama = "Guest", $nilai = 0) {
    return view('grading', compact('nama', 'nilai'));
});

//jawaban4
Route::get('nilai-ratarata', function () {
    $siswa = [
        ["nama" => "Andi", "nilai" => 85],
        ["nama" => "Budi", "nilai" => 70],
        ["nama" => "Citra", "nilai" => 95],
    ];

    return view('nilai-ratarata', compact('siswa'));
});

route::get('test-model', function () {
    $data = App\Models\Post::all();
    return $data;
});

route::get('create-data', function () {
    $data = App\Models\Post::create([
        'title'   => 'laravel',
        'content' => 'lorem ipsum',
    ]);
    return $data;
});

route::get('show-data/{id}', function ($id) {
    $data = App\Models\Post::find($id);
    return $data;
});

route::get('edit-data/{id}', function ($id) {
    $data          = App\Models\Post::find($id);
    $data->title   = "membangun project dengan laravel";
    $data->content = "lorem ipsum dolor sit amet";
    $data->save();
    return $data;
});

route::get('delete-data/{$id}', function ($id) {
    $data = App\Models\Post::find($id);
    $data->delete();
    return redirect('test-model');
});

route::get('search/{cari}', function ($cari) {
    $data = App\Models\Post::where('title', 'like', '%' . $query . '%')->get();
    return $data;
});


// pemangilan url menggunkan controller 
Route::get('greetings',[Mycontroller::class,'hello']);
Route::get('student',[Mycontroller::class,'siswa']);


//post                      
Route::get('post',[postController::class,'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
