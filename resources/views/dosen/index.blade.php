
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg border-0">
                <div class="card-header d-flex justify-content-between align-items-center text-white" 
                     style="background: linear-gradient(90deg, #007bff, #6610f2);">
                    <h5 class="mb-0">{{ __('Daftar Dosen') }}</h5>
                    <a href="{{ route('dosen.create') }}" class="btn btn-sm btn-light text-primary fw-bold">
                        <i class="bi bi-plus-circle"></i> Tambah Data
                    </a>
                </div>

                <div class="card-body" style="background-color: #f8f9fa;">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="text-white" style="background-color: #6f42c1;">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIPD</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($dosen as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->nipd }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('dosen.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('dosen.edit', $data->id) }}" class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        <em>Data dosen belum tersedia.</em>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $dosen->withQueryString()->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center text-muted small">
                    © {{ date('Y') }} - Sistem Data Dosen
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
