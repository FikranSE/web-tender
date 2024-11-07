<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Tender;
use App\Models\Penawar;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  public function userprofile()
  {
    return view('userprofile');
  }

  public function detailTender()
  {
    return view('detailTender');
  }

  public function buatPenawaran(Request $request)
  {
    // Validate the form input
    $validatedData = $request->validate([
      'id_tender' => 'required|exists:tender,id_tender',
      'nama_perusahaan' => 'required|string|max:255',
      'npwp' => 'required|string|max:20',
      'email' => 'required|email|max:255',
      'nomor_telepon' => 'required|string|max:20',
      'alamat' => 'required|string|max:500',
      'dokumen_perusahaan' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB max
      'dokumen_penawaran' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
      'harga_penawaran' => 'required|numeric|min:0',
    ]);

    try {
      $id_peserta = Auth::id();

      // Check if a record already exists
      $penawaran = Penawar::where('id_tender', $validatedData['id_tender'])
        ->where('id_peserta', $id_peserta)
        ->first();

      // Handling file uploads
      if ($request->hasFile('dokumen_perusahaan')) {
        $filePath = $request->file('dokumen_perusahaan')->store('dokumen_perusahaan', 'public');
        $validatedData['dokumen_perusahaan'] = $filePath;
      }

      if ($request->hasFile('dokumen_penawaran')) {
        $filePath = $request->file('dokumen_penawaran')->store('dokumen_penawaran', 'public');
        $validatedData['dokumen_penawaran'] = $filePath;
      }

      if ($penawaran) {
        // Update existing record
        $penawaran->update($validatedData);
        $message = 'Penawaran successfully updated.';
      } else {
        // Create new record
        $validatedData['id_peserta'] = $id_peserta;
        Penawar::create($validatedData);
        $message = 'Penawaran successfully submitted.';
      }

      return redirect()->back()->with('success', $message);
    } catch (\Exception $e) {
      \Log::error('Failed to submit/update penawaran: ' . $e->getMessage());
      return redirect()->back()->withInput()->with('error', 'Failed to submit/update penawaran. Please try again.');
    }
  }



  public function listTender()
  {
    $tenders = Tender::all();
    return view('listTender', compact('tenders'));
  }

  public function informasiTender(string $id)
  {
    $tender = Tender::findOrFail($id);
    $penawaran = Penawar::where('id_tender', $id)
      ->where('id_peserta', Auth::id())
      ->first();
    return view('informasiTender', compact('tender', 'penawaran'));
  }
}