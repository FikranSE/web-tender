<?php

namespace App\Http\Controllers;

use App\Models\HasilEvaluasi;
use App\Models\Penawar;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    public function show($id)
    {
        $offer = Penawar::findOrFail($id);
        $evaluasi = HasilEvaluasi::where('id_penawar', $id)->first();
        
        return view('evaluasi.show', compact('offer', 'evaluasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
            'id_penawar' => 'required|exists:penawar,id'
        ]);

        try {
          HasilEvaluasi::updateOrCreate(
                ['id_penawar' => $request->id_penawar],
                [
                    'alasan' => $request->alasan,
                    'evaluasi_administrasi' => $request->has('evaluasi_administrasi') ? 1 : 0,
                    'evaluasi_teknis' => $request->has('evaluasi_teknis') ? 1 : 0,
                    'harga_penawaran' => $request->has('harga_penawaran') ? 1 : 0,
                    'evaluasi_penawaran' => $request->has('evaluasi_penawaran') ? 1 : 0,
                    'pemenang' => $request->has('pemenang') ? 1 : 0,
                ]
            );

            return redirect()->back()->with('success', 'Evaluasi berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan evaluasi')->withInput();
        }
    }
}