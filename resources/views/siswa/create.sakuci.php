@extends ('layouts.app')
@section ('content')

<div class="container">
    <h1>Tambah Siswa</h1>
    <form action="{{ route('admin.siswa.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama">Nama Siswa</label>
            <input type="text" class="form-control mb-3" id="nama" name="nama" required>
            
            <label for="nis">NIS</label>
            <input type="text" class="form-control mb-3" id="nis" name="nis" required>
            
            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas" class="form-select mb-3" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

