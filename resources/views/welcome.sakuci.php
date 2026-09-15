@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    {{-- Hero --}}
    <section class="text-center py-4 py-lg-5">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">Sakuci v1.0.0</span>

        <h1 class="display-5 fw-bold mb-3">
            Pengaduan Sarana & Prasarana<br class="d-none d-md-inline">
            <span class="text-brand">Masjid</span>
        </h1>

        <p class="lead text-secondary mx-auto mb-4" style="max-width: 620px;">
            Laporkan kerusakan dan kendala sarana prasarana masjid dengan mudah dan cepat.
        </p>
      
<div class="d-flex flex-wrap gap-2 justify-content-center mb-3"><h1 class="h4 mb-2"> </h1></div>
      
        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a class="btn btn-brand btn-lg px-4" href="#langkah">Buat Pengaduan</a>
            <a class="btn btn-outline-brand btn-lg px-4" href="https://github.com/indrabsus/sakuci-framework" target="_blank">Lihat Pengaduan Saya</a>
        </div>

        <p class="text-secondary small mt-3 mb-0">
            Panduan langkah demi langkah ada di berkas
            <code class="inline">TUTORIAL.md</code>
        </p>
    </section>

    {{-- Statistik Pengaduan --}}
    <section class="row g-4 align-items-start mb-5">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h5 fw-semibold mb-3">📋 Pengaduan Saya</h2>
                </div>
            </div>
        </div>
    </section>

    {{-- Pengaduan Terbaru --}}
    <section class="row g-4 align-items-start mb-5">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h5 fw-semibold mb-3">📋 Pengaduan Terbaru saya</h2>
                </div>
            </div>
        </div>
    </section>

@endsection
