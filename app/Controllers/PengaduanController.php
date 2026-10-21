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
    public function index(Request $request)
    {
        $user = User::current();

        if ($user->role === 'admin') {
            $pengaduan = Pengaduan::orderBy('id_pengaduan', 'desc')->paginate(5);
            $siswa = Siswa::all();
            $sarpras = Sarpras::all();
            $lokasi = Lokasi::all();
            $status = Status::all();

            return view(
                'admin.pengaduan.index',
                compact('pengaduan', 'siswa', 'sarpras', 'lokasi', 'status')
            );
        }

        $siswa = Siswa::where('id_user', $user->id)->first();

        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan.');
        }

        $pengaduan = Pengaduan::where('id_siswa', $siswa->id_siswa)
            ->orderBy('id_pengaduan', 'desc')
            ->paginate(5);

        $sarpras = Sarpras::all();
        $lokasi = Lokasi::all();
        $status = Status::all();

        return view(
            'pengaduan.index',
            compact('pengaduan', 'siswa', 'sarpras', 'lokasi', 'status')
        );
    }

    public function create(Request $request)
    {
        $sarpras = Sarpras::all();
        $lokasi = Lokasi::all();

        return view('pengaduan.create', compact('sarpras', 'lokasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'id_sarpras' => 'required|exists:sarpras,id_sarpras',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::current();

        $siswa = Siswa::where('id_user', $user->id)->first();

        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan.');
        }

        $status = Status::where('nama_status', 'Menunggu')->first();

        if (!$status) {
            abort(404, 'Status Menunggu tidak ditemukan.');
        }

        // Upload foto pengaduan
        $namaFoto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            if (!$file || !isset($file['tmp_name'], $file['name'])) {
                abort(422, 'Data foto tidak valid.');
            }

            $ekstensi = strtolower(
                pathinfo($file['name'], PATHINFO_EXTENSION)
            );

            $ekstensiDiizinkan = ['jpg', 'jpeg', 'png'];

            if (!in_array($ekstensi, $ekstensiDiizinkan, true)) {
                abort(422, 'Foto harus berformat JPG, JPEG, atau PNG.');
            }

            if (@getimagesize($file['tmp_name']) === false) {
                abort(422, 'File yang diunggah bukan gambar yang valid.');
            }

            $namaFoto = time() . '_' . bin2hex(random_bytes(8))
                . '.' . $ekstensi;

            // Asumsi: folder public berada di root project.
            $folder = dirname(__DIR__, 2)
                . '/public/uploads/pengaduan';

            if (!is_dir($folder)) {
                if (!mkdir($folder, 0755, true) && !is_dir($folder)) {
                    abort(500, 'Folder upload gagal dibuat.');
                }
            }

            if (!move_uploaded_file(
                $file['tmp_name'],
                $folder . '/' . $namaFoto
            )) {
                abort(500, 'Foto gagal disimpan.');
            }
        }

        Pengaduan::create([
            'id_siswa' => $siswa->id_siswa,
            'id_sarpras' => $request->id_sarpras,
            'id_lokasi' => $request->id_lokasi,
            'id_status' => $status->id_status,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $namaFoto,
        ]);

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $user = User::current();

        if ($user->role === 'admin') {
            $siswa = Siswa::findOrFail($pengaduan->id_siswa);
            $sarpras = Sarpras::all();
            $lokasi = Lokasi::all();
            $status = Status::all();

            return view(
                'admin.pengaduan.show',
                compact('pengaduan', 'siswa', 'sarpras', 'lokasi', 'status')
            );
        }

        $siswa = Siswa::where('id_user', $user->id)->first();

        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan.');
        }

        if ($pengaduan->id_siswa != $siswa->id_siswa) {
            abort(403);
        }

        $sarpras = Sarpras::all();
        $lokasi = Lokasi::all();
        $status = Status::all();

        return view(
            'pengaduan.show',
            compact('pengaduan', 'siswa', 'sarpras', 'lokasi', 'status')
        );
    }

    public function status(Request $request, $id_pengaduan)
    {
        $request->validate([
            'id_status' => 'required|exists:status,id_status',
        ]);

        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        $pengaduan->update([
            'id_status' => $request->id_status,
        ]);

        return redirect()
            ->route('admin.pengaduan.show', [
                'id_pengaduan' => $id_pengaduan,
            ])
            ->with('success', 'Status berhasil diperbarui.');
    }

    public function tanggapan(Request $request, $id_pengaduan)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        $pengaduan->update([
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()
            ->route('admin.pengaduan.show', [
                'id_pengaduan' => $id_pengaduan,
            ])
            ->with('success', 'Tanggapan berhasil disimpan.');
    }
}
