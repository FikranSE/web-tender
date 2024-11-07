<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Tender;
 
class HomeController extends Controller
{
    
 
    public function index()
    {
      $tenders = Tender::with('paket')->get();
        return view('index', compact('tenders'));
    }
 
    public function adminHome()
    {
        return view('dashboard');
    }
}