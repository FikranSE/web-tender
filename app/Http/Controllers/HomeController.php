<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Tender;
use Illuminate\Support\Facades\Auth;
 
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // If user is admin, redirect to admin dashboard
        if (auth()->user()->type === 'admin') {
            return redirect()->route('admin/home');
        }
        
        // If user is provider, show provider-specific view or redirect as needed
        if (auth()->user()->type === 'provider') {
            // You can create a specific view for providers or redirect them to a specific route
            return view('provider.index');
        }
        
        // For regular users, show the tender list
        $tenders = Tender::with('paket')->get();
        return view('index', compact('tenders'));
    }
 
    public function adminHome()
    {
        // Only admin can access this
        if (auth()->user()->type !== 'admin') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        
        return view('dashboard');
    }
}