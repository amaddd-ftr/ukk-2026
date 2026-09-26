@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Edit Status</h1><form action="{{ route('admin.status.update', ['id_status' => $status->id_status]) }}"
      method="POST">

    @csrf
    @method('POST')

    <div class="form-group mb-3">
        <label for="nama_status">Nama Status</label>

        <input
            type="text"
            class="form-control"
            id="nama_status"
            name="nama_status"
            value="{{ $status->nama_status }}"
            required
        >
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>

    <a href="{{ route('admin.status.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>
</form>

</div>@endsection