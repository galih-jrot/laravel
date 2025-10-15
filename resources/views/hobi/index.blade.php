@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Hobi</h3>
        <a href="{{ route('hobi.create') }}" class="btn btn-primary">Tambah Hobi</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>o</th>
                            <th>Nama Hobi</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hobis as $hobi)
                            <tr>
                                <td>{{ $loop->iteration + ($hobis->currentPage()-1)*$hobis->perPage() }}</td>
                                <td>{{ $hobi->nama_hobi }}</td>
                                <td>{{ $hobi->created_at?->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('hobi.show', $hobi->id) }}" class="btn btn-sm btn-info">Show</a>
                                    <a href="{{ route('hobi.edit', $hobi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('hobi.destroy', $hobi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus hobi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $hobis->links() }}
    </div>
</div>
@endsection