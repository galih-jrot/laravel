@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Tambah Hobi</div>
                <div class="card-body">
                    <form action="{{ route('hobi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Hobi</label>
                            <input type="text" name="nama_hobi" class="form-control @error('nama_hobi') is-invalid @enderror" value="{{ old('nama_hobi') }}" placeholder="Contoh: Membaca">
                            @error('nama_hobi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('hobi.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection