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

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-1">
                        Form Pengaduan
                    </h5>

                    <p class="text-secondary small mb-4">
                        Isi data pengaduan dengan lengkap dan jelas.
                    </p>

                    <form method="POST"
                          action="{{ route('pengaduan.store') }}">

                        @csrf

                        {{-- Sarana / Prasarana --}}
                        <div class="mb-3">

                            <label class="form-label" for="id_sarpras">
                                Sarana / Prasarana
                            </label>

                            <select
                                id="id_sarpras"
                                name="id_sarpras"
                                class="form-select {{ errors()->has('id_sarpras') ? 'is-invalid' : '' }}"
                            >

                                <option value="">
                                    -- Pilih Sarana / Prasarana --
                                </option>

                                @foreach ($sarpras as $item)

                                    <option
                                        value="{{ $item->id_sarpras }}"
                                        {{ old('id_sarpras') == $item->id_sarpras ? 'selected' : '' }}
                                    >
                                        {{ $item->nama_sarpras }}
                                    </option>

                                @endforeach

                            </select>

                            @error('id_sarpras')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Lokasi --}}
                        <div class="mb-3">

                            <label class="form-label" for="id_lokasi">
                                Lokasi
                            </label>

                            <select
                                id="id_lokasi"
                                name="id_lokasi"
                                class="form-select {{ errors()->has('id_lokasi') ? 'is-invalid' : '' }}"
                            >

                                <option value="">
                                    -- Pilih Lokasi --
                                </option>

                                @foreach ($lokasi as $item)

                                    <option
                                        value="{{ $item->id_lokasi }}"
                                        {{ old('id_lokasi') == $item->id_lokasi ? 'selected' : '' }}
                                    >
                                        {{ $item->nama_lokasi }}
                                    </option>

                                @endforeach

                            </select>

                            @error('id_lokasi')
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
                            >

                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Deskripsi --}}
                        <div class="mb-4">

                            <label class="form-label" for="deskripsi">
                                Deskripsi Pengaduan
                            </label>

                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                rows="5"
                                class="form-control {{ errors()->has('deskripsi') ? 'is-invalid' : '' }}"
                                placeholder="Jelaskan masalah atau kerusakan yang ditemukan..."
                            >{{ old('deskripsi') }}</textarea>

                            @error('deskripsi')
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