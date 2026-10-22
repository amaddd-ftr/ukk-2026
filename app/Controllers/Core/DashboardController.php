<?php

namespace App\Controllers\Core;

use Sakuci\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pengaduan;
use App\Models\Lokasi;
use App\Models\Status;

class DashboardController extends Controller
{
    /**
     * Dashboard siswa
     */
    public function index()
    {
        $user = User::current();

        $siswa = Siswa::where('id_user', $user->id)->first();

        $pengaduanTerbaru = [];

        if ($siswa) {
            $pengaduanTerbaru = Pengaduan::where(
                'id_siswa',
                $siswa->id_siswa
            )
                ->orderBy('id_pengaduan', 'desc')
                ->limit(3)
                ->get();
        }

        return view('core.dashboard', [
            'user' => $user,
            'siswa' => $siswa,
            'pengaduanTerbaru' => $pengaduanTerbaru,
            'lokasi' => Lokasi::all(),
            'status' => Status::all(),
        ]);
    }

    /**
     * Dashboard admin
     */
    public function admin()
    {
        $user = User::current();

        $statusMenunggu = Status::where(
            'nama_status',
            'Menunggu'
        )->first();

        $pengaduanTerbaru = [];

        if ($statusMenunggu) {
            $pengaduanTerbaru = Pengaduan::where(
                'id_status',
                $statusMenunggu->id_status
            )
                ->orderBy('id_pengaduan', 'desc')
                ->get();

            foreach ($pengaduanTerbaru as $item) {
                // Ambil data siswa berdasarkan pengaduan
                $siswaItem = Siswa::find($item->id_siswa);

                // Ambil data lokasi berdasarkan pengaduan
                $lokasiItem = Lokasi::find($item->id_lokasi);

                // Tambahkan nama agar dapat dipakai di view
                $item->nama = $siswaItem->nama ?? '-';
                $item->nama_lokasi = $lokasiItem->nama_lokasi ?? '-';
            }
        }

        return view('core.admin.dashboard', [
            'user' => $user,
            'pengaduanTerbaru' => $pengaduanTerbaru,
            'lokasi' => Lokasi::all(),
            'status' => Status::all(),
        ]);
    }
}