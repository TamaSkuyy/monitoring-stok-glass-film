<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Barang;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try {
            // Add user_id to the order data
            $orderData = $request->validated();
            $orderData['total'] = 0;
            $orderData['vendor_id'] = 1;
            $orderData['user_id'] = auth()->id();

            // Create order header
            $order = Order::create($orderData);

            // Create order details
            foreach ($request->input('barang_id') as $key => $barangId) {
                if ($barangId !== null) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'barang_id' => $barangId,
                        'jumlah' => $request->input('jumlah_order')[$key],
                        'subtotal' => 0,
                    ]);
                }
            }

            $searchValue = $request->input('search');

            $order = Order::query()
                ->when($searchValue, function ($query, $searchValue) {
                    return $query->where('id', 'like', '%' . $searchValue . '%');
                })
            // ->orderByDesc('reorder_point') // Order by reorder point first
                ->orderByDesc('created_at') // Then order by created_at as a tiebreaker
                ->paginate(10);

            flash('Data sudah berhasil disimpan!')->success();
            return redirect('/order');

            // return redirect('/order')
            //     ->compact('order', 'searchValue')
            //     ->with('success', 'Order created successfully');
        } catch (\Exception $e) {
            // untuk cek error
            // return response()->json([
            //     'error' => 'Failed to create order',
            //     'message' => $e->getMessage(),
            // ], 500);

            return redirect()
                ->back()
                ->with('error', 'Failed to create order: ' . $e->getMessage())
                ->with('flash_message', 'Mohon periksa kembali inputan Anda!')
                ->withInput();
        }
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
        // Ambil data order details untuk order ini
        $orderDetails = OrderDetail::where('order_id', $order->id)
            ->with(['barang' => function ($query) {
                $query->with('vendor');
            }])
            ->get();

        // Ambil data barang dan vendor
        $barangs = Barang::all();
        $vendors = Vendor::all();

        // Kirim data ke view
        return view('order.order_edit', compact('order', 'orderDetails', 'barangs', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        DB::beginTransaction();
        try {
            // Update order header
            $order->update([
                'total' => 0,
                'vendor_id' => 1,
                'user_id' => auth()->id(),
                'status_order' => $request->status_order ?? 'pending',
            ]);

            // Get all existing detail IDs
            $existingDetails = OrderDetail::where('order_id', $order->id)->get();
            $submittedDetailIds = $request->input('detail_id', []);

            // Delete details not present in the form
            foreach ($existingDetails as $detail) {
                if (!in_array($detail->id, $submittedDetailIds)) {
                    $detail->delete();
                }
            }

            // Process order details
            foreach ($request->input('barang_id') as $key => $barangId) {
                if (!$barangId) {
                    continue;
                }

                $detailData = [
                    'order_id' => $order->id,
                    'barang_id' => $barangId,
                    'jumlah' => $request->input('jumlah_order')[$key],
                    'subtotal' => 0,
                ];

                // Update or create detail
                if (isset($request->input('detail_id')[$key])) {
                    OrderDetail::where('id', $request->input('detail_id')[$key])
                        ->update($detailData);
                } else {
                    OrderDetail::create($detailData);
                }
            }

            DB::commit();
            flash('Data sudah berhasil diupdate!')->success();
            return redirect('/order');

        } catch (\Exception $e) {
            DB::rollBack();
            // \Log::error('Order update failed: ' . $e->getMessage());

            // untuk cek error
            // return response()->json([
            //     'error' => 'Failed to create order',
            //     'message' => $e->getMessage(),
            // ], 500);

            return redirect()
                ->back()
                ->withErrors(['error' => 'Gagal mengupdate order'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            DB::beginTransaction();

            // Delete all related order details first
            OrderDetail::where('order_id', $order->id)->delete();

            // Then delete the order
            $order->delete();

            DB::commit();
            flash('Order berhasil dihapus!')->success();
            return redirect('/order');

        } catch (\Exception $e) {
            DB::rollBack();
            flash('Gagal menghapus order: ' . $e->getMessage())->error();
            return redirect()->back();
        }
    }
}
