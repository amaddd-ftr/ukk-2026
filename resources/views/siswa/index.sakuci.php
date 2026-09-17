@extends ('layouts.app')
@section ('title', config('app.name') . ' -- Kerangka PHP Ringan')
@section('content')
<div class="container">
    <h1>Daftar Siswa</h1>
    <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary mb-3 btn-sm">Tambah Siswa</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($siswa as $x)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $x->nama }}</td>
                <td>{{ $x->nis}}</td>
                <td>{{ $x->kelas}}</td>
                <td>
                    </td>
</tr>
@endforeach
        </tbody>
    </table>
</div>
    {!! $siswa->links() !!}
@endsection
