@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')
<div class="container">
    <h1>Daftar Sarana</h1>

    <a href="{{ route('admin.sarana.create') }}"
       class="btn btn-primary mb-3 btn-sm">
        Tambah Sarana
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Sarana</th>
                <th>Nama Sarana</th>
                <th>Ruangan</th>
                <th>Kondisi</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @php
                $no = 1;
            @endphp

            @foreach ($sarana as $x)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $x->kode_sarana }}</td>
                <td>{{ $x->nama_sarana }}</td>
                <td>{{ $x->id_ruangan }}</td>
                <td>{{ $x->id_kondisi }}</td>
                <td>{{ $x->jumlah_sarana }}</td>

                <td>
                    <a href="{{ route('admin.sarana.edit', ['id_sarana' => $x->id_sarana]) }}"
                       class="btn btn-sm btn-success">
                        Edit
                    </a>

                    <form action="{{ route('admin.sarana.delete', ['id_sarana' => $x->id_sarana]) }}"
                          method="POST"
                          style="display: inline-block;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus sarana ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! $sarana->links() !!}

@endsection