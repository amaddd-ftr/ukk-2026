@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<div class="container-fluid py-4">

    {{-- Header Admin --}}
    <div class="atas card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
                Area Admin
            </span>

            <h1 class="h4 mb-2">Halo, {{ $user->username }}</h1>

            <p class="text-secondary mb-0">
                Halaman ini hanya bisa diakses role
                <code class="inline">admin</code>
                (middleware <code class="inline">admin</code>).
            </p>
        </div>
    </div>

    {{-- Download Database --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <a href="{{ route('admin.database.export') }}"
               class="card border-0 shadow-sm text-decoration-none h-100">
                <div class="card-body p-4">
                    <h2 class="h6 mb-1">Download Database</h2>
                    <p class="text-secondary small mb-0">
                        Unduh seluruh isi database jadi satu file .sql,
                        siap diimpor di server.
                    </p>
                </div>
            </a>
        </div>
    </div>

    {{-- Tabel Pengaduan Belum Ditangani --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <div>
                    <h2 class="h5 mb-1">Pengaduan Belum Ditangani</h2>
                    <p class="text-secondary small mb-0">
                        Daftar pengaduan berstatus Menunggu.
                    </p>
                </div>

                <a href="{{ route('pengaduan.index') }}"
                   class="btn btn-outline-primary btn-sm">
                    Lihat Semua
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Pengaduan</th>
                            <th>Siswa</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                  @php
                  $no = 1;
                  @endphp

                    <tbody>
                        @forelse ($pengaduanTerbaru as $item)
                            <tr>
                                <td>{{ $no++ }}</td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $item->judul }}
                                    </div>
                                    <div class="text-secondary small">
                                       {{ strlen($item->deskripsi ?? '') > 60
    ? substr($item->deskripsi, 0, 60) . '...'
    : ($item->deskripsi ?? '-') }}
                                    </div>
                                </td>

                                <td>
                                    {{ $item->nama ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->nama_lokasi ?? '-' }}
                                </td>

                                <td>
                                    {{ isset($item->created_at) ? $item->created_at : '-' }}
                                </td>

                                <td>
                                    <span class="badge bg-warning text-dark">
                                        Menunggu
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.pengaduan.show', ['id_pengaduan' => $item->id_pengaduan]) }}"
                                       class="btn btn-primary btn-sm">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-secondary py-4">
                                    Belum ada pengaduan yang menunggu penanganan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection