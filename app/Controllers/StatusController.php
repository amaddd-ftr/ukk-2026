<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        $status = Status::orderBy('id_status', 'desc')->paginate(5);

        return view('status.index', compact('status'));
    }

    public function create(Request $request)
    {
        return view('status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_status' => 'required|string|max:100',
        ]);

        Status::create([
            'nama_status' => $request->input('nama_status'),
        ]);

        return redirect()
            ->route('admin.status.index')
            ->with('success', 'Status berhasil ditambahkan.');
    }

    public function edit($id_status)
    {
        $status = Status::findOrFail($id_status);

        return view('status.edit', compact('status'));
    }

    public function update(Request $request, $id_status)
    {
        $request->validate([
            'nama_status' => 'required|string|max:100',
        ]);

        $status = Status::findOrFail($id_status);

        $status->update([
            'nama_status' => $request->input('nama_status'),
        ]);

        return redirect()
            ->route('admin.status.index')
            ->with('success', 'Status berhasil diperbarui.');
    }

    public function delete($id_status)
    {
        $status = Status::findOrFail($id_status);
        $status->delete();

        return redirect()
            ->route('admin.status.index')
            ->with('success', 'Status berhasil dihapus.');
    }
}