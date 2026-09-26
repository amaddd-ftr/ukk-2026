@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    {{-- Hero --}}
<header class="masthead text-center text-white">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="display-5 fw-bold mb-3 ">
            Pengaduan Sarana & Prasarana,<br class="d-none d-md-inline">
            <span class="text-brand">SEKOLAH</span>
        </h1>

        <p class="lead text-white mx-auto mb-4" style="max-width: 620px;">
            "Laporkan kerusakan atau permasalahan
   fasilitas sekolah dengan mudah dan cepat."
        </p>
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a class="btn btn-brand btn-lg px-4" href="{{ route('login') }}">Login untuk Membuat Pengaduan</a>
                    </div>
            </div>
            <div class="bg-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
            <div class="bg-circle-4 bg-circle"></div>
            </div>
            </header>
<div class="row g-2 mb-4">

    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted">Sarana</h6>
                <h2>25</h2>
                <small>Data sarana</small>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted">Prasarana</h6>
                <h2>12</h2>
                <small>Data prasarana</small>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted">Pengaduan</h6>
                <h2>8</h2>
                <small>Total pengaduan</small>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted">Selesai</h6>
                <h2>5</h2>
                <small>Pengaduan selesai</small>
            </div>
        </div>
    </div>

</div>


    <section class="row g-4 align-items-start mb-5">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h5 fw-semibold mb-3">ℹ️ Tentang Aplikasi</h2>

                    <p>Pengaduan Sarana & Prasarana Sekolah merupakan aplikasi yang digunakan untuk memudahkan siswa dalam melaporkan kerusakan atau permasalahan pada fasilitas sekolah. Melalui aplikasi ini, siswa dapat menyampaikan pengaduan dengan informasi yang jelas, sementara admin dapat mengelola, memproses, dan memperbarui status pengaduan hingga selesai.</p>
                      
<p>Aplikasi ini bertujuan untuk membuat proses pelaporan sarana dan prasarana menjadi lebih mudah, terorganisir, dan transparan, sehingga permasalahan fasilitas sekolah dapat ditangani dengan lebih baik.</p>
                </div>
            </div>
        </div>
    </section>
      <section class="row g-4 align-items-start mb-5">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h5 fw-semibold mb-3">🔁 Cara Pengaduan</h2>
                    <ol>
                    <li> Login </li>
                    <li> Buat Pengaduan </li>
                    <li> Diproses </li>
                    <li> Selesai </li>
                    </ol>
            </div>
        </div>
    </section>

@endsection
