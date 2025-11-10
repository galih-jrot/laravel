SQLSTATE[HY000]:General error: 1364Field'email'doesn't have a default value (Connection: mysql, SQL: insert into `pelanggans` (`nama`, `alamat`, `no_telepon`, `updated_at`, `created_at`) values (galih nurrohman, cibogo, 0987664787, 2025-11-10 04:50:35, 2025-11-10 04:50:35))
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mycontroller; //contoller harus di import / di panggil
use App\Http\Controllers\postController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembayaranController;




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
Route::get('post',[postController::class,'index'])->name('post.index');
//tambah data post
Route::get('post/create',[postController::class, 'create'])->name('post.create');
Route::post('post',[postController::class, 'store'])->name('post.store');
//edit data post
Route::get('post/{id}/edit', [postController::class, 'edit'])->name('post.edit');

Route::put('post/{id}', [postController::class, 'update'])->name('post.update');


//show data
Route::get('post/{id}', [postController::class, 'show'])->name('post.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::delete('post/{id]', [postController::class, 'delete'])->name('post.delete');

Route::resource('produk', App\Http\Controllers\ProdukController::class)->middleware('auth');


use App\Http\Controllers\BiodataController;
Route::resource('biodata', BiodataController::class);


// routes/web.php
use App\Http\Controllers\RelasiController;
Route::get('/one-to-one', [RelasiController::class, 'index']);

// routes/web.php
Route::get('/one-to-many', [RelasiController::class, 'oneToMany']);
// routes/web.php

Route::get('/many-to-many', [RelasiController::class, 'manyToMany']);

Route::get('eloquent', [RelasiController::class, 'eloquent']);


Route::resource('dosen', App\Http\Controllers\DosenController::class)->middleware('auth');


Route::resource('hobi', App\Http\Controllers\HobiController::class)->middleware('auth');

Route::resource('mahasiswa', App\Http\Controllers\MahasiswaController::class);

Route::prefix('latihan')->group(function () {
    Route::get('/transaksi/search', [TransaksiController::class, 'search'])->name('transaksi.search');
    Route::resource('pelanggan', App\Http\Controllers\PelangganController::class);
    Route::resource('produk', App\Http\Controllers\ProdukController::class);
    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class);
    Route::resource('pembayaran', App\Http\Controllers\PembayaranController::class);

})->middleware('auth');



