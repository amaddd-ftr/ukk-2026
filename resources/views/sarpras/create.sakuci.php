@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Tambah Sarpras</h1><form action="{{ route('admin.sarpras.store') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label for="kode_sarpras">Kode Sarpras</label>
        <input
            type="text"
            class="form-control"
            id="kode_sarpras"
            name="kode_sarpras"
            required
        >
    </div>

    <div class="form-group mb-3">
        <label for="nama_sarpras">Nama Sarpras</label>
        <input
            type="text"
            class="form-control"
            id="nama_sarpras"
            name="nama_sarpras"
            required
        >
    </div>



    <div class="form-group mb-3">
        <label for="id_kategori">Kategori</label>
        <select
            name="id_kategori"
            id="id_kategori"
            class="form-select"
            required
        >
            <option value="">-- Pilih Kategori --</option>

            @foreach ($kategori as $k)
                <option value="{{ $k->id_kategori }}">
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="id_kondisi">Kondisi</label>
        <select
            name="id_kondisi"
            id="id_kondisi"
            class="form-select"
            required
        >
            <option value="">-- Pilih Kondisi --</option>

            @foreach ($kondisi as $k)
                <option value="{{ $k->id_kondisi }}">
                    {{ $k->nama_kondisi }}
                </option>
            @endforeach
        </select>
    </div>

    

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
</form>

</div>@endsection