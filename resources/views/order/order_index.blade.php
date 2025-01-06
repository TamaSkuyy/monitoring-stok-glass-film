@extends('layouts.app_lte', ['title' => 'Data Order Glass Film'])

@section('content')

<div class="card">
    <!-- Card Body -->
    <div class="card-body">
               
                <!-- Search Form -->
                <div class="row">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('order.index') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{ $searchValue }}" placeholder="Search order...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br />
                    <div class="col-md-6 text-right">
                        <a href="/order/create" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>

        <br />

        <!-- Tabel Data order -->
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="fixed-header">
                <tr>
                    <th>ID</th>
                    <th>Tanggal Order</th>
                    <th>Jumlah Order</th>
                    <th>Vendor</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->tanggal_order }}</td>
                    <td>{{ $item->jumlah_order }}</td>
                    <td>{{ $item->vendor ? $item->vendor->nama_vendor : 'Tidak Tersedia' }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ route('order.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('order.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                        </form>
                    </td>

                @endforeach
            </tbody>

        </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <!-- Jumlah data di kiri -->
            <div>
                <p class="mb-2">
                    Data No {{ $order->firstItem() ?? 0 }} - {{ $order->lastItem() ?? 0 }} 
                    dari total {{ $order->total() }} data.
                </p>
            </div>
            <!-- Pagination di kanan -->
            <div>
                {{ $order->links() }}
            </div>
        </div>       
    </div>
</div>
@endsection


