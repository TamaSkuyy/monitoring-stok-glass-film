<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
// Dalam Controller
public function index(Request $request)
{
    $searchValue = $request->input('search');

    $barang = Barang::query()
        ->when($searchValue, function ($query, $searchValue) {
            return $query->where('nama_barang', 'like', '%' . $searchValue . '%')
                         ->orWhere('kode_barang', 'like', '%' . $searchValue . '%');
        })
        ->orderByDesc('reorder_point') // Order by reorder point first
        ->orderByDesc('created_at') // Then order by created_at as a tiebreaker
        ->paginate(10);

    return view('barang.barang_index', compact('barang', 'searchValue'));
}

// // Export data barang ke Excel
// public function exportExcel()
// {
//     return Excel::download(new BarangExport, 'barang.xlsx');
// }

// // Print data barang
// public function print()
// {
//     $barang = Barang::all();
//     return view('barang.print_barang', compact('barang'));
// }

 
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = new Barang;
        $vendors = Vendor::all();  // Ambil semua vendor
    
        return view('barang.barang_create', compact('barang', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required',
            'type' => 'required|in:pcs,box,roll',
            'kategori' => 'required|in:retail,suzuki,tango',
            'vendor' => 'required|exists:vendors,id', // Validasi vendor harus ada di tabel vendors
        ]);
    
        // Mencari barang berdasarkan ID
        $barang = new \App\Models\Barang(); // Mendapatkan barang dengan ID yang sesuai
    
        // Mengisi data pada model barang dengan data yang sudah tervalidasi
        $barang->fill($requestData); 
    
        // Jika nama kolom untuk vendor adalah 'vendor_id', pastikan untuk mengubahnya di sini
        $barang->vendor_id = $request->vendor; // Menghubungkan vendor yang dipilih ke vendor_id
    
        // Menyimpan data barang yang sudah diperbarui ke database
        $barang->save();
    
        // Menampilkan flash message sukses
        flash('Data sudah berhasil diubah!')->success();
    
        // Mengarahkan user kembali ke halaman daftar barang
        return redirect('/barang');
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
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $vendors = Vendor::all();  // Ambil semua vendor
    
        return view('/barang/barang_edit', compact('barang', 'vendors'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima dari form
        $requestData = $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $id,
            'nama_barang' => 'required',
            'type' => 'required|in:pcs,box,roll',
            'kategori' => 'required|in:retail,suzuki,tango',
            'vendor' => 'required|exists:vendors,id', // Validasi vendor harus ada di tabel vendors
        ]);
    
        // Mencari barang berdasarkan ID
        $barang = \App\Models\Barang::findOrFail($id); // Mendapatkan barang dengan ID yang sesuai
    
        // Mengisi data pada model barang dengan data yang sudah tervalidasi
        $barang->fill($requestData); 
    
        // Jika nama kolom untuk vendor adalah 'vendor_id', pastikan untuk mengubahnya di sini
        $barang->vendor_id = $request->vendor; // Menghubungkan vendor yang dipilih ke vendor_id
    
        // Menyimpan data barang yang sudah diperbarui ke database
        $barang->save();
    
        // Menampilkan flash message sukses
        flash('Data sudah berhasil diubah!')->success();
    
        // Mengarahkan user kembali ke halaman daftar barang
        return redirect('/barang');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = \App\Models\Barang::findOrFail($id);
        $barang->delete();
        flash('Data sudah dihapus')->success();
        return back();

    }
}
