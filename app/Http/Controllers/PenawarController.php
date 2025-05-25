<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Tender;
use App\Models\Penawar;
use App\Models\HasilEvaluasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Validation\Rule;


class PenawarController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // Fetch tenders with related paket information
    $offers = Penawar::with(['tender', 'peserta'])->orderBy('created_at', 'DESC')->get();

    return view('penawaran.index', compact('offers'));
  }



  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    // Fetch all available paket options to populate the dropdown
    $pakets = Paket::with('tenders');

    return view('tenders.create', compact('pakets'));
  }


  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    // Find tender and related paket data
    $tender = Tender::with('paket')->findOrFail($id);

    return view('tenders.show', compact('tender'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $offer = Penawar::findOrFail($id);
    $evaluasi = HasilEvaluasi::where('id_penawar', $id)->first();
    return view('penawaran.edit', compact('offer', 'evaluasi'));
  }


  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'id_tender' => 'required|exists:tender,id_tender',
      'nama_perusahaan' => 'required|string|max:255',
      'npwp' => 'required|string|max:20',
      'email' => 'required|email|max:255',
      'nomor_telepon' => 'required|string|max:20',
      'alamat' => 'required|string|max:500',
      'dokumen_perusahaan' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
      'dokumen_penawaran' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
      'harga_penawaran' => 'required|numeric|min:0',
    ]);

    if ($request->hasFile('dokumen_perusahaan')) {
      $filePath = $request->file('dokumen_perusahaan')->store('dokumen_perusahaan', 'public');
      $validatedData['dokumen_perusahaan'] = $filePath;
    }

    if ($request->hasFile('dokumen_penawaran')) {
      $filePath = $request->file('dokumen_penawaran')->store('dokumen_penawaran', 'public');
      $validatedData['dokumen_penawaran'] = $filePath;
    }

    $id_peserta = Auth::id();

    $validatedData['id_peserta'] = $id_peserta;

    Penawar::create($validatedData);

    return redirect()->route('listTender')->with('success', 'Penawaran berhasil disimpan.');
  }



  public function update(Request $request, $id)
  {
    // Validate the form input
    $validatedData = $request->validate([
      'id_paket' => 'required|exists:paket,id_paket',
      'kode_tender' => 'required|unique:tender,kode_tender,' . $id . ',id_tender',
      'nama_tender' => 'required|string|max:255',
      'tahapan_tender_saat_ini' => 'required|string|max:255',
      'tanggal_mulai' => 'required|date',
      'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
      'dokumen_pemilihan' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB max
      'berita_acara' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Set as file
      'hasil_evaluasi' => 'nullable|string',
      'status' => 'required|in:draft,aktif,selesai,dibatalkan',
    ]);

    try {
      $tender = Tender::findOrFail($id);

      if ($request->hasFile('dokumen_pemilihan')) {
        if ($tender->dokumen_pemilihan) {
          Storage::disk('public')->delete($tender->dokumen_pemilihan);
        }

        $file = $request->file('dokumen_pemilihan');
        $filePath = $file->store('dokumen_pemilihan', 'public');
        $validatedData['dokumen_pemilihan'] = $filePath;
      }

      if ($request->hasFile('berita_acara')) {
        if ($tender->berita_acara) {
          Storage::disk('public')->delete($tender->berita_acara);
        }

        $file = $request->file('berita_acara');
        $filePath = $file->store('berita_acara', 'public');
        $validatedData['berita_acara'] = $filePath;
      }

      $tender->fill($validatedData);
      $tender->status = $request->input('status');
      $tender->save();

      \Log::info('Tender updated. New status: ' . $tender->status);

      return redirect()->route('admin/tender')->with('success', 'Tender updated successfully');
    } catch (\Exception $e) {
      \Log::error('Failed to update tender: ' . $e->getMessage());
      return redirect()->back()->withInput()->with('error', 'Failed to update tender. Please try again. Error: ' . $e->getMessage());
    }
  }



  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $penawar = Penawar::findOrFail($id);

    $penawar->delete();

    return redirect()->back()->with('success', 'Penawaran deleted successfully');
  }
}