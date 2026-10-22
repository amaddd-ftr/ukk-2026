@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid py-4">

    {{-- Header Dashboard --}}
    <div class="dashboard-header">

        <div class="dashboard-header-content">

            <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
    @if ($siswa)
        Siswa
    @else
        Admin
    @endif
</span>

<h1>
    Halo, {{ $siswa->nama ?? $user->username }} 👋
</h1>


            <p>
                Selamat datang di dashboard pengaduan sarana dan prasarana sekolah.
            </p>

            <a href="{{ route('pengaduan.create') }}"
               class="btn btn-brand">
                + Buat Pengaduan
            </a>

        </div>

        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>

    </div>


    {{-- Statistik --}}
    <div class="row g-3 mb-4">

        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-secondary mb-1">
                        Total Pengaduan
                    </p>

                    <h2 class="fw-bold mb-0">
                        0
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-secondary mb-1">
                        Menunggu
                    </p>

                    <h2 class="fw-bold mb-0">
                        0
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
           
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid py-4">

    {{-- Header Dashboard --}}
    <div class="dashboard-header">
        <div class="dashboard-header-content">

            <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
                Siswa
            </span>

            <h1>
                Halo, {{ $siswa->nama ?? $user->username }} 👋
            </h1>

            <p>
                Selamat datang di dashboard pengaduan sarana dan prasarana sekolah.
            </p>

            <a href="{{ route('pengaduan.create') }}"
               class="btn btn-brand">
                + Buat Pengaduan
            </a>

        </div>

        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
    </div>



    {{-- Pengaduan Terbaru Siswa --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div>
                    <h5 class="fw-bold mb-1">
                        Pengaduan Saya
                    </h5>

                    <p class="text-secondary small mb-0">
                        Maksimal 3 pengaduan terbaru yang kamu kirim.
                    </p>
                </div>

                <a href="{{ route('pengaduan.index') }}"
                   class="btn btn-outline-brand btn-sm">
                    Lihat Semua
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengaduan</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
@php
                  $no =1;
                  @endphp
                    <tbody>
                        @forelse ($pengaduanTerbaru as $item)

                            <tr>
                                <td>
                                    {{ $no++ }}
                                </td>

                                <td>
                                    <a
                                        href="{{ route('pengaduan.show', [
                                            'id_pengaduan' => $item->id_pengaduan
                                        ]) }}"
                                        class="text-decoration-none fw-semibold"
                                    >
                                        {{ $item->judul }}
                                    </a>
                                </td>

                                <td>
                                    @php
                                        $namaLokasi = '-';
                                    @endphp

                                    @foreach ($lokasi as $itemLokasi)
                                        @if ($itemLokasi->id_lokasi == $item->id_lokasi)
                                            @php
                                                $namaLokasi = $itemLokasi->nama_lokasi;
                                            @endphp
                                            @break
                                        @endif
                                    @endforeach

                                    {{ $namaLokasi }}
                                </td>

                                <td>
                                    @php
                                        $namaStatus = '-';
                                    @endphp

                                    @foreach ($status as $itemStatus)
                                        @if ($itemStatus->id_status == $item->id_status)
                                            @php
                                                $namaStatus = $itemStatus->nama_status;
                                            @endphp
                                            @break
                                        @endif
                                    @endforeach

                                    <span class="badge rounded-pill
                                        @if ($namaStatus == 'Menunggu')
                                            text-bg-warning
                                        @elseif ($namaStatus == 'Diproses')
                                            text-bg-primary
                                        @elseif ($namaStatus == 'Selesai')
                                            text-bg-success
                                        @else
                                            text-bg-secondary
                                        @endif
                                    ">
                                        {{ $namaStatus }}
                                    </span>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4"
                                    class="text-center text-secondary py-4">
                                    Belum ada pengaduan.
                                    <div class="mt-2">
                                        <a href="{{ route('pengaduan.create') }}"
                                           class="btn btn-brand btn-sm">
                                            Buat Pengaduan
                                        </a>
                                    </div>
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
     <div class="card-body">
                    <p class="text-secondary mb-1">
                        Diproses
                    </p>

                    <h2 class="fw-bold mb-0">
                        0
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-secondary mb-1">
                        Selesai
                    </p>

                    <h2 class="fw-bold mb-0">
                        0
                    </h2>
                </div>
            </div>
        </div>

    </div>


    {{-- Pengaduan Saya --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between
                        align-items-center mb-3">

                <h5 class="fw-bold mb-0">
                    Pengaduan Saya
                </h5>

                <a href="#"
                   class="btn btn-outline-brand btn-sm">
                    Lihat Semua
                </a>

            </div>

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengaduan</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td colspan="4"
                                class="text-center text-secondary py-4">
                                Belum ada pengaduan.
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection