<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Pengaduan;
use App\Models\Siswa;
use App\Models\Sarpras;
use App\Models\Lokasi;
use App\Models\Status;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $pengaduan = Pengaduan::orderBy('id_pengaduan', 'desc')->paginate(5);

        return view('pengaduan.index', compact('pengaduan'));
    }

    public function create(Request $request)
    {
        $siswa = Siswa::all();
        $sarpras = Sarpras::all();
        $lokasi = Lokasi::all();
        $status = Status::all();

        return view('pengaduan.create', compact(
            'siswa',
            'sarpras',
            'lokasi',
            'status'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_sarpras' => 'required',
            'id_lokasi' => 'required',
            'id_status' => 'required',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Pengaduan::create([
            'id_siswa' => $request->input('id_siswa'),
            'id_sarpras' => $request->input('id_sarpras'),
            'id_lokasi' => $request->input('id_lokasi'),
            'id_status' => $request->input('id_status'),
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function edit($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        $siswa = Siswa::all();
        $sarpras = Sarpras::all();
        $lokasi = Lokasi::all();
        $status = Status::all();

        return view('pengaduan.edit', compact(
            'pengaduan',
            'siswa',
            'sarpras',
            'lokasi',
            'status'
        ));
    }

    public function update(Request $request, $id_pengaduan)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_sarpras' => 'required',
            'id_lokasi' => 'required',
            'id_status' => 'required',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        $pengaduan->update([
            'id_siswa' => $request->input('id_siswa'),
            'id_sarpras' => $request->input('id_sarpras'),
            'id_lokasi' => $request->input('id_lokasi'),
            'id_status' => $request->input('id_status'),
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function delete($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $pengaduan->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}