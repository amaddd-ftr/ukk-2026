@extends('layouts.app')

@section('title', config('app.name') . ' -- Detail Pengaduan')

@section('content')

<div class="container">

    <h1 class="h4 mb-4">Detail Pengaduan</h1>

    @php
        $namaSarpras = '-';
        $namaLokasi = '-';
        $namaStatus = '-';

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

        foreach ($status as $item) {
            if ($item->id_status == $pengaduan->id_status) {
                $namaStatus = $item->nama_status;
                break;
            }
        }

        // Siapkan path foto
        $foto = trim($pengaduan->foto ?? '');

        if ($foto !== '') {
            $foto = ltrim($foto, '/');

            // Hindari folder uploads/pengaduan yang berulang
            if (strpos($foto, 'uploads/pengaduan/') !== 0) {
                $foto = 'uploads/pengaduan/' . $foto;
            }
        }
    @endphp

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            {{-- Data siswa --}}
            <div class="mb-3">
                <strong>Siswa</strong>
                <div>{{ $siswa->nama ?? '-' }}</div>
            </div>

            {{-- Data sarpras --}}
            <div class="mb-3">
                <strong>Sarpras</strong>
                <div>{{ $namaSarpras }}</div>
            </div>

            {{-- Data lokasi --}}
            <div class="mb-3">
                <strong>Lokasi</strong>
                <div>{{ $namaLokasi }}</div>
            </div>

            {{-- Judul --}}
            <div class="mb-3">
                <strong>Judul</strong>
                <div>{{ $pengaduan->judul ?? '-' }}</div>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <strong>Deskripsi</strong>
                <div style="white-space: pre-wrap;">{{ $pengaduan->deskripsi ?? '-' }}</div>
            </div>

            {{-- Foto bukti --}}
            <div class="mb-3">
                <strong>Foto Bukti</strong>

                @if ($foto !== '')
                    <div class="mt-2">

                        <a href="{{ asset($foto) }}" target="_blank">
                            <img
                                src="{{ asset($foto) }}"
                                alt="Foto Bukti Pengaduan"
                                class="img-fluid rounded border"
                                style="max-width: 100%; max-height: 350px; object-fit: contain;"
                                onerror="this.style.display='none'; document.getElementById('foto-gagal').style.display='block';"
                            >
                        </a>

                        <div
                            id="foto-gagal"
                            class="alert alert-warning mt-2"
                            style="display: none;"
                        >
                            Foto gagal dimuat. Periksa path foto di database
                            dan lokasi file pada hosting.
                        </div>

                        <div class="form-text text-secondary mt-1">
                            Klik gambar untuk melihat ukuran penuh.
                        </div>

                    </div>
                @else
                    <div class="text-muted mt-1">
                        Tidak ada foto yang dilampirkan.
                    </div>
                @endif
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <strong>Status</strong>
                <div>{{ $namaStatus }}</div>
            </div>

            {{-- Tanggapan admin --}}
            <div class="mb-3">
                <strong>Tanggapan Admin</strong>
                <div style="white-space: pre-wrap;">{{ $pengaduan->tanggapan ?? 'Belum ada tanggapan' }}</div>
            </div>

            {{-- Tanggal --}}
            <div class="mb-3">
                <strong>Tanggal</strong>
                <div>{{ $pengaduan->created_at ?? '-' }}</div>
            </div>

            {{-- Tombol kembali --}}
            <a
                href="{{ route('pengaduan.index') }}"
                class="btn btn-secondary"
            >
                Kembali
            </a>

        </div>
    </div>

</div>

@endsection