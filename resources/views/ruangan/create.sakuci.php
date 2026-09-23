@extends ('layouts.app')
@section ('content')

<div class="container">
    <h1>Tambah Tempat</h1>
    <form action="{{ route('admin.ruangan.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama_ruangan">Nama Tempat</label>
            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" required>
            <label>Gedung</label>
            <select
                name="id_gedung"
                id="id_gedung"
                class="form-select"
                required
            >
                <option value="">-- Pilih Gedung --</option>

                @foreach ($gedung as $g)
                    <option value="{{ $g->id_gedung }}">
                        {{ $g->nama_gedung }}
                    </option>
                @endforeach

            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
