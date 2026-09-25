@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Prasarana</h1>

    <form action="{{ route('admin.prasarana.update', ['id_prasarana' => $prasarana->id_prasarana]) }}"
          method="POST">

        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="kode_prasarana">Kode Prasarana</label>
            <input type="text"
                   name="kode_prasarana"
                   id="kode_prasarana"
                   value="{{ $prasarana->kode_prasarana }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label for="nama_prasarana">Nama Prasarana</label>
            <input type="text"
                   name="nama_prasarana"
                   id="nama_prasarana"
                   value="{{ $prasarana->nama_prasarana }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label for="id_ruangan">Ruangan</label>
            <select name="id_ruangan"
                    id="id_ruangan"
                    class="form-select"
                    required>

                <option value="">-- Pilih Ruangan --</option>

                @foreach ($ruangan as $r)
                    <option value="{{ $r->id_ruangan }}"
                        {{ $prasarana->id_ruangan == $r->id_ruangan ? 'selected' : '' }}>
                        {{ $r->nama_ruangan }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label for="id_kondisi">Kondisi</label>
            <select name="id_kondisi"
                    id="id_kondisi"
                    class="form-select"
                    required>

                <option value="">-- Pilih Kondisi --</option>

                @foreach ($kondisi as $k)
                    <option value="{{ $k->id_kondisi }}"
                        {{ $prasarana->id_kondisi == $k->id_kondisi ? 'selected' : '' }}>
                        {{ $k->nama_kondisi }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah_prasarana">Jumlah Prasarana</label>
            <input type="number"
                   name="jumlah_prasarana"
                   id="jumlah_prasarana"
                   value="{{ $prasarana->jumlah_prasarana }}"
                   min="1"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
    </form>
</div>
@endsection