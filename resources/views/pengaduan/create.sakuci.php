@extends('layouts.app')

@section('title', 'Buat Pengaduan')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="dashboard-header pengaduan-header">

        <div class="dashboard-header-content">

            <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
                Pengaduan
            </span>

            <h1>
                Buat Pengaduan
            </h1>

            <p>
                Laporkan kerusakan atau permasalahan sarana dan prasarana sekolah.
            </p>

        </div>

        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>

    </div>

    {{-- Form Pengaduan --}}
    <div class="row">
        <div class="col-lg-8 mx-auto">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-1">
                        Form Pengaduan
                    </h5>

                    <p class="text-secondary small mb-4">
                        Isi data pengaduan dengan lengkap dan jelas.
                    </p>

                    {{-- LANGKAH 1: Form Pilih Lokasi (Mengirim GET ke Halaman Sendiri) --}}
                    <form method="GET" action="{{ route('pengaduan.create') }}" class="mb-4 pb-3 border-bottom">
                        <label class="form-label fw-bold" for="id_lokasi">
                            1. Pilih Lokasi Terlebih Dahulu
                        </label>

                        <div class="input-group">
                            <select
                                id="id_lokasi"
                                name="id_lokasi"
                                class="form-select"
                                required
                            >
                                <option value="">
                                    -- Pilih Lokasi --
                                </option>

                                @foreach ($lokasi as $item)
                                    <option
                                        value="{{ $item->id_lokasi }}"
                                        {{ request('id_lokasi') == $item->id_lokasi ? 'selected' : '' }}
                                    >
                                        {{ $item->nama_lokasi }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-secondary">
                                Tampilkan Sarpras
                            </button>
                        </div>
                    </form>


                    {{-- LANGKAH 2: Form Simpan Pengaduan --}}
                    <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">

                        @csrf

                        {{-- Hidden Input untuk id_lokasi yang sudah dipilih --}}
                        <input type="hidden" name="id_lokasi" value="{{ request('id_lokasi') }}">

                        {{-- Sarana / Prasarana --}}
                        <div class="mb-3">

                            <label class="form-label fw-bold" for="id_sarpras">
                                2. Pilih Sarana / Prasarana
                            </label>

                            <select
                                id="id_sarpras"
                                name="id_sarpras"
                                class="form-select {{ errors()->has('id_sarpras') ? 'is-invalid' : '' }}"
                                {{ !request('id_lokasi') ? 'disabled' : '' }}
                                required
                            >

                                <option value="">
                                    @if(request('id_lokasi'))
                                        -- Pilih Sarana / Prasarana --
                                    @else
                                        -- Silakan Pilih Lokasi di Atas Terlebih Dahulu --
                                    @endif
                                </option>

                                @foreach ($sarpras as $item)
                                    {{-- Filter Murni lewat Blade PHP --}}
                                    @if (request('id_lokasi') && $item->id_lokasi == request('id_lokasi'))
                                        <option
                                            value="{{ $item->id_sarpras }}"
                                            {{ old('id_sarpras') == $item->id_sarpras ? 'selected' : '' }}
                                        >
                                            {{ $item->nama_sarpras }}
                                        </option>
                                    @endif
                                @endforeach

                            </select>

                            @error('id_sarpras')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Judul --}}
                        <div class="mb-3">

                            <label class="form-label" for="judul">
                                Judul Pengaduan
                            </label>

                            <input
                                type="text"
                                id="judul"
                                name="judul"
                                value="{{ old('judul') }}"
                                class="form-control {{ errors()->has('judul') ? 'is-invalid' : '' }}"
                                placeholder="Contoh: Komputer tidak menyala"
                                {{ !request('id_lokasi') ? 'disabled' : '' }}
                                required
                            >

                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Deskripsi --}}
                        <div class="mb-3">

                            <label class="form-label" for="deskripsi">
                                Deskripsi Pengaduan
                            </label>

                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                rows="5"
                                class="form-control {{ errors()->has('deskripsi') ? 'is-invalid' : '' }}"
                                placeholder="Jelaskan masalah atau kerusakan yang ditemukan..."
                                {{ !request('id_lokasi') ? 'disabled' : '' }}
                                required
                            >{{ old('deskripsi') }}</textarea>

                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Foto Bukti --}}
                        <div class="mb-4">

                            <label class="form-label" for="foto">
                                Foto Bukti (Opsional)
                            </label>

                            <input
                                type="file"
                                id="foto"
                                name="foto"
                                class="form-control {{ errors()->has('foto') ? 'is-invalid' : '' }}"
                                accept="image/png, image/jpeg, image/jpg"
                                {{ !request('id_lokasi') ? 'disabled' : '' }}
                            >

                            <div class="form-text small text-secondary mt-1">
                                Format yang diizinkan: JPG, JPEG, PNG. Ukuran maksimal: 2MB.
                            </div>

                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Tombol --}}
                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('dashboard') }}"
                               class="btn btn-outline-secondary">
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="btn btn-brand"
                                {{ !request('id_lokasi') ? 'disabled' : '' }}
                            >
                                Kirim Pengaduan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection