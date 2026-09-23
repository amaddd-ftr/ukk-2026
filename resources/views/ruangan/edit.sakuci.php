@extends('layouts.app')

@section('content')
<form action="{{ route('admin.ruangan.update', ['id_ruangan' => $ruangan->id_ruangan]) }}" method="post" class="d-flex flex-column form-horizontal">
    @csrf
    @method('POST')

    <label>Nama Tempat</label>    
    <input type="text" name="nama_ruangan" value="{{ $ruangan->nama_ruangan }}" class="form-control mb-3" required>
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

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection