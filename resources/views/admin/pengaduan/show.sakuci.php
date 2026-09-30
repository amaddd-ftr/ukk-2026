@extends('layouts.app')

@section('title', config('app.name') . ' -- Detail Pengaduan')

@section('content')

<div class="container">

    <h1 class="h4 mb-4">Detail Pengaduan</h1>

    @php
    $namaSarpras = '-';
    $namaLokasi = '-';

    foreach ($sarpras as $item) {
        if ($item->id_sarpras == $pengaduan->id_sarpras) {
            $namaSarpras = $item->nama_sarpras;
            break;
        }
    }

    foreach ($lokasi as $item) {
        if ($item->id_lokasi == $pengaduan->id_lokasi) {
            $namaLokasi = $item->nama_lokasi;
            break;
        }
    }
@endphp

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="mb-3">
                <strong>Siswa</strong>
                <div>{{ $siswa->nama }}</div>
            </div>

            <div class="mb-3">
                <strong>Sarpras</strong>
                <div>{{ $namaSarpras }}</div>
            </div>

            <div class="mb-3">
                <strong>Lokasi</strong>
                <div>{{ $namaLokasi }}</div>
            </div>

            <div class="mb-3">
                <strong>Judul</strong>
                <div>{{ $pengaduan->judul }}</div>
            </div>

            <div class="mb-3">
                <strong>Deskripsi</strong>
                <div>{{ $pengaduan->deskripsi }}</div>
            </div>


            {{-- STATUS --}}
            <div class="mb-4">
                <strong>Status</strong>

                <form method="POST"
                      action="{{ route('admin.pengaduan.status', [
                          'id_pengaduan' => $pengaduan->id_pengaduan
                      ]) }}">

                    @csrf

                    <select name="id_status"
                            class="form-select mt-2"
                            required>

                        @foreach ($status as $item)
                            <option value="{{ $item->id_status }}"
                                {{ $pengaduan->id_status == $item->id_status ? 'selected' : '' }}>
                                {{ $item->nama_status }}
                            </option>
                        @endforeach

                    </select>

                    <button type="submit"
                            class="btn btn-primary mt-2">
                        Simpan Status
                    </button>

                </form>
            </div>


            {{-- TANGGAPAN --}}
            <div class="mb-4">
                <strong>Tanggapan Admin</strong>

                <form method="POST"
                      action="{{ route('admin.pengaduan.tanggapan', [
                          'id_pengaduan' => $pengaduan->id_pengaduan
                      ]) }}">

                    @csrf

                    <textarea name="tanggapan"
                              class="form-control mt-2"
                              rows="4"
                              placeholder="Tulis tanggapan untuk siswa..."
                              required>{{ $pengaduan->tanggapan }}</textarea>

                    <button type="submit"
                            class="btn btn-primary mt-2">
                        Simpan Tanggapan
                    </button>

                </form>
            </div>


            <div class="mb-3">
                <strong>Tanggal Pengaduan</strong>
                <div>{{ $pengaduan->created_at }}</div>
            </div>


            <a href="{{ route('admin.pengaduan.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>

</div>

@endsection