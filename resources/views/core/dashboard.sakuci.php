@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid py-4">

    {{-- Header Dashboard --}}
    <div class="dashboard-header">

        <div class="dashboard-header-content">

            <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
                Role: {{ $user->role }}
            </span>

            <h1>
                Halo, {{ $siswa->nama }} 👋
            </h1>

            <p>
                Selamat datang di dashboard pengaduan sarana dan prasarana sekolah.
            </p>

            <a href="#"
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