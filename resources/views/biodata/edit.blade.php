<!-- resources/views/biodata/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Biodata</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin:0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('biodata.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $item->nama) }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $item->tgl_lahir->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label><br>
            <label><input type="radio" name="jk" value="L" {{ old('jk', $item->jk) == 'L' ? 'checked' : '' }}> Laki-laki</label>
            <label class="ms-3"><input type="radio" name="jk" value="P" {{ old('jk', $item->jk) == 'P' ? 'checked' : '' }}> Perempuan</label>
        </div>

        <div class="mb-3">
            <label>Agama</label>
            <select name="agama" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach($agamaOptions as $agama)
                    <option value="{{ $agama }}" {{ old('agama', $item->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat', $item->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Tinggi Badan (cm)</label>
            <input type="number" name="tinggi_badan" class="form-control" value="{{ old('tinggi_badan', $item->tinggi_badan) }}">
        </div>

        <div class="mb-3">
            <label>Berat Badan (kg)</label>
            <input type="number" name="berat_badan" class="form-control" value="{{ old('berat_badan', $item->berat_badan) }}">
        </div>

        <div class="mb-3">
            <label>Foto</label>
            @if($item->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $item->foto) }}" width="120" alt="foto">
                </div>
            @endif
            <input type="file" name="foto" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('biodata.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection