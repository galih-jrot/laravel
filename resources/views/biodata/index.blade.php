<!-- resources/views/biodata/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('biodata.create') }}" class="btn btn-primary mb-3">Tambah Biodata</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>JK</th>
                <th>Agama</th>
                <th>Tinggi (cm)</th>
                <th>Berat (kg)</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $item)
            <tr>
                <td>{{ $items->firstItem() + $i }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->tgl_lahir }}</td>
                <td>{{ $item->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $item->agama }}</td>
                <td>{{ $item->tinggi_badan }}</td>
                <td>{{ $item->berat_badan }}</td>
                <td>
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="foto" width="80">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('biodata.show', $item->id) }}" class="btn btn-sm btn-info">Lihat</a>
                    <a href="{{ route('biodata.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('biodata.destroy', $item->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin dihapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $items->links() }}
</div>
@endsection