<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Ruangan;
use App\Models\Gedung;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
       $ruangan = ruangan::orderBy('id_ruangan', 'desc')->paginate(5);
       $gedung = Gedung::all();
       return view ('ruangan.index', compact('ruangan','gedung'));
    }

    public function create(Request $request)
    {
        $gedung = Gedung::all();
        return view('ruangan.create', compact('gedung'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'id_gedung' => 'required|exists:gedung,id_gedung'
        ]);

        ruangan::create([
            'nama_ruangan' => $request->input('nama_ruangan'),
            'id_gedung' => $request->input ('id_gedung')
        ]);

        return redirect()->route('admin.ruangan.index')->with('success', 'Tempat berhasil ditambahkan.');
    }
  

  public function edit($id_ruangan)
    {
        $ruangan = ruangan::findOrFail($id_ruangan);
        $gedung = Gedung::All();
        return $this->view('ruangan.edit', compact('ruangan','gedung'));
    }

    public function update(Request $request, $id_ruangan)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'id_gedung' => 'required|exists:gedung,id_gedung',
        ]);

        $ruangan = ruangan::findOrFail($id_ruangan);
        $ruangan->update([
            'nama_ruangan' => $request->input('nama_ruangan'),
            'id_gedung' => $request->input ('id_gedung')
        ]);

        return redirect()->route('admin.ruangan.index')->with('success', 'Tempat berhasil diperbarui.');
    }

  public function delete($id)
    {
        $ruangan = ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('admin.ruangan.index')->with('success', 'Tempat berhasil dihapus.');
    } 
}
