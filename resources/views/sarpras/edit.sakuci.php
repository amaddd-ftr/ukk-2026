@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Edit Sarpras</h1>

    <form action="{{ route('admin.sarpras.update', ['id_sarpras' => $sarpras->id_sarpras]) }}"
          method="POST"
          class="d-flex flex-column form-horizontal">
        @csrf
        @method('PUT')

        <label for="kode_sarpras">Kode Sarpras</label>
        <input type="text"
               id="kode_sarpras"
               name="kode_sarpras"
               value="{{ $sarpras->kode_sarpras }}"
               class="form-control mb-3"
               required>

        <label for="nama_sarpras">Nama Sarpras</label>
        <input type="text"
               id="nama_sarpras"
               name="nama_sarpras"
               value="{{ $sarpras->nama_sarpras }}"
               class="form-control mb-3"
               required>

        <label for="id_kategori">Kategori</label>
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

        <!-- Dropdown Lokasi Baru -->
        <label for="id_lokasi">Lokasi</label>
        <select name="id_lokasi"
                id="id_lokasi"
                class="form-select mb-3"
                required>
            <option value="">-- Pilih Lokasi --</option>
            @foreach ($lokasi as $l)
                <option value="{{ $l->id_lokasi }}"
                    {{ $sarpras->id_lokasi == $l->id_lokasi ? 'selected' : '' }}>
                    {{ $l->nama_lokasi }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
    </form>
</div>
@endsection
