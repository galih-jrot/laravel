@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <fieldset>
              <legend>tambah data post</legend>
              <form action="{{ Route ('post.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="">title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="">content</label>
                    <textarea name="content" class="form-control" required></textarea>
                </div>
                <div class="mb3">
                    <button type="submit" class="btn btn-primary">simpan</button>
                </div>
            </fieldset>
        </div>
    </div>
</div>
@endsection