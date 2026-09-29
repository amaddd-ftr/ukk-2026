@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Daftar Pengaduan</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Sarpras</th>
                <th>Lokasi</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @php
                $no = ($pengaduan->currentPage() - 1)
                    * $pengaduan->perPage() + 1;
            @endphp

            @foreach ($pengaduan as $x)

            @php
                $dataSiswa = $siswa->firstWhere(
                    'id_siswa',
                    $x->id_siswa
                );

                $dataSarpras = $sarpras->firstWhere(
                    'id_sarpras',
                    $x->id_sarpras
                );

                $dataLokasi = $lokasi->firstWhere(
                    'id_lokasi',
                    $x->id_lokasi
                );

                $dataStatus = $status->firstWhere(
                    'id_status',
                    $x->id_status
                );
            @endphp

            <tr>
                <td>{{ $no++ }}</td>

                <td>
                    {{ $dataSiswa ? $dataSiswa->nama : '-' }}
                </td>

                <td>
                    {{ $dataSarpras ? $dataSarpras->nama_sarpras : '-' }}
                </td>

                <td>
                    {{ $dataLokasi ? $dataLokasi->nama_lokasi : '-' }}
                </td>

                <td>
                    {{ $x->judul }}
                </td>

                <td>
                    {{ $dataStatus ? $dataStatus->nama_status : '-' }}
                </td>

                <td>
                    {{ $x->created_at }}
                </td>

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