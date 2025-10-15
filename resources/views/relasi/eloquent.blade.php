@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="col-md-10 mx-auto">
        <h2 class="text-center mb-4">Halo Eloquent 🚀🚀</h2>

        @foreach ($mahasiswas as $temp)
            <div class="card mb-4 border rounded-3 shadow-sm p-3">
                <h3 class="fw-bold">
                    {{ $temp->nama }}
                    <small class="text-muted">({{ $temp->nim }})</small>
                </h3>

                <p class="text-secondary">Kelas: {{ $temp->kelas }}</p>

                <h5>Hobi:</h5>
                <ul>
                    @forelse ($temp->hobis as $tampung)
                        <li>{{ $tampung->nama_hobi }}</li>
                    @empty
                        <li><em>Belum punya hobi</em></li>
                    @endforelse
                </ul>

                <div class="mt-3">
                    <ul>
                        <li>Nama Wali: <strong>{{$temp->wali->nama ?? '-'}}</strong></li>
                        <li>Dosen Pembimbing: <strong>{{ $temp->dosen->nama ?? '-' }}</strong></li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection