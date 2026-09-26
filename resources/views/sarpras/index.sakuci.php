@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Sarpras')

@section('content')
<div class="atas container">

    <h1>Daftar Sarpras</h1>

    <a href="{{ route('admin.sarpras.create') }}"
       class="btn btn-primary mb-3 btn-sm">
        Tambah Sarpras
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Sarpras</th>
                <th>Nama Sarpras</th>
                
                <th>Kategori</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @php
                $no = 1;
            @endphp

            @foreach ($sarpras as $x)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $x->kode_sarpras }}</td>
                <td>{{ $x->nama_sarpras }}</td>
              
                <td>{{ $x->nama_kategori }}</td>
                <td>{{ $x->nama_kondisi }}</td>
                

                <td>
                    <a href="{{ route('admin.sarpras.edit', ['id_sarpras' => $x->id_sarpras]) }}"
                       class="btn btn-sm btn-success">
                        Edit
                    </a>

                    <form action="{{ route('admin.sarpras.delete', ['id_sarpras' => $x->id_sarpras]) }}"
                          method="POST"
                          style="display: inline-block;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus sarpras ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

        {!! $sarpras->links() !!}

</div>
@endsection