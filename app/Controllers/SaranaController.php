<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Sarana;
use App\Models\Ruangan;
use App\Models\Kondisi;

class SaranaController extends Controller
{
    public function index(Request $request)
    {
        $sarana = Sarana::orderBy('id_sarana', 'desc')->paginate(5);
        $ruangan = Ruangan::all();
        $kondisi = Kondisi::all();
        return view('sarana.index', compact('sarana', 'ruangan', 'kondisi'));
    }

    public function create(Request $request)
    {
        $ruangan = Ruangan::all();
        $kondisi = Kondisi::all();
        return view('sarana.create', compact('ruangan', 'kondisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required|exists:ruangan,id_ruangan',
            'id_kondisi' => 'required|exists:kondisi,id_kondisi',
            'kode_sarana' => 'required|string|max:50',
            'nama_sarana' => 'required|string|max:255',
            'jumlah_sarana' => 'required|integer|min:1',
        ]);

        Sarana::create([
            'id_ruangan' => $request->input('id_ruangan'),
            'id_kondisi' => $request->input('id_kondisi'),
            'kode_sarana' => $request->input('kode_sarana'),
            'nama_sarana' => $request->input('nama_sarana'),
            'jumlah_sarana' => $request->input('jumlah_sarana'),
        ]);

        return redirect()->route('admin.sarana.index')->with('success', 'Sarana berhasil ditambahkan.');
    }

    public function edit($id_sarana)
    {
        $sarana = Sarana::findOrFail($id_sarana);
        $ruangan = Ruangan::all();
        $kondisi = Kondisi::all();
        return view('sarana.edit', compact('sarana', 'ruangan', 'kondisi'));
    }

    public function update(Request $request, $id_sarana)
    {
        $request->validate([
            'id_ruangan' => 'required|exists:ruangan,id_ruangan',
            'id_kondisi' => 'required|exists:kondisi,id_kondisi',
            'kode_sarana' => 'required|string|max:50',
            'nama_sarana' => 'required|string|max:255',
            'jumlah_sarana' => 'required|integer|min:1',
        ]);

        $sarana = Sarana::findOrFail($id_sarana);
        $sarana->update([
            'id_ruangan' => $request->input('id_ruangan'),
            'id_kondisi' => $request->input('id_kondisi'),
            'kode_sarana' => $request->input('kode_sarana'),
            'nama_sarana' => $request->input('nama_sarana'),
            'jumlah_sarana' => $request->input('jumlah_sarana'),
        ]);

        return redirect()->route('admin.sarana.index')->with('success', 'Sarana berhasil diperbarui.');
    }

    public function delete($id_sarana)
    {
        $sarana = Sarana::findOrFail($id_sarana);
        $sarana->delete();

        return redirect()->route('admin.sarana.index')->with('success', 'Sarana berhasil dihapus.');
    }
}
