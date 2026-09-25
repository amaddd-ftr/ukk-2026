<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Prasarana;
use App\Models\Ruangan;
use App\Models\Kondisi;

class PrasaranaController extends Controller
{
    public function index(Request $request)
    {
        $prasarana = Prasarana::orderBy('id_prasarana', 'desc')->paginate(5);
        $ruangan = Ruangan::all();
        $kondisi = Kondisi::all();

        return view('prasarana.index', compact('prasarana', 'ruangan', 'kondisi'));
    }

    public function create(Request $request)
    {
        $ruangan = Ruangan::all();
        $kondisi = Kondisi::all();

        return view('prasarana.create', compact('ruangan', 'kondisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required|exists:ruangan,id_ruangan',
            'id_kondisi' => 'required|exists:kondisi,id_kondisi',
            'kode_prasarana' => 'required|string|max:50',
            'nama_prasarana' => 'required|string|max:255',
            'jumlah_prasarana' => 'required|integer|min:1',
        ]);

        Prasarana::create([
            'id_ruangan' => $request->input('id_ruangan'),
            'id_kondisi' => $request->input('id_kondisi'),
            'kode_prasarana' => $request->input('kode_prasarana'),
            'nama_prasarana' => $request->input('nama_prasarana'),
            'jumlah_prasarana' => $request->input('jumlah_prasarana'),
        ]);

        return redirect()
            ->route('admin.prasarana.index')
            ->with('success', 'Prasarana berhasil ditambahkan.');
    }

    public function edit($id_prasarana)
    {
        $prasarana = Prasarana::findOrFail($id_prasarana);
        $ruangan = Ruangan::all();
        $kondisi = Kondisi::all();

        return view('prasarana.edit', compact('prasarana', 'ruangan', 'kondisi'));
    }

    public function update(Request $request, $id_prasarana)
    {
        $request->validate([
            'id_ruangan' => 'required|exists:ruangan,id_ruangan',
            'id_kondisi' => 'required|exists:kondisi,id_kondisi',
            'kode_prasarana' => 'required|string|max:50',
            'nama_prasarana' => 'required|string|max:255',
            'jumlah_prasarana' => 'required|integer|min:1',
        ]);

        $prasarana = Prasarana::findOrFail($id_prasarana);

        $prasarana->update([
            'id_ruangan' => $request->input('id_ruangan'),
            'id_kondisi' => $request->input('id_kondisi'),
            'kode_prasarana' => $request->input('kode_prasarana'),
            'nama_prasarana' => $request->input('nama_prasarana'),
            'jumlah_prasarana' => $request->input('jumlah_prasarana'),
        ]);

        return redirect()
            ->route('admin.prasarana.index')
            ->with('success', 'Prasarana berhasil diperbarui.');
    }

    public function delete($id_prasarana)
    {
        $prasarana = Prasarana::findOrFail($id_prasarana);
        $prasarana->delete();

        return redirect()
            ->route('admin.prasarana.index')
            ->with('success', 'Prasarana berhasil dihapus.');
    }
}