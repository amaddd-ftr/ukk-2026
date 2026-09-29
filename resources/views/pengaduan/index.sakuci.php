@extends('layouts.app')

@section('title', 'Pengaduan Saya')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="dashboard-header pengaduan-header">

        <div class="dashboard-header-content">

            <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
                Pengaduan Saya
            </span>

            <h1>
                Pengaduan Saya
            </h1>

            <p>
                Lihat daftar pengaduan yang telah kamu kirim.
            </p>

        </div>

        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>

    </div>


    {{-- Daftar Pengaduan --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>
                    <h5 class="fw-bold mb-1">
                        Riwayat Pengaduan
                    </h5>

                    <p class="text-secondary small mb-0">
                        Daftar pengaduan yang kamu buat.
                    </p>
                </div>

                <a href="{{ route('pengaduan.create') }}"
                   class="btn btn-brand">
                    + Buat Pengaduan
                </a>

            </div>


            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Sarana / Prasarana</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($pengaduan as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $item->judul }}
                                    </div>
                                </td>

                                <td>
                                    @foreach ($sarpras as $itemSarpras)
                                        @if ($itemSarpras->id_sarpras == $item->id_sarpras)
                                            {{ $itemSarpras->nama_sarpras }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($lokasi as $itemLokasi)
                                        @if ($itemLokasi->id_lokasi == $item->id_lokasi)
                                            {{ $itemLokasi->nama_lokasi }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($status as $itemStatus)
                                        @if ($itemStatus->id_status == $item->id_status)

                                            <span class="badge rounded-pill
                                                @if ($itemStatus->nama_status == 'Menunggu')
                                                    text-bg-warning
                                                @elseif ($itemStatus->nama_status == 'Diproses')
                                                    text-bg-primary
                                                @elseif ($itemStatus->nama_status == 'Selesai')
                                                    text-bg-success
                                                @else
                                                    text-bg-secondary
                                                @endif
                                            ">
                                                {{ $itemStatus->nama_status }}
                                            </span>

                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    <a href="{{ route('pengaduan.show', $item->id_pengaduan) }}"
                                       class="btn btn-outline-brand btn-sm">
                                        Detail
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="text-center text-secondary py-5">

                                    <div class="mb-2">
                                        Belum ada pengaduan.
                                    </div>

                                    <a href="{{ route('pengaduan.create') }}"
                                       class="btn btn-brand btn-sm">
                                        Buat Pengaduan
                                    </a>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if ($pengaduan->hasPages())

                <div class="mt-4">
                    {{ $pengaduan->links() }}
                </div>

            @endif

        </div>

    </div>

</div>

@endsection