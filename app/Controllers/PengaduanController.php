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
use App\Models\Kategori;

class PengaduanController extends Controller
{
    // Siswa melihat pengaduannya sendiri, admin melihat semua.
    

public function index(Request $request)
{
    $user = User::current();

    if (!$user) {
        abort(401, 'Silakan login terlebih dahulu.');
    }

    // Data referensi
    $siswa = Siswa::all();
    $sarpras = Sarpras::all();
    $lokasi = Lokasi::all();
    $status = Status::all();
    $kategori = Kategori::all();

    // Filter dan sorting
    $search = trim((string) ($_GET['search'] ?? ''));
    $filterSiswa = trim((string) ($_GET['id_siswa'] ?? ''));

    $tanggal = trim((string) ($_GET['tanggal'] ?? ''));
    $bulan = trim((string) ($_GET['bulan'] ?? ''));

    $filterTanggal = $tanggal;
    $filterBulan = $bulan;

    $filterKategori = trim((string) ($_GET['id_kategori'] ?? ''));
    $filterStatus = trim((string) ($_GET['id_status'] ?? ''));
    $sort = trim((string) ($_GET['sort'] ?? 'tanggal_desc'));

    // Cari data siswa yang sedang login
    $dataSiswaLogin = null;

    if ($user->role !== 'admin') {
        foreach ($siswa as $s) {
            if ((string) $s->id_user === (string) $user->id) {
                $dataSiswaLogin = $s;
                break;
            }
        }

        if (!$dataSiswaLogin) {
            abort(404, 'Data siswa tidak ditemukan.');
        }
    }

    // Ambil seluruh pengaduan
    $semuaPengaduan = Pengaduan::orderBy(
        'id_pengaduan',
        'desc'
    )->get();

    $hasil = [];

    foreach ($semuaPengaduan as $item) {

        // Siswa hanya melihat pengaduannya sendiri
        if (
            $user->role !== 'admin' &&
            (string) $item->id_siswa !==
            (string) $dataSiswaLogin->id_siswa
        ) {
            continue;
        }

        // Nama siswa
        $namaSiswa = '';

        foreach ($siswa as $s) {
            if (
                (string) $s->id_siswa ===
                (string) $item->id_siswa
            ) {
                $namaSiswa = (string) $s->nama;
                break;
            }
        }

        // Nama sarpras dan ID kategori
        $namaSarpras = '';
        $idKategoriItem = '';

        foreach ($sarpras as $sp) {
            if (
                (string) $sp->id_sarpras ===
                (string) $item->id_sarpras
            ) {
                $namaSarpras = (string) $sp->nama_sarpras;
                $idKategoriItem = (string) ($sp->id_kategori ?? '');
                break;
            }
        }

        // Nama kategori
        $namaKategori = '';

        foreach ($kategori as $k) {
            if (
                (string) $k->id_kategori ===
                $idKategoriItem
            ) {
                $namaKategori = (string) $k->nama_kategori;
                break;
            }
        }

        // Nama lokasi
        $namaLokasi = '';

        foreach ($lokasi as $l) {
            if (
                (string) $l->id_lokasi ===
                (string) $item->id_lokasi
            ) {
                $namaLokasi = (string) $l->nama_lokasi;
                break;
            }
        }

        // Nama status
        $namaStatus = '';

        foreach ($status as $st) {
            if (
                (string) $st->id_status ===
                (string) $item->id_status
            ) {
                $namaStatus = (string) $st->nama_status;
                break;
            }
        }

        // Filter siswa khusus admin
        if (
            $user->role === 'admin' &&
            $filterSiswa !== '' &&
            (string) $item->id_siswa !== $filterSiswa
        ) {
            continue;
        }

        // Filter kategori
        if (
            $filterKategori !== '' &&
            $idKategoriItem !== $filterKategori
        ) {
            continue;
        }

        // Filter status
        if (
            $filterStatus !== '' &&
            (string) $item->id_status !== $filterStatus
        ) {
            continue;
        }

        // Tanggal dan bulan pengaduan
        $tanggalItem = '';
        $bulanItem = '';
        $timestamp = false;

        if (!empty($item->created_at)) {
            $timestamp = strtotime((string) $item->created_at);
        }

        if ($timestamp !== false) {
            $tanggalItem = date('Y-m-d', $timestamp);
            $bulanItem = date('Y-m', $timestamp);
        }

        // Filter tanggal
        if (
            $filterTanggal !== '' &&
            $tanggalItem !== $filterTanggal
        ) {
            continue;
        }

        // Filter bulan
        if (
            $filterBulan !== '' &&
            $bulanItem !== $filterBulan
        ) {
            continue;
        }

        // Pencarian
        if ($search !== '') {
            $teksCari = strtolower($search);

            $teksPengaduan = strtolower(
                $namaSiswa . ' ' .
                $namaSarpras . ' ' .
                $namaKategori . ' ' .
                $namaLokasi . ' ' .
                $namaStatus . ' ' .
                (string) ($item->judul ?? '') . ' ' .
                (string) ($item->deskripsi ?? '')
            );

            if (strpos($teksPengaduan, $teksCari) === false) {
                continue;
            }
        }

        // Simpan data yang lolos filter
        $hasil[] = [
            'item' => $item,
            'nama_siswa' => $namaSiswa,
            'nama_sarpras' => $namaSarpras,
            'nama_kategori' => $namaKategori,
            'nama_lokasi' => $namaLokasi,
            'nama_status' => $namaStatus,
            'tanggal' => $tanggalItem,
        ];
    }

    // Sorting
    usort($hasil, function ($a, $b) use ($sort) {
        switch ($sort) {
            case 'nama_asc':
                return strcasecmp(
                    $a['nama_siswa'],
                    $b['nama_siswa']
                );

            case 'nama_desc':
                return strcasecmp(
                    $b['nama_siswa'],
                    $a['nama_siswa']
                );

            case 'kategori_asc':
                return strcasecmp(
                    $a['nama_kategori'],
                    $b['nama_kategori']
                );

            case 'status_asc':
                return strcasecmp(
                    $a['nama_status'],
                    $b['nama_status']
                );

            case 'tanggal_asc':
                return strcmp(
                    $a['tanggal'],
                    $b['tanggal']
                );

            case 'tanggal_desc':
            default:
                return strcmp(
                    $b['tanggal'],
                    $a['tanggal']
                );
        }
    });

    // Pagination manual
    $perHalaman = $user->role === 'admin' ? 10 : 5;

    $halaman = max(
        1,
        (int) ($_GET['page'] ?? 1)
    );

    $totalData = count($hasil);

    $totalHalaman = max(
        1,
        (int) ceil($totalData / $perHalaman)
    );

    if ($halaman > $totalHalaman) {
        $halaman = $totalHalaman;
    }

    $offset = ($halaman - 1) * $perHalaman;

    $dataHalaman = array_slice(
        $hasil,
        $offset,
        $perHalaman
    );

    // Bentuk objek untuk view tabel
    $pengaduan = [];

    foreach ($dataHalaman as $baris) {
        $item = $baris['item'];

        $x = new \stdClass();

        // Salin kolom pengaduan satu per satu
        $x->id_pengaduan = $item->id_pengaduan ?? null;
        $x->id_siswa = $item->id_siswa ?? null;
        $x->id_sarpras = $item->id_sarpras ?? null;
        $x->id_lokasi = $item->id_lokasi ?? null;
        $x->id_status = $item->id_status ?? null;
        $x->judul = $item->judul ?? '';
        $x->deskripsi = $item->deskripsi ?? '';
        $x->tanggapan = $item->tanggapan ?? '';
        $x->foto = $item->foto ?? '';
        $x->created_at = $item->created_at ?? '';
        $x->updated_at = $item->updated_at ?? '';

        // Kolom relasi untuk tabel
        $x->nama_siswa = $baris['nama_siswa'];
        $x->nama_sarpras = $baris['nama_sarpras'];
        $x->nama_kategori = $baris['nama_kategori'];
        $x->nama_lokasi = $baris['nama_lokasi'];
        $x->nama_status = $baris['nama_status'];

        $pengaduan[] = $x;
    }

    // Data untuk view
    $dataView = compact(
        'pengaduan',
        'siswa',
        'sarpras',
        'lokasi',
        'status',
        'kategori',
        'search',
        'tanggal',
        'bulan',
        'filterSiswa',
        'filterTanggal',
        'filterBulan',
        'filterKategori',
        'filterStatus',
        'sort',
        'halaman',
        'totalHalaman',
        'totalData',
        'perHalaman',
        'offset'
    );

    // Tampilkan halaman sesuai role
    if ($user->role === 'admin') {
        return view('admin.pengaduan.index', $dataView);
    }

    return view('pengaduan.index', $dataView);
}



