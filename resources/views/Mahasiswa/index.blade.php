@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Mahasiswa') }}</span>
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-outline-primary">Tambah Data</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>No Induk Mahasiswa</th>
                                    <th>Nama Dosen</th>
                                    <th>Hobi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($mahasiswas as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->nim }}</td>
                                    <td>{{ optional($data->dosen)->nama ?? 'Belum ada dosen' }}</td>
                                    <td>
                                        @forelse ($data->hobis as $hobi)
                                            <span class="badge bg-info text-dark">{{ $hobi->nama }}</span>
                                        @empty
                                            <span class="text-muted">Tidak ada</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        <form action="{{ route('mahasiswa.destroy', $data->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('mahasiswa.show', $data->id) }}" class="btn btn-sm btn-outline-dark">Show</a>
                                            <a href="{{ route('mahasiswa.edit', $data->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Data belum tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
