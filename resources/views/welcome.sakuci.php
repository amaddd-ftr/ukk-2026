@extends('layouts.app')

@section('title', 'Sistem Pengaduan Sarana & Prasarana')

@section('content')

{{-- ==================================================
     HERO
================================================== --}}
<header class="home-hero">

    {{-- Dekorasi garis --}}
    <div class="hero-line hero-line-1"></div>
    <div class="hero-line hero-line-2"></div>

    <div class="home-hero-content">

        <div class="hero-badge">
            <span>✦</span>
            UNIVERSITAS CIMINDI
        </div>

        <h1>
            Sistem Pengaduan
            <span>Sarana &amp; Prasarana</span>
        </h1>

        <p>
            Platform layanan pengaduan fasilitas kampus untuk menciptakan
            lingkungan akademik yang nyaman, aman, dan terawat.
        </p>

        <div class="hero-actions">

            <a href="{{ route('login') }}" class="btn btn-brand btn-lg">
                <span>🔐</span>
                Login untuk Membuat Pengaduan
            </a>

        </div>

        <div class="hero-meta">
            <span>✦ Layanan Digital Kampus</span>
            <span>•</span>
            <span>Universitas Cimindi</span>
        </div>

    </div>


    {{-- ==================================================
         GEDUNG KAMPUS
    ================================================== --}}
    <div class="campus-building">

        {{-- Gedung kiri --}}
        <div class="building-wing building-wing-left">

            <div class="wing-roof"></div>

            <div class="wing-windows">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>


        {{-- Gedung utama --}}
        <div class="building-main">

            <div class="building-roof"></div>

            <div class="building-columns">

                <span class="building-window"></span>
                <span class="building-window"></span>
                <span class="building-window"></span>
                <span class="building-window"></span>
                <span class="building-window"></span>
                <span class="building-window"></span>

            </div>

            <div class="building-door"></div>

            <div class="building-sign">
                
            </div>

        </div>


        {{-- Gedung kanan --}}
        <div class="building-wing building-wing-right">

            <div class="wing-roof"></div>

            <div class="wing-windows">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>


        {{-- Tanah --}}
        <div class="building-ground"></div>

    </div>

</header>



{{-- ==================================================
     STATISTIK
================================================== --}}
<section class="home-statistics">

    <div class="stat-card">

        <div class="stat-icon">
            🏢
        </div>

        <div>

            <div class="stat-label">
                Sarana
            </div>

            <div class="stat-number">
                25
            </div>

            <small>
                Data sarana
            </small>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">
            🏛️
        </div>

        <div>

            <div class="stat-label">
                Prasarana
            </div>

            <div class="stat-number">
                12
            </div>

            <small>
                Data prasarana
            </small>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">
            📝
        </div>

        <div>

            <div class="stat-label">
                Pengaduan
            </div>

            <div class="stat-number">
                8
            </div>

            <small>
                Total pengaduan
            </small>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">
            ✓
        </div>

        <div>

            <div class="stat-label">
                Selesai
            </div>

            <div class="stat-number">
                5
            </div>

            <small>
                Pengaduan selesai
            </small>

        </div>

    </div>

</section>



{{-- ==================================================
     INFORMASI
================================================== --}}
<section class="home-info">


    {{-- Tentang aplikasi --}}
    <div class="info-card info-main">

        <div class="info-icon">
            ℹ
        </div>

        <div>

            <h2>
                Tentang Sistem
            </h2>

            <p>
                <strong>Sistem Pengaduan Sarana &amp; Prasarana</strong>
                merupakan platform digital Universitas Cimindi yang
                digunakan untuk memudahkan mahasiswa dalam melaporkan
                kerusakan atau permasalahan fasilitas kampus.
            </p>

            <p>
                Setiap pengaduan dapat disampaikan secara terstruktur
                sehingga pihak kampus dapat melakukan pemeriksaan,
                penanganan, dan pemantauan hingga pengaduan selesai.
            </p>

        </div>

    </div>


    {{-- Alur pengaduan --}}
    <div class="info-card">

        <div class="info-icon">
            ↻
        </div>

        <div>

            <h2>
                Alur Pengaduan
            </h2>

            <div class="complaint-steps">


                <div class="complaint-step">

                    <span>01</span>

                    <div>

                        <strong>
                            Login
                        </strong>

                        <small>
                            Masuk menggunakan akun mahasiswa.
                        </small>

                    </div>

                </div>


                <div class="complaint-step">

                    <span>02</span>

                    <div>

                        <strong>
                            Buat Pengaduan
                        </strong>

                        <small>
                            Isi informasi fasilitas yang bermasalah.
                        </small>

                    </div>

                </div>


                <div class="complaint-step">

                    <span>03</span>

                    <div>

                        <strong>
                            Diproses
                        </strong>

                        <small>
                            Admin memeriksa dan menangani pengaduan.
                        </small>

                    </div>

                </div>


                <div class="complaint-step">

                    <span>04</span>

                    <div>

                        <strong>
                            Selesai
                        </strong>

                        <small>
                            Pengaduan telah ditangani.
                        </small>

                    </div>

                </div>


            </div>

        </div>

    </div>

</section>

@endsection