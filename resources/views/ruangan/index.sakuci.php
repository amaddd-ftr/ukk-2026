@extends ('layouts.app')
@section ('title', config('app.name') . ' -- Kerangka PHP Ringan')
@section('content')
<div class="container">
    <h1>Daftar Tempat</h1>
    <a href="{{ route('admin.ruangan.create') }}" class="btn btn-primary mb-3 btn-sm">Tambah Tempat</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tempat</th>
                <th>Gedung</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($ruangan as $x)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $x->nama_ruangan }}</td>
                <td>@foreach ($gedung as $g)
            @if ($g->id_gedung == $x->id_gedung)
                {{ $g->nama_gedung }}
            @endif
        @endforeach</td>
                <td>
                       <a href="{{ route('admin.ruangan.edit', ['id_ruangan' => $x->id_ruangan]) }}" class="btn btn-sm btn-success">Edit</a>
                        <form action="{{ route('admin.ruangan.delete', ['id' => $x->id_ruangan]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus Tempat ini?')">Hapus</button>
                        </form>
                    </td>
</tr>
@endforeach
        </tbody>
    </table>
</div>
    {!! $ruangan->links() !!}
@endsection
