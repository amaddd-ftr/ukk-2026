<?php

namespace App\Controllers;

use Sakuci\Controller;
use App\Models\Sarpras;
use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Status;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil ID kategori Sarana
        $sarana = Kategori::where(
            'nama_kategori',
            'Sarana'
        )->first();

        // Ambil ID kategori Prasarana
        $prasarana = Kategori::where(
            'nama_kategori',
            'Prasarana'
        )->first();

        // Hitung jumlah sarana
        $jumlahSarana = 0;

        if ($sarana) {
            $jumlahSarana = Sarpras::where(
                'id_kategori',
                $sarana->id_kategori
            )->count();
        }

        // Hitung jumlah prasarana
        $jumlahPrasarana = 0;

        if ($prasarana) {
            $jumlahPrasarana = Sarpras::where(
                'id_kategori',
                $prasarana->id_kategori
            )->count();
        }

        // Hitung seluruh pengaduan
        $jumlahPengaduan = Pengaduan::count();

        // Ambil status Selesai
        $statusSelesai = Status::where(
            'nama_status',
            'Selesai'
        )->first();

        // Hitung pengaduan yang sudah selesai
        $jumlahSelesai = 0;

        if ($statusSelesai) {
            $jumlahSelesai = Pengaduan::where(
                'id_status',
                $statusSelesai->id_status
            )->count();
        }

        return view(
            'welcome',
            compact(
                'jumlahSarana',
                'jumlahPrasarana',
                'jumlahPengaduan',
                'jumlahSelesai'
            )
        );
    }
}
