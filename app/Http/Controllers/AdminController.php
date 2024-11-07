<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Menampilkan halaman profil admin
    public function profilepage()
    {
        return view('profile', [
            'user' => Auth::user() // Mengirim data user ke view
        ]);
    }

    // Menangani update profil admin
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(), // email harus unik kecuali milik user saat ini
        ]);

        // Ambil data user yang sedang login (admin)
        $admin = Auth::user();

        // Update data
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed', // validasi password dan konfirmasi
            ]);
            $admin->password = Hash::make($request->password);
        }

        // Simpan perubahan
        $admin->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin/profile')->with('success', 'Profile updated successfully.');
    }
}