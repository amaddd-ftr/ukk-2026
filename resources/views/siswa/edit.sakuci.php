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
    <select name="kelas" id="kelas" value="{{ $siswa->kelas }}" class="form-select mb-3" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
    </select>


    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection