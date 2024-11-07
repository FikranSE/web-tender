<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Tender;
use App\Models\Penawar;
use Illuminate\Support\Facades\Storage;
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
  public function edit(string $id)
  {
    // Fetch tender and related paket options for the dropdown
    $tender = Tender::findOrFail($id);
    $pakets = Paket::all();

    return view('tenders.edit', compact('tender', 'pakets'));
  }

  public function store(Request $request)
  {
    // Validate the form input
    $validatedData = $request->validate([
      'id_paket' => 'required|exists:paket,id_paket',
      'kode_tender' => 'required|unique:tender,kode_tender',
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
      if ($request->hasFile('dokumen_pemilihan')) {
        $file = $request->file('dokumen_pemilihan');
        $filePath = $file->store('dokumen_pemilihan', 'public');
        $validatedData['dokumen_pemilihan'] = $filePath;
      }

      if ($request->hasFile('berita_acara')) {
        $file = $request->file('berita_acara');
        $filePath = $file->store('berita_acara', 'public');
        $validatedData['berita_acara'] = $filePath;
      }

      // Create the tender with all validated data
      $tender = new Tender($validatedData);

      // Explicitly set the status
      $tender->status = $request->input('status');

      // Save the new tender
      $tender->save();

      \Log::info('New Tender created. Status: ' . $tender->status);

      return redirect()->route('admin/tender')->with('success', 'Tender added successfully');
    } catch (\Exception $e) {
      \Log::error('Failed to create tender: ' . $e->getMessage());
      return redirect()->back()->withInput()->with('error', 'Failed to create tender. Please try again. Error: ' . $e->getMessage());
    }
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
    // Find the tender
    $tender = Tender::findOrFail($id);

    // Delete the tender
    $tender->delete();

    return redirect()->route('admin/tender')->with('success', 'Tender deleted successfully');
  }
}