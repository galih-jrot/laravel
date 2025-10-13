<!-- resources/views/biodata/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Biodata</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin:0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('biodata.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir') }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label><br>
            <label><input type="radio" name="jk" value="L" {{ old('jk') == 'L' ? 'checked' : '' }}> Laki-laki</label>
            <label class="ms-3"><input type="radio" name="jk" value="P" {{ old('jk') == 'P' ? 'checked' : '' }}> Perempuan</label>
        </div>

        <div class="mb-3">
            <label>Agama</label>
            <select name="agama" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach($agamaOptions as $agama)
                    <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Tinggi Badan (cm)</label>
            <input type="number" name="tinggi_badan" class="form-control" value="{{ old('tinggi_badan') }}">
        </div>

        <div class="mb-3">
            <label>Berat Badan (kg)</label>
            <input type="number" name="berat_badan" class="form-control" value="{{ old('berat_badan') }}">
        </div>

        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('biodata.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection