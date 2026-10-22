@extends('layouts.app')

@section('title', config('app.name') . ' -- Pengaduan')

@section('content')

<div class="container">

    <h1 class="h4 mb-4">Daftar Pengaduan</h1>

    {{-- FILTER DAN PENCARIAN --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('admin.pengaduan.index') }}">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Pencarian</label>
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Nama siswa, judul, sarpras..."
                            value="{{ $search }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Siswa</label>
                        <select name="id_siswa" class="form-select">
                            <option value="">Semua Siswa</option>
                            @foreach ($siswa as $item)
                                <option
                                    value="{{ $item->id_siswa }}"
                                    {{ (string) $filterSiswa === (string) $item->id_siswa ? 'selected' : '' }}
                                >
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal</label>
                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            value="{{ $tanggal }}"
                        >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Bulan</label>
                        <input
                            type="month"
                            name="bulan"
                            class="form-control"
                            value="{{ $bulan }}"
                        >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategori as $item)
                                <option
                                    value="{{ $item->id_kategori }}"
                                    {{ (string) $filterKategori === (string) $item->id_kategori ? 'selected' : '' }}
                                >
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="id_status" class="form-select">
                            <option value="">Semua Status</option>
                            @foreach ($status as $item)
                                <option
                                    value="{{ $item->id_status }}"
                                    {{ (string) $filterStatus === (string) $item->id_status ? 'selected' : '' }}
                                >
                                    {{ $item->nama_status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Urutkan</label>
                        <select name="sort" class="form-select">
                            <option value="terbaru" {{ $sort === 'terbaru' ? 'selected' : '' }}>
                                Tanggal Terbaru
                            </option>
                            <option value="terlama" {{ $sort === 'terlama' ? 'selected' : '' }}>
                                Tanggal Terlama
                            </option>
                            <option value="nama_az" {{ $sort === 'nama_az' ? 'selected' : '' }}>
                                Nama Siswa A-Z
                            </option>
                            <option value="nama_za" {{ $sort === 'nama_za' ? 'selected' : '' }}>
                                Nama Siswa Z-A
                            </option>
                        </select>
                    </div>

                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Cari / Filter
                        </button>

                        <a
                            href="{{ route('admin.pengaduan.index') }}"
                            class="btn btn-secondary"
                        >
                            Reset
                        </a>
                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- JUMLAH DATA --}}
    <div class="mb-3 text-secondary">
        Ditemukan {{ $totalData }} pengaduan.
    </div>

    {{-- TABEL --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Nama Sarpras</th>
                    <th>Kategori</th>
                    <th>Nama Lokasi</th>
                    <th>Judul</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @if (count($pengaduan) > 0)

                    @php
                        $no = (($halaman - 1) * 10) + 1;
                    @endphp

                    @foreach ($pengaduan as $x)

                        @php
                            $foto = trim($x->foto ?? '');

                            if ($foto !== '') {
                                $foto = ltrim($foto, '/');

                                if (strpos($foto, 'uploads/pengaduan/') !== 0) {
                                    $foto = 'uploads/pengaduan/' . $foto;
                                }
                            }
                        @endphp

                        <tr>
                            <td>{{ $no++ }}</td>

                            <td>{{ $x->nama_siswa }}</td>

                            <td>{{ $x->nama_sarpras }}</td>

                            <td>{{ $x->nama_kategori }}</td>

                            <td>{{ $x->nama_lokasi }}</td>

                            <td>{{ $x->judul }}</td>

                            <td>
                                @if ($foto !== '')
                                    <a href="{{ asset($foto) }}" target="_blank">
                                        <img
                                            src="{{ asset($foto) }}"
                                            alt="Foto pengaduan"
                                            width="80"
                                            height="60"
                                            style="object-fit: cover; border-radius: 6px;"
                                        >
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>

                            <td>{{ $x->nama_status }}</td>

                            <td>{{ $x->created_at }}</td>

                            <td>
                                <a
                                    href="{{ route('admin.pengaduan.show', [
                                        'id_pengaduan' => $x->id_pengaduan
                                    ]) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Lihat
                                </a>
                            </td>
                        </tr>

                    @endforeach

                @else
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            Tidak ada pengaduan yang cocok dengan filter.
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if ($totalHalaman > 1)
        <nav aria-label="Navigasi halaman">
            <ul class="pagination">

                @if ($halaman > 1)
                    <li class="page-item">
                        <a
                            class="page-link"
                            href="?{{ http_build_query(array_merge($_GET, ['page' => $halaman - 1])) }}"
                        >
                            Sebelumnya
                        </a>
                    </li>
                @endif

                @for ($i = 1; $i <= $totalHalaman; $i++)
                    <li class="page-item {{ $halaman === $i ? 'active' : '' }}">
                        <a
                            class="page-link"
                            href="?{{ http_build_query(array_merge($_GET, ['page' => $i])) }}"
                        >
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if ($halaman < $totalHalaman)
                    <li class="page-item">
                        <a
                            class="page-link"
                            href="?{{ http_build_query(array_merge($_GET, ['page' => $halaman + 1])) }}"
                        >
                            Berikutnya
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    @endif

</div>

@endsection