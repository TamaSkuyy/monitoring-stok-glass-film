<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Barang;
use App\Models\Vendor;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('search');
    
        $order = Order::query()
            ->when($searchValue, function ($query, $searchValue) {
                return $query->where('id', 'like', '%' . $searchValue . '%');
            })
            // ->orderByDesc('reorder_point') // Order by reorder point first
            ->orderByDesc('created_at') // Then order by created_at as a tiebreaker
            ->paginate(10);
    
        return view('order.order_index', compact('order', 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     */
// OrderController.php

public function create()
{
    // Ambil order terakhir dari database
    $latestOrder = Order::latest()->first();

    // Tentukan ID order baru
    $orderId = $latestOrder ? $latestOrder->id + 1 : 1; // Jika tidak ada order, mulai dari 1

    // Ambil data barang dan vendor
    $barangs = Barang::all();
    $vendors = Vendor::all();

    // Kirim data ke view
    return view('order.order_create', compact('orderId', 'barangs', 'vendors'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        foreach ($request->input('barang_id') as $key => $barangId) {
            $order->barang()->attach($barangId, [
                'Jumlah_Order' => $request->input('Jumlah_Order')[$key],
            ]);
        }

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}