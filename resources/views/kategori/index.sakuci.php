@extends ('layouts.app')
@section ('title', config('app.name') . ' -- Kerangka PHP Ringan')
@section('content')
<div class="container">
    <h1>Daftar Kategori</h1>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3 btn-sm">Tambah Kategori</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($kategori as $x)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $x->nama_kategori }}</td>
                <td>
                       <a href="{{ route('admin.kategori.edit', ['id_kategori' => $x->id_kategori]) }}" class="btn btn-sm btn-success">Edit</a>
                        <form action="{{ route('admin.kategori.delete', ['id' => $x->id_kategori]) }}" method="POST" style="display: inline-block;">
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
    {!! $kategori->links() !!}
@endsection
