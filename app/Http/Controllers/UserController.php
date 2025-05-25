<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Tender;
use App\Models\Penawar;
use App\Models\HasilEvaluasi;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  public function userprofile()
  {
    return view('userprofile');
  }

  public function detailTender(string $id)
  {
    try {
        // Get the tender data first to ensure it exists
        $tender = Tender::findOrFail($id);
        
        // Get bidders for this tender with their user data
        $penawar = Penawar::with('peserta')
            ->where('id_tender', $id)
            ->get();

        // Get evaluation results for this tender
        $hasil = HasilEvaluasi::with('penawar')
            ->whereHas('penawar', function ($query) use ($id) {
                $query->where('id_tender', $id);
            })
            ->get();

        return view('detailTender', [
            'penawar' => $penawar,
            'hasil' => $hasil,
            'tender' => $tender
        ]);
        
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('home')->with('error', 'Tender not found.');
    } catch (\Exception $e) {
        \Log::error('Error in detailTender: ' . $e->getMessage());
        return redirect()->route('home')->with('error', 'An error occurred while loading the tender details.');
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

  public function buatPenawaran(Request $request)
  {
    // Validate the input data
    $validator = $request->validate([
      'nama_perusahaan' => 'required|string|max:255',
      'npwp' => 'required|string|max:20',
      'email' => 'required|email',
      'nomor_telepon' => 'required|string|max:15',
      'alamat' => 'required|string',
      'dokumen_perusahaan' => 'nullable|file|mimes:pdf,doc,docx',
      'dokumen_penawaran' => 'nullable|file|mimes:pdf,doc,docx',
      'harga_penawaran' => 'required|numeric|min:0',
    ]);

    try {
      // Retrieve or create the Penawaran based on id_peserta and id_tender
      $penawaran = Penawar::where('id_peserta', $request->id_peserta)
        ->where('id_tender', $request->id_tender)
        ->first();

      if ($penawaran) {
        // Update existing Penawaran
        $penawaran->nama_perusahaan = $request->nama_perusahaan;
        $penawaran->npwp = $request->npwp;
        $penawaran->email = $request->email;
        $penawaran->nomor_telepon = $request->nomor_telepon;
        $penawaran->alamat = $request->alamat;
        $penawaran->harga_penawaran = $request->harga_penawaran;

        // Handle file upload for dokumen_perusahaan
        if ($request->hasFile('dokumen_perusahaan')) {
          if ($penawaran->dokumen_perusahaan) {
            Storage::delete($penawaran->dokumen_perusahaan);
          }
          $penawaran->dokumen_perusahaan = $request->file('dokumen_perusahaan')->store('dokumen_perusahaan');
        }

        // Handle file upload for dokumen_penawaran
        if ($request->hasFile('dokumen_penawaran')) {
          if ($penawaran->dokumen_penawaran) {
            Storage::delete($penawaran->dokumen_penawaran);
          }
          $penawaran->dokumen_penawaran = $request->file('dokumen_penawaran')->store('dokumen_penawaran');
        }

        $penawaran->save();
        $message = 'Penawaran updated successfully!';
      } else {
        // Create new Penawaran
        $penawaran = new Penawar();
        $penawaran->id_peserta = $request->id_peserta;
        $penawaran->id_tender = $request->id_tender;
        $penawaran->nama_perusahaan = $request->nama_perusahaan;
        $penawaran->npwp = $request->npwp;
        $penawaran->email = $request->email;
        $penawaran->nomor_telepon = $request->nomor_telepon;
        $penawaran->alamat = $request->alamat;
        $penawaran->harga_penawaran = $request->harga_penawaran;

        // Handle file upload for dokumen_perusahaan
        if ($request->hasFile('dokumen_perusahaan')) {
          $penawaran->dokumen_perusahaan = $request->file('dokumen_perusahaan')->store('dokumen_perusahaan');
        }

        // Handle file upload for dokumen_penawaran
        if ($request->hasFile('dokumen_penawaran')) {
          $penawaran->dokumen_penawaran = $request->file('dokumen_penawaran')->store('dokumen_penawaran');
        }

        $penawaran->save();
        $message = 'Penawaran created successfully!';
      }

      return redirect()->back()->with('success', $message);
    } catch (QueryException $e) {
      // Check if the error is a duplicate entry error
      if ($e->errorInfo[1] == 1062) {
        // Add duplicate entry error to the session
        return redirect()->back()->withErrors([
          'npwp' => 'The NPWP already exists in the system. Please use a unique NPWP.'
        ]);
      }

      // General SQL error message if it's a different type of error
      return redirect()->back()->withErrors([
        'error' => 'An unexpected error occurred. Please try again.'
      ]);
    }
  }
}