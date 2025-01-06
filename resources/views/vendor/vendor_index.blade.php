@extends('layouts.app_lte', ['title' => 'Data Vendor'])

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
                        <form method="GET" action="{{ route('vendor.index') }}">
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
                        <a href="/vendor/create" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>

        <br />

        <!-- Tabel Data Barang -->
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="fixed-header">
                <tr>
                    <th>No</th>
                    <th>Kode Vendor</th>
                    <th class="fixed-column">Nama Vendor</th>
                    <th>Alamat</th>
                    <th>Kontak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendor as $item)
                <tr>
                    <td>{{ $loop->iteration + ($vendor->currentPage() - 1) * $vendor->perPage() }}</td>
                    <td>{{ $item->kode_vendor }}</td>
                    <td class="fixed-column">{{ $item->nama_vendor }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->kontak }}</td>

                    <td>
                        <a href="{{ route('vendor.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('vendor.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                        </form>
                    </td>

                </tr>
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
                    Data No {{ $vendor->firstItem() ?? 0 }} - {{ $vendor->lastItem() ?? 0 }} 
                    dari total {{ $vendor->total() }} data.
                </p>
            </div>
            <!-- Pagination di kanan -->
            <div>
                {{ $vendor->links() }}
            </div>
        </div>       
    </div>
</div>
@endsection


