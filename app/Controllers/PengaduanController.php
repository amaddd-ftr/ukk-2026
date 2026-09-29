<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Siswa;
use App\Models\Sarpras;
use App\Models\Lokasi;
use App\Models\Status;

class PengaduanController extends Controller
{
    // Siswa melihat pengaduannya sendiri
    // Admin melihat semua pengaduan
    public function index(Request $request)
{
    $user = User::current();

    // =========================
    // ADMIN
    // =========================
    if ($user->role === 'admin') {

        $pengaduan = Pengaduan::orderBy(
            'id_pengaduan',
            'desc'
        )->paginate(5);

        $siswa = Siswa::all();
        $sarpras = Sarpras::all();
        $lokasi = Lokasi::all();
        $status = Status::all();

        return view(
            'core.admin.pengaduan.index',
            compact(
                'pengaduan',
                'siswa',
                'sarpras',
                'lokasi',
                'status'
            )
        );
    }

    // =========================
    // SISWA
    // =========================
    $siswa = Siswa::where(
        'id_user',
        $user->id
    )->first();

    $pengaduan = Pengaduan::where(
        'id_siswa',
        $siswa->id_siswa
    )
    ->orderBy(
        'id_pengaduan',
        'desc'
    )
    ->paginate(5);

    $sarpras = Sarpras::all();
    $lokasi = Lokasi::all();
    $status = Status::all();

    return view(
        'pengaduan.index',
        compact(
            'pengaduan',
            'siswa',
            'sarpras',
            'lokasi',
            'status'
        )
    );
}


    // Form membuat pengaduan
    public function create(Request $request)
    {
        $sarpras = Sarpras::all();
        $lokasi = Lokasi::all();

        return view(
            'pengaduan.create',
            compact('sarpras', 'lokasi')
        );
    }


    // Simpan pengaduan
    public function store(Request $request)
{
    $request->validate([
        'id_sarpras' => 'required|exists:sarpras,id_sarpras',
        'id_lokasi' => 'required|exists:lokasi,id_lokasi',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ]);

    $user = User::current();

    $siswa = Siswa::where(
        'id_user',
        $user->id
    )->first();

    $status = Status::where(
        'nama_status',
        'Menunggu'
    )->first();

    Pengaduan::create([
        'id_siswa' => $siswa->id_siswa,
        'id_sarpras' => $request->id_sarpras,
        'id_lokasi' => $request->id_lokasi,
        'id_status' => $status->id_status,
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()
        ->route('pengaduan.index')
        ->with('success', 'Pengaduan berhasil dikirim.');
}


    // Detail pengaduan
    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail(
            $id_pengaduan
        );

        return view(
            'pengaduan.show',
            compact('pengaduan')
        );
    }
}