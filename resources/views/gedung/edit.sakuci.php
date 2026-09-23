@extends('layouts.app')

@section('content')
<form action="{{ route('admin.gedung.update', ['id_gedung' => $gedung->id_gedung]) }}" method="post" class="d-flex flex-column form-horizontal">
    @csrf
    @method('POST')

    <label>Nama Gedung</label>    
    <input type="text" name="nama_gedung" value="{{ $gedung->nama_gedung }}" class="form-control mb-3" required>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection