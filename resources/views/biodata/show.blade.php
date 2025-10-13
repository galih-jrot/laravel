<!-- resources/views/biodata/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Biodata</h3>

    <a href="{{ route('biodata.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <table class="table table-striped">
        <tr><th>Nama</th><td>{{ $item->nama }}</td></tr>
        <tr><th>Tanggal Lahir</th><td>{{ $item->tgl_lahir }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $item->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
        <tr><th>Agama</th><td>{{ $item->agama }}</td></tr>
        <tr><th>Alamat</th><td>{{ $item->alamat }}</td></tr>
        <tr><th>Tinggi Badan</th><td>{{ $item->tinggi_badan }} cm</td></tr>
        <tr><th>Berat Badan</th><td>{{ $item->berat_badan }} kg</td></tr>
        <tr><th>Foto</th>
            <td>
                @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" width="150" alt="foto">
                @else
                    -
                @endif
            </td>
        </tr>
    </table>
</div>
@endsection