<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Paket;
 
class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Paket::orderBy('created_at', 'DESC')->get();
 
        return view('products.index', compact('product'));
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Paket::create($request->all());
 
        return redirect()->route('admin/products')->with('success', 'Paket added successfully');
    }
 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Paket::findOrFail($id);
 
        return view('products.show', compact('product'));
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = paket::findOrFail($id);
 
        return view('products.edit', compact('product'));
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Paket::findOrFail($id);
 
        $product->update($request->all());
 
        return redirect()->route('admin/products')->with('success', 'paket updated successfully');
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Paket::findOrFail($id);
 
        $product->delete();
 
        return redirect()->route('admin/products')->with('success', 'paket deleted successfully');
    }
}