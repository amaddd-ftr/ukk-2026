@extends ('layouts.app')
@section ('content')

<div class="container">
    <h1>Tambah Gedung</h1>
    <form action="{{ route('admin.gedung.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama_gedung">Nama Gedung</label>
            <input type="text" class="form-control" id="nama_gedung" name="nama_gedung" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
