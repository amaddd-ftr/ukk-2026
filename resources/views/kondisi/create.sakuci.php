@extends ('layouts.app')
@section ('content')

<div class="container">
    <h1>Tambah Kondisi</h1>
    <form action="{{ route('admin.kondisi.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama_kondisi">Nama Kondisi</label>
            <input type="text" class="form-control" id="nama_kondisi" name="nama_kondisi" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
