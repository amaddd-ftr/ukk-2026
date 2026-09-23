<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Gedung;

class GedungController extends Controller
{
    public function index(Request $request)
    {
       $gedung = gedung::orderBy('id_gedung', 'desc')->paginate(5);
       return view ('gedung.index', compact('gedung'));
    }

    public function create(Request $request)
    {
        return view('gedung.create');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung' => 'required|string|max:255',
        ]);

        gedung::create([
            'nama_gedung' => $request->input('nama_gedung'),
        ]);

        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil ditambahkan.');
    }
  

  public function edit($id_gedung)
    {
        $gedung = gedung::findOrFail($id_gedung);
        return $this->view('gedung.edit', compact('gedung'));
    }

    public function update(Request $request, $id_gedung)
    {
        $request->validate([
            'nama_gedung' => 'required|string|max:255',
        ]);

        $gedung = gedung::findOrFail($id_gedung);
        $gedung->update([
            'nama_gedung' => $request->input('nama_gedung'),
        ]);

        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil diperbarui.');
    }

  public function delete(Request $request, $id)
    {
        $gedung = gedung::findOrFail($id);
        $gedung->delete();

        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil dihapus.');
    } 
}
