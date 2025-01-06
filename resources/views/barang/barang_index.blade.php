@extends('layouts.app_lte', ['title' => 'Data Barang'])

@section('content')

<div class="card">
    <!-- Card Body -->
    <div class="card-body">
        
        <!-- Tombol "Tambah Barang" dan Form Pencarian -->
        {{-- <div class="row mb-3">
            <div class="col-md-6">
                <a href="/barang/create" class="btn btn-primary btn-sm">Tambah Barang</a>
            </div>
            <div class="col-md-6 text-right">
              
            </div>
        </div> --}}
        
                <!-- Search Form -->
                <div class="row">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('barang.index') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{ $searchValue }}" placeholder="Search barang...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br />
                    <div class="col-md-6 text-right">
                        <a href="/barang/create" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>

        <br />

        <!-- Tabel Data Barang -->
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="fixed-header">
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th class="fixed-column">Nama Barang</th>
                    <th>Stok Awal</th>
                    <th>Stok Akhir</th>
                    <th>Reorder Point</th>
                    <th>Stok Maksimal</th>
                    <th>Stok Minimal</th>
                    <th>Type</th>
                    <th>Kategori</th>
                    <th>Vendor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                <tr>
                    <td>{{ $loop->iteration + ($barang->currentPage() - 1) * $barang->perPage() }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td class="fixed-column">{{ $item->nama_barang }}</td>
                    <td>{{ $item->stok_awal }}</td>
                    <td>{{ $item->stok_akhir }}</td>
                    <td>
                        @if ($item->stok_akhir < $item->stok_minimal)
                            <span class="badge badge-danger">Urgent Order</span>
                        @elseif ($item->stok_akhir >= $item->stok_minimal && $item->stok_akhir <= $item->stok_minimal + 10)
                            <span class="badge badge-warning">Reorder</span>
                        @else
                            <span class="badge badge-success">Aman</span>
                        @endif
                    </td>
                    <td>{{ $item->stok_maksimal }}</td>
                    <td>{{ $item->stok_minimal }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->vendor ? $item->vendor->nama_vendor : 'Tidak Tersedia' }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                        </form>
                    </td>

                @endforeach
            </tbody>

        </table>
        </div>

          <!-- Pagination -->

        <!-- Export dan Print -->
        {{-- <div class="mt-3">
            <a href="{{ route('barang.exportExcel') }}" class="btn btn-success">Export to Excel</a>
            <a href="{{ route('barang.print') }}" class="btn btn-warning" target="_blank">Print</a> --}}
        {{-- </div> --}}

        <div class="d-flex justify-content-between align-items-center mt-3">
            <!-- Jumlah data di kiri -->
            <div>
                <p class="mb-2">
                    Data No {{ $barang->firstItem() ?? 0 }} - {{ $barang->lastItem() ?? 0 }} 
                    dari total {{ $barang->total() }} data.
                </p>
            </div>
            <!-- Pagination di kanan -->
            <div>
                {{ $barang->links() }}
            </div>
        </div>       
    </div>
</div>
@endsection


