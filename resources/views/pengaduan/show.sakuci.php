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

            <div class="mb-3">
                <strong>Status</strong>
                <div>{{ $namaStatus }}</div>
            </div>

            <div class="mb-3">
                <strong>Tanggal</strong>
                <div>{{ $pengaduan->created_at }}</div>
            </div>

            <a href="{{ route('pengaduan.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>

</div>

@endsection