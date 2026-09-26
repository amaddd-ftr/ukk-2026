@extends('layouts.app')

@section('content')

<form action="{{ route('admin.sarpras.update', ['id_sarpras' => $sarpras->id_sarpras]) }}"
      method="post"
      class="d-flex flex-column form-horizontal">@csrf
@method('POST')

<label>Kode Sarpras</label>
<input type="text"
       name="kode_sarpras"
       value="{{ $sarpras->kode_sarpras }}"
       class="form-control mb-3"
       required>

<label>Nama Sarpras</label>
<input type="text"
       name="nama_sarpras"
       value="{{ $sarpras->nama_sarpras }}"
       class="form-control mb-3"
       required>


<label>Kategori</label>
<select name="id_kategori"
        id="id_kategori"
        class="form-select mb-3"
        required>

    <option value="">-- Pilih Kategori --</option>

    @foreach ($kategori as $k)
        <option value="{{ $k->id_kategori }}"
            {{ $sarpras->id_kategori == $k->id_kategori ? 'selected' : '' }}>
            {{ $k->nama_kategori }}
        </option>
    @endforeach

</select>

<label>Kondisi</label>
<select name="id_kondisi"
        id="id_kondisi"
        class="form-select mb-3"
        required>

    <option value="">-- Pilih Kondisi --</option>

    @foreach ($kondisi as $k)
        <option value="{{ $k->id_kondisi }}"
            {{ $sarpras->id_kondisi == $k->id_kondisi ? 'selected' : '' }}>
            {{ $k->nama_kondisi }}
        </option>
    @endforeach

</select>

<button type="submit" class="btn btn-primary">
    Simpan
</button>

</form>@endsection