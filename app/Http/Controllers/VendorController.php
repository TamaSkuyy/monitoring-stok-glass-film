<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('search');
    
        $vendor = Vendor::query()
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where('nama_vendor', 'like', '%' . $searchValue . '%')
                             ->orWhere('kode_vendor', 'like', '%' . $searchValue . '%');
            })
            // ->orderByDesc('reorder_point') // Order by reorder point first
            ->orderByDesc('created_at') // Then order by created_at as a tiebreaker
            ->paginate(10);
    
        return view('vendor.vendor_index', compact('vendor', 'searchValue'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.vendor_create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kode_vendor' => 'required|unique:vendors,kode_vendor',
            'nama_vendor' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
        ]);
    
        // Mencari vendor berdasarkan ID
        $vendor = new \App\Models\vendor(); // Mendapatkan vendor dengan ID yang sesuai
    
        // Mengisi data pada model vendor dengan data yang sudah tervalidasi
        $vendor->fill($requestData); 
    
        // Menampilkan flash message sukses
        flash('Data sudah berhasil diubah!')->success();
    
        // Mengarahkan user kembali ke halaman daftar vendor
        return redirect('/vendor');
            //mengarahkan user ke url sebelumnya yaitu /pasien/create dengan membawa variabel pesan

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendor = Vendor::findOrFail($id);
            
        return view('vendor.vendor_edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'kode_vendor' => 'required|unique:vendors,kode_vendor,'. $id,
            'nama_vendor' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
        ]);
    
        // Mencari vendor berdasarkan ID
        $vendor = \App\Models\Vendor::findOrFail($id); // Mendapatkan vendor dengan ID yang sesuai
    
        // Mengisi data pada model vendor dengan data yang sudah tervalidasi
        $vendor->fill($requestData); 
        $vendor->save();
    
        // Menampilkan flash message sukses
        flash('Data sudah berhasil diubah!')->success();
    
        // Mengarahkan user kembali ke halaman daftar vendor
        return redirect('/vendor');
            //mengarahkan user ke url sebelumnya yaitu /pasien/create dengan membawa variabel pesan

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vendor = \App\Models\Vendor::findOrFail($id);
        $vendor->delete();
        flash('Data sudah dihapus')->success();
        return back();
    }
}
