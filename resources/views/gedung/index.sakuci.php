@extends ('layouts.app')
@section ('title', config('app.name') . ' -- Kerangka PHP Ringan')
@section('content')
<div class="container">
    <h1>Daftar Gedung</h1>
    <a href="{{ route('admin.gedung.create') }}" class="btn btn-primary mb-3 btn-sm">Tambah Gedung</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Gedung</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($gedung as $x)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $x->nama_gedung }}</td>
                <td>
                       <a href="{{ route('admin.gedung.edit', ['id_gedung' => $x->id_gedung]) }}" class="btn btn-sm btn-success">Edit</a>
                        <form action="{{ route('admin.gedung.delete', ['id' => $x->id_gedung]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
</tr>
@endforeach
        </tbody>
    </table>
</div>
    {!! $gedung->links() !!}
@endsection
