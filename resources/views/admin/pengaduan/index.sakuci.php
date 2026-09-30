@extends('layouts.app')

@section('title', config('app.name') . ' -- Pengaduan')

@section('content')

<div class="container">

    <h1>Daftar Pengaduan</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Nama Sarpras</th>
                <th>Nama Lokasi</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @php
                $no = 1;
            @endphp

            @foreach ($pengaduan as $x)

                @php
                    $namaSiswa = '-';
                    $namaSarpras = '-';
                    $namaLokasi = '-';
                    $namaStatus = '-';

                    foreach ($siswa as $item) {
                        if ($item->id_siswa == $x->id_siswa) {
                            $namaSiswa = $item->nama;
                            break;
                        }
                    }

                    foreach ($sarpras as $item) {
                        if ($item->id_sarpras == $x->id_sarpras) {
                            $namaSarpras = $item->nama_sarpras;
                            break;
                        }
                    }

                    foreach ($lokasi as $item) {
                        if ($item->id_lokasi == $x->id_lokasi) {
                            $namaLokasi = $item->nama_lokasi;
                            break;
                        }
                    }

                    foreach ($status as $item) {
                        if ($item->id_status == $x->id_status) {
                            $namaStatus = $item->nama_status;
                            break;
                        }
                    }
                @endphp

                <tr>
                    <td>{{ $no++ }}</td>

                    <td>{{ $namaSiswa }}</td>

                    <td>{{ $namaSarpras }}</td>

                    <td>{{ $namaLokasi }}</td>

                    <td>{{ $x->judul }}</td>

                    <td>{{ $namaStatus }}</td>

                    <td>
                        <a href="{{ route('admin.pengaduan.show', [
                            'id_pengaduan' => $x->id_pengaduan
                        ]) }}"
                           class="btn btn-sm btn-primary">
                            Lihat
                        </a>
                    </td>
                </tr>

            @endforeach

        </tbody>
    </table>

    {!! $pengaduan->links() !!}

</div>

@endsection