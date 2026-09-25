@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Prasarana</h1>

    <form action="{{ route('admin.prasarana.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="kode_prasarana">Kode Prasarana</label>
            <input type="text"
                   class="form-control"
                   id="kode_prasarana"
                   name="kode_prasarana"
                   required>
        </div>

        <div class="form-group mb-3">
            <label for="nama_prasarana">Nama Prasarana</label>
            <input type="text"
                   class="form-control"
                   id="nama_prasarana"
                   name="nama_prasarana"
                   required>
        </div>

        <div class="form-group mb-3">
            <label for="id_ruangan">Ruangan</label>
            <select name="id_ruangan"
                    id="id_ruangan"
                    class="form-select"
                    required>
                <option value="">-- Pilih Ruangan --</option>

                @foreach ($ruangan as $r)
                    <option value="{{ $r->id_ruangan }}">
                        {{ $r->nama_ruangan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="id_kondisi">Kondisi</label>
            <select name="id_kondisi"
                    id="id_kondisi"
                    class="form-select"
                    required>
                <option value="">-- Pilih Kondisi --</option>

                @foreach ($kondisi as $k)
                    <option value="{{ $k->id_kondisi }}">
                        {{ $k->nama_kondisi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="jumlah_prasarana">Jumlah Prasarana</label>
            <input type="number"
                   class="form-control"
                   id="jumlah_prasarana"
                   name="jumlah_prasarana"
                   min="1"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
    </form>
</div>
@endsection