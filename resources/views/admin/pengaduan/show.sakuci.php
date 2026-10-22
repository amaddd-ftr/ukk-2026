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

        // Normalisasi path foto
        $foto = trim($pengaduan->foto ?? '');

        if ($foto !== '') {
            $foto = ltrim($foto, '/');

            // Hapus prefix berulang jika ada
            while (strpos($foto, 'uploads/pengaduan/uploads/pengaduan/') === 0) {
                $foto = substr(
                    $foto,
                    strlen('uploads/pengaduan/')
                );
            }

            // Tambahkan folder jika database hanya menyimpan nama file
            if (strpos($foto, 'uploads/pengaduan/') !== 0) {
                $foto = 'uploads/pengaduan/' . $foto;
            }
        }

        $urlFoto = $foto !== '' ? asset($foto) : '';
    @endphp

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            {{-- INFORMASI SISWA --}}
            <div class="mb-3">
                <strong>Siswa</strong>
                <div>{{ $siswa->nama ?? '-' }}</div>
            </div>

            {{-- SARPRAS --}}
            <div class="mb-3">
                <strong>Sarpras</strong>
                <div>{{ $namaSarpras }}</div>
            </div>

            {{-- LOKASI --}}
            <div class="mb-3">
                <strong>Lokasi</strong>
                <div>{{ $namaLokasi }}</div>
            </div>

            {{-- JUDUL --}}
            <div class="mb-3">
                <strong>Judul</strong>
                <div>{{ $pengaduan->judul ?? '-' }}</div>
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-3">
                <strong>Deskripsi</strong>
                <div style="white-space: pre-wrap;">{{ $pengaduan->deskripsi ?? '-' }}</div>
            </div>

            {{-- FOTO BUKTI --}}
            <div class="mb-4">
                <strong>Foto Bukti Pengaduan</strong>

                @if ($foto !== '')
                    <div class="mt-2">
                        <a href="{{ $urlFoto }}" target="_blank">
                            <img
                                src="{{ $urlFoto }}"
                                alt="Foto Bukti Pengaduan"
                                class="img-fluid rounded border"
                                style="max-width: 100%; max-height: 400px; object-fit: contain;"
                                onerror="this.style.display='none'; document.getElementById('foto-error').style.display='block';"
                            >
                        </a>

                        <div
                            id="foto-error"
                            class="alert alert-warning mt-2"
                            style="display: none;"
                        >
                            Foto gagal dimuat. File mungkin tidak ditemukan
                            atau URL foto tidak sesuai dengan lokasi file.
                        </div>

                        <div class="form-text text-secondary mt-1">
                            Klik gambar untuk memperbesar.
                        </div>
                    </div>
                @else
                    <div class="alert alert-secondary mt-2">
                        Tidak ada path foto yang tersimpan pada pengaduan ini.
                    </div>
                @endif
            </div>

            {{-- STATUS --}}
            <div class="mb-4">
                <strong>Status Pengaduan</strong>

                <form
                    method="POST"
                    action="{{ route('admin.pengaduan.status', [
                        'id_pengaduan' => $pengaduan->id_pengaduan
                    ]) }}"
                >
                    @csrf

                    <select
                        name="id_status"
                        class="form-select mt-2"
                        required
                    >
                        @foreach ($status as $item)
                            <option
                                value="{{ $item->id_status }}"
                                {{ $pengaduan->id_status == $item->id_status ? 'selected' : '' }}
                            >
                                {{ $item->nama_status }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary mt-2">
                        Simpan Status
                    </button>
                </form>
            </div>

            {{-- TANGGAPAN ADMIN --}}
            <div class="mb-4">
                <strong>Tanggapan Admin</strong>

                <form
                    method="POST"
                    action="{{ route('admin.pengaduan.tanggapan', [
                        'id_pengaduan' => $pengaduan->id_pengaduan
                    ]) }}"
                >
                    @csrf

                    <textarea
                        name="tanggapan"
                        class="form-control mt-2"
                        rows="4"
                        placeholder="Tulis tanggapan untuk siswa..."
                        required
                    >{{ $pengaduan->tanggapan ?? '' }}</textarea>

                    <button type="submit" class="btn btn-primary mt-2">
                        Simpan Tanggapan
                    </button>
                </form>
            </div>

            {{-- TANGGAL --}}
            <div class="mb-3">
                <strong>Tanggal Pengaduan</strong>
                <div>{{ $pengaduan->created_at ?? '-' }}</div>
            </div>

            {{-- KEMBALI --}}
            <a
                href="{{ route('admin.pengaduan.index') }}"
                class="btn btn-secondary"
            >
                Kembali
            </a>

        </div>
    </div>

</div>

@endsection