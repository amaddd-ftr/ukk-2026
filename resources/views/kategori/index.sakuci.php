@extends ('layouts.app')
@section ('title', config('app.name') . ' -- Kerangka PHP Ringan')
@section('content')
<table class="table table-striped tabel-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori<th>
                <th>Aksi</th>
            <tr>
</thead>
<tbody>
    @php $no = 1; @endphp
    @foreach ($kategori as $kategoris)
    <tr>
        <td>{{$no++}}</td>
        <td>{{$kategoris->nama_kategori}}</td>
        <td><button class="btn btn-success btn-sm">Edit</button> <button class="btn btn-danger btn-sm">Hapus</button>
</tr>
@endforeach
</tbody>
</table>
{!! $kategori->links() !!}
@endsection
