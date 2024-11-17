<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PemilahanSampah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PemilahanSampahController extends Controller
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
            $data = PemilahanSampah::select(['id', 'kategori', 'jumlah']);

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    // $editUrl = route('pemilahan.edit', $row->id);
                    $deleteUrl = route('pemilahan.destroy', $row->id);
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

        // Mengembalikan view dengan data pemilahan sampah
        return view('pages.admin.pengelolaan.pemilahan.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.pengelolaan.pemilahan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   // PemilahanSampahController.php

    public function store(Request $request)
    {
    // Validasi input dari form
        $request->validate([
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Cari apakah ada kategori yang sama di database
        $pemilahan = PemilahanSampah::where('kategori', $request->kategori)->first();

        if ($pemilahan) {
            // Jika kategori ditemukan, tambahkan jumlahnya
            $pemilahan->jumlah += $request->jumlah;
            $pemilahan->save();
        } else {
            // Jika kategori tidak ditemukan, buat entri baru
            PemilahanSampah::create([
                'kategori' => $request->kategori,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect()->route('pemilahan.index')->with('success', 'Data berhasil ditambahkan atau diperbarui!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil data berdasarkan ID
        $pemilahanSampah = PemilahanSampah::findOrFail($id);
    
        // Mengembalikan view dengan data tersebut
        return view('pages.admin.pengelolaan.pemilahan.index', compact('pemilahanSampah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mengambil data berdasarkan ID
        $pemilahanSampah = PemilahanSampah::findOrFail($id);

    
        // Mengembalikan view dengan data yang akan diedit
        return view('pages.admin.pengelolaan.pemilahan.edit', compact('pemilahanSampah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'kategori' => 'required|string',
            'jumlah' => 'required|numeric',
        ]);

        // Mengambil data berdasarkan ID dan memperbarui
        $pemilahanSampah = PemilahanSampah::findOrFail($id);
        $pemilahanSampah->update($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pemilahan.index')->with('success', 'Data berhasil ditambahkan atau diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mengambil data berdasarkan ID dan menghapusnya
        $pemilahanSampah = PemilahanSampah::findOrFail($id);
        $pemilahanSampah->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pemilahan.index')->with('success', 'Data berhasil dihapus');
    }

    public function getPemilahanData()
    {
        // Mengambil data kategori dan jumlah dari database
        $data = PemilahanSampah::select('kategori', 'jumlah')->get();
        
        // Mengembalikan data dalam bentuk JSON
        return response()->json($data);
    }
}
