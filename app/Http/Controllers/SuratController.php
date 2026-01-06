<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $query = Surat::with('kategori', 'user');

        if ($user->role === 'karyawan') {
            $query->where('user_id', $user->id);
        }

        return view('surat.index', [
            'surats' => $query->latest()->get()
        ]);
    }

    public function create()
    {
        return view('surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori_id' => 'required|exists:kategori_surats,id',
        ]);

        Surat::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori_id' => $request->kategori_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('surat.index');
    }

    public function show(Surat $surat)
    {
        abort_if(
            auth()->user()->role !== 'admin' &&
            $surat->user_id !== auth()->id(),
            403
        );

        return view('surat.show', compact('surat'));
    }

    public function edit(Surat $surat)
    {
        abort_if(
            auth()->user()->role !== 'admin' &&
            $surat->user_id !== auth()->id(),
            403
        );

        return view('surat.edit', compact('surat'));
    }

    public function update(Request $request, Surat $surat)
    {
        abort_if(
            auth()->user()->role !== 'admin' &&
            $surat->user_id !== auth()->id(),
            403
        );

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori_id' => 'required|exists:kategori_surats,id',
        ]);

        $surat->update($request->only('judul', 'isi', 'kategori_id'));

        return redirect()->route('surat.index');
    }

    public function destroy(Surat $surat)
    {
        abort_if(
            auth()->user()->role !== 'admin' &&
            $surat->user_id !== auth()->id(),
            403
        );

        $surat->delete();

        return redirect()->route('surat.index');
    }
}