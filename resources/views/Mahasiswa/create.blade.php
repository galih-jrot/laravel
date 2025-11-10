@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Tambah Data Mahasiswa
                </div>
                <div class="card-body">
                    <form action="{{ route('mahasiswa.store') }}" method="POST">
                        @csrf

                        {{-- Nama Mahasiswa --}}
                        <div class="mb-3">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" name="nama" id="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama') }}">
                            @error('nama')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- NIM --}}
                        <div class="mb-3">
                            <label for="nim">Nomor Induk Mahasiswa</label>
                            <input type="text" name="nim" id="nim"
                                   class="form-control @error('nim') is-invalid @enderror"
                                   value="{{ old('nim') }}">
                            @error('nim')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- Kelas --}}
                        <div class="mb-3">
                            <label for="kelas">Kelas</label>
                            <input type="text" name="kelas" id="kelas"
                                   class="form-control @error('kelas') is-invalid @enderror"
                                   value="{{ old('kelas') }}">
                            @error('kelas')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- Dosen --}}
                        <div class="mb-3">
                            <label for="id_dosen">Dosen Pembimbing</label>
                            <select name="id_dosen" id="id_dosen"
                                    class="form-control @error('id_dosen') is-invalid @enderror">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach ($dosen as $data)
                                    <option value="{{ $data->id }}" {{ old('id_dosen') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_dosen')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- Hobi --}}
                        <div class="mb-3">
                            <label for="hobi">Pilih Hobi</label>
                            <select name="hobi[]" id="hobi" class="form-control js-multiple" multiple>
                                @foreach ($hobi as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_hobi }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tombol --}}
                        <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection