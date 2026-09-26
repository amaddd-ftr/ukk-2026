@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Daftar Status</h1><a href="{{ route('admin.status.create') }}"
   class="btn btn-primary mb-3 btn-sm">
    Tambah Status
</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @php
            $no = ($status->currentPage() - 1) * $status->perPage() + 1;
        @endphp

        @foreach ($status as $x)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $x->nama_status }}</td>

            <td>
                <a href="{{ route('admin.status.edit', ['id_status' => $x->id_status]) }}"
                   class="btn btn-sm btn-success">
                    Edit
                </a>

                <form action="{{ route('admin.status.delete', ['id_status' => $x->id_status]) }}"
                      method="POST"
                      style="display: inline-block;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus status ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    {!! $status->links() !!}

</div>@endsection