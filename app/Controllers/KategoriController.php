<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Kategori; 

class KategoriController extends Controller
{
    public function index(Request $request)
    {
       $kategori = kategori::orderBy('id_kategori', 'desc')->paginate(5);
       return view ('kategori.index', compact('kategori'));
    }

    public function create(Request $request)
    {
        return view('kategori.create');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $request->input('nama_kategori'),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
  
  public function delete(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    } 
}

