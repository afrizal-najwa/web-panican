<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimbulanSampah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TimbulanSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Cek apakah request berasal dari AJAX untuk DataTables
        if ($request->ajax()) {
            // Pastikan 'id' juga dipilih selain 'kategori' dan 'jumlah'
            $data = TimbulanSampah::select(['id', 'kategori','nama','jumlah']);

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    // $editUrl = route('timbulan.edit', $row->id);
                    $deleteUrl = route('timbulan.destroy', $row->id);
                    return '
                        
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                        </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Mengembalikan view dengan data timbulan sampah
        return view('pages.admin.pengelolaan.timbulan.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.pengelolaan.timbulan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   // TimbulanSampahController.php

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1'
        ]);

        $timbulan = TimbulanSampah::where('nama', $request->nama)
                        ->where('kategori', $request->kategori)
                        ->first();

        if ($timbulan) {
            $timbulan->jumlah += $request->jumlah;
            $timbulan->save();
        } else {
            TimbulanSampah::create([
                'nama' => $request->nama,
                'kategori' => $request->kategori,
                'jumlah' => $request->jumlah
            ]);
        }

        return redirect()->route('timbulan.index')->with('success', 'Data berhasil ditambahkan atau diperbarui!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil data berdasarkan ID
        $timbulanSampah = TimbulanSampah::findOrFail($id);
    
        // Mengembalikan view dengan data tersebut
        return view('pages.admin.pengelolaan.timbulan.index', compact('timbulanSampah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mengambil data berdasarkan ID
        $timbulanSampah = TimbulanSampah::findOrFail($id);
        // Mengembalikan view dengan data yang akan diedit
        return view('pages.admin.pengelolaan.timbulan.edit', compact('timbulanSampah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1'
        ]);

        // Mengambil data berdasarkan ID dan memperbarui
        $timbulanSampah = TimbulanSampah::findOrFail($id);
        $timbulanSampah->update($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('timbulan.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mengambil data berdasarkan ID dan menghapusnya
        $timbulanSampah = TimbulanSampah::findOrFail($id);
        $timbulanSampah->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('timbulan.index')->with('success', 'Data berhasil dihapus');
    }

    public function getTimbulanData(Request $request)
    {
        // Ambil kategori dari request, default 'all' jika tidak ada
        $kategori = $request->input('kategori', 'all');

        // Jika kategori 'all', ambil semua data, jika tidak, filter berdasarkan kategori
        if ($kategori === 'all') {
            $data = TimbulanSampah::select('nama', 'kategori', 'jumlah')->get();
        } else {
            $data = TimbulanSampah::where('kategori', $kategori)->select('nama', 'kategori', 'jumlah')->get();
        }

        // Mengembalikan data dalam bentuk JSON
        return response()->json($data);
    }
}