    // =====================================
    // FORM MEMBUAT PENGADUAN
    // =====================================
    public function create(Request $request)
    {
        $sarpras = Sarpras::all();
        $lokasi = Lokasi::all();

        return view(
            'pengaduan.create',
            compact('sarpras', 'lokasi')
        );
    }

    // =====================================
    // SIMPAN PENGADUAN BESERTA FOTO
    // =====================================
    public function store(Request $request)
    {
        $request->validate([
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',
            'id_sarpras' => 'required|exists:sarpras,id_sarpras',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $user = User::current();

        if (!$user) {
            abort(401, 'Silakan login terlebih dahulu.');
        }

        $siswa = Siswa::where(
            'id_user',
            $user->id
        )->first();

        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan.');
        }

        $status = Status::where(
            'nama_status',
            'Menunggu'
        )->first();

        if (!$status) {
            abort(404, 'Status Menunggu tidak ditemukan.');
        }

        $namaFoto = null;

        if (
            isset($_FILES['foto']) &&
            $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            $file = $_FILES['foto'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                abort(422, 'Upload foto gagal.');
            }

            if (
                !is_uploaded_file($file['tmp_name']) ||
                !isset($file['name'], $file['size'])
            ) {
                abort(422, 'Data foto tidak valid.');
            }

            if ($file['size'] > 2 * 1024 * 1024) {
                abort(422, 'Ukuran foto maksimal 2 MB.');
            }

            $infoGambar = @getimagesize($file['tmp_name']);

            if ($infoGambar === false) {
                abort(422, 'File yang diunggah bukan gambar.');
            }

            $mimeDiizinkan = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
            ];

            $mime = $infoGambar['mime'] ?? '';

            if (!isset($mimeDiizinkan[$mime])) {
                abort(
                    422,
                    'Foto harus berformat JPG, PNG, atau WEBP.'
                );
            }

            $folderFoto = dirname(__DIR__, 2)
                . '/public/uploads/pengaduan';

            if (
                !is_dir($folderFoto) &&
                !mkdir($folderFoto, 0755, true) &&
                !is_dir($folderFoto)
            ) {
                abort(500, 'Folder penyimpanan foto gagal dibuat.');
            }

            $fileBaru = bin2hex(random_bytes(16))
                . '.'
                . $mimeDiizinkan[$mime];

            $tujuanFoto = $folderFoto . '/' . $fileBaru;

            if (!move_uploaded_file(
                $file['tmp_name'],
                $tujuanFoto
            )) {
                abort(500, 'Foto gagal disimpan.');
            }

            $namaFoto = 'uploads/pengaduan/' . $fileBaru;
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

    // =====================================
    // DETAIL PENGADUAN
    // =====================================
    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $user = User::current();

        if (!$user) {
            abort(401, 'Silakan login terlebih dahulu.');
        }

        if ($user->role === 'admin') {
            $siswa = Siswa::findOrFail($pengaduan->id_siswa);
            $sarpras = Sarpras::all();
            $lokasi = Lokasi::all();
            $status = Status::all();
            $kategori = Kategori::all();

            return view(
                'admin.pengaduan.show',
                compact(
                    'pengaduan',
                    'siswa',
                    'sarpras',
                    'lokasi',
                    'status',
                    'kategori'
                )
            );
        }

        $siswa = Siswa::where(
            'id_user',
            $user->id
        )->first();

        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan.');
        }

        if (
            (string) $pengaduan->id_siswa !==
            (string) $siswa->id_siswa
        ) {
            abort(403);
        }

        $sarpras = Sarpras::all();
        $lokasi = Lokasi::all();
        $status = Status::all();

        return view(
            'pengaduan.show',
            compact(
                'pengaduan',
                'siswa',
                'sarpras',
                'lokasi',
                'status'
            )
        );
    }

    // =====================================
    // ADMIN MENGUBAH STATUS
    // =====================================
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
            ->route(
                'admin.pengaduan.show',
                ['id_pengaduan' => $id_pengaduan]
            )
            ->with('success', 'Status berhasil diperbarui.');
    }

    // =====================================
    // ADMIN MEMBERIKAN TANGGAPAN
    // =====================================
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
            ->route(
                'admin.pengaduan.show',
                ['id_pengaduan' => $id_pengaduan]
            )
            ->with('success', 'Tanggapan berhasil disimpan.');
    }
}