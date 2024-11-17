<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimbulanSampah;
use App\Models\KomposisiSampah;
use App\Models\PemilahanSampah;

class StatistikController extends Controller
{
    public function index()
    {
        return view('pages.statistics-pages');
    }

    public function getTimbulanData(Request $request)
    {
        $kategori = $request->input('kategori', 'all');
        
        $data = TimbulanSampah::when($kategori != 'all', function ($query) use ($kategori) {
            return $query->where('kategori', $kategori);
        })->get(['nama', 'jumlah']);
        
        return response()->json($data);
    }

    public function getKomposisiData()
    {
        $data = KomposisiSampah::all(['kategori', 'jumlah']);
        return response()->json($data);
    }

    public function getPemilahanData()
    {
        $data = PemilahanSampah::all(['kategori', 'jumlah']);
        return response()->json($data);
    }
}
