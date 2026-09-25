@extends('layouts.app')

@section('title', config('app.name') . ' -- Prasarana')

@section('content')
<div class="container">
    <h1>Daftar Prasarana</h1>

    <a href="{{ route('admin.prasarana.create') }}"
       class="btn btn-primary mb-3 btn-sm">
        Tambah Prasarana
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Prasarana</th>
                <th>Nama Prasarana</th>
                <th>Ruangan</th>
                <th>Kondisi</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @php $no = 1; @endphp

            @foreach ($prasarana as $x)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $x->kode_prasarana }}</td>
                <td>{{ $x->nama_prasarana }}</td>
                <td>{{ $x->id_ruangan }}</td>
                <td>{{ $x->id_kondisi }}</td>
                <td>{{ $x->jumlah_prasarana }}</td>

                <td>
                    <a href="{{ route('admin.prasarana.edit', ['id_prasarana' => $x->id_prasarana]) }}"
                       class="btn btn-sm btn-success">
                        Edit
                    </a>

                    <form action="{{ route('admin.prasarana.delete', ['id_prasarana' => $x->id_prasarana]) }}"
                          method="POST"
                          style="display: inline-block;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus prasarana ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! $prasarana->links() !!}
@endsection