<?php  
  
namespace App\Controllers;  
  
use Sakuci\Controller;  
use Sakuci\Http\Request;  
use App\Models\Sarpras;  
use App\Models\Kategori;  
use App\Models\Lokasi;  
  
class SarprasController extends Controller  
{  
    public function index(Request $request)  
    {  
        $sarpras = Sarpras::join(  
            'kategori',  
            'sarpras.id_kategori',  
            '=',  
            'kategori.id_kategori'  
        )  
        ->join(  
            'lokasi',  
            'sarpras.id_lokasi',  
            '=',  
            'lokasi.id_lokasi'  
        )  
        ->select(  
            'sarpras.*',  
            'kategori.nama_kategori',  
            'lokasi.nama_lokasi'  
        )  
        ->orderBy('sarpras.id_sarpras', 'desc')  
        ->paginate(5);  
  
        $kategori = Kategori::all();  
        $lokasi = Lokasi::all();  
  
        return view('sarpras.index', compact(  
            'sarpras',  
            'kategori',  
            'lokasi'  
        ));  
    }  
  
    public function create(Request $request)  
    {  
        $kategori = Kategori::all();  
        $lokasi = Lokasi::all();  
  
        return view('sarpras.create', compact(  
            'kategori',  
            'lokasi'  
        ));  
    }  
  
    public function store(Request $request)  
    {  
        $request->validate([  
            'id_kategori' => 'required|exists:kategori,id_kategori',  
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',  
            'kode_sarpras' => 'required|string|max:50',  
            'nama_sarpras' => 'required|string|max:255',  
        ]);  
  
        Sarpras::create([  
            'id_kategori' => $request->input('id_kategori'),  
            'id_lokasi' => $request->input('id_lokasi'),  
            'kode_sarpras' => $request->input('kode_sarpras'),  
            'nama_sarpras' => $request->input('nama_sarpras'),  
        ]);  
  
        return redirect()  
            ->route('admin.sarpras.index')  
            ->with('success', 'Sarpras berhasil ditambahkan.');  
    }  
  
    public function edit($id_sarpras)  
    {  
        $sarpras = Sarpras::findOrFail($id_sarpras);  
        $kategori = Kategori::all();  
        $lokasi = Lokasi::all();  
  
        return view('sarpras.edit', compact(  
            'sarpras',  
            'kategori',  
            'lokasi'  
        ));  
    }  
  
    public function update(Request $request, $id_sarpras)  
    {  
        $request->validate([  
            'id_kategori' => 'required|exists:kategori,id_kategori',  
            'id_lokasi' => 'required|exists:lokasi,id_lokasi',  
            'kode_sarpras' => 'required|string|max:50',  
            'nama_sarpras' => 'required|string|max:255',  
        ]);  
  
        $sarpras = Sarpras::findOrFail($id_sarpras);  
  
        $sarpras->update([  
            'id_kategori' => $request->input('id_kategori'),  
            'id_lokasi' => $request->input('id_lokasi'),  
            'kode_sarpras' => $request->input('kode_sarpras'),  
            'nama_sarpras' => $request->input('nama_sarpras'),  
        ]);  
  
        return redirect()  
            ->route('admin.sarpras.index')  
            ->with('success', 'Sarpras berhasil diperbarui.');  
    }  
  
    public function delete($id_sarpras)  
    {  
        $sarpras = Sarpras::findOrFail($id_sarpras);  
        $sarpras->delete();  
  
        return redirect()  
            ->route('admin.sarpras.index')  
            ->with('success', 'Sarpras berhasil dihapus.');  
    }  
}
