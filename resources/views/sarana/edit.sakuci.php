@extends('layouts.app')

@section('content')

<form action="{{ route('admin.sarana.update', ['id_sarana' => $sarana->id_sarana]) }}"
      method="post"
      class="d-flex flex-column form-horizontal">

    @csrf
    @method('POST')

    <label>Kode Sarana</label>
    <input type="text"
           name="kode_sarana"
           value="{{ $sarana->kode_sarana }}"
           class="form-control mb-3"
           required>

    <label>Nama Sarana</label>
    <input type="text"
           name="nama_sarana"
           value="{{ $sarana->nama_sarana }}"
           class="form-control mb-3"
           required>

    <label>Ruangan</label>
    <select name="id_ruangan"
            id="id_ruangan"
            class="form-select mb-3"
            required>

        <option value="">-- Pilih Ruangan --</option>

        @foreach ($ruangan as $r)
            <option value="{{ $r->id_ruangan }}"
                {{ $sarana->id_ruangan == $r->id_ruangan ? 'selected' : '' }}>
                {{ $r->nama_ruangan }}
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
                {{ $sarana->id_kondisi == $k->id_kondisi ? 'selected' : '' }}>
                {{ $k->nama_kondisi }}
            </option>
        @endforeach

    </select>

    <label>Jumlah Sarana</label>
    <input type="number"
           name="jumlah_sarana"
           value="{{ $sarana->jumlah_sarana }}"
           min="1"
           class="form-control mb-3"
           required>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>

</form>

@endsection