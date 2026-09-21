@extends('layouts.app')

@section('content')
<form action="{{ route('admin.siswa.update', ['id_siswa' => $siswa->id_siswa]) }}" method="post" class="d-flex flex-column form-horizontal">
    @csrf
    @method('POST')

    <label>Nama</label>    
    <input type="text" name="nama" value="{{ $siswa->nama }}" class="form-control mb-3" required>
    <label>Nis</label>
    <input type="text" name="nis" value="{{ $siswa->nis }}" class="form-control mb-3" required>
    <label>Kelas</label>
    <input type="text" name="kelas" value="{{ $siswa->kelas }}" class="form-control mb-3" required>


    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection