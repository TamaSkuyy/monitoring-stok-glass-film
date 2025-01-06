
            <table class="table table-striped">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'kode_barang', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                Kode Barang
                                @if (request('sort') == 'kode_barang')
                                    <i class="fa fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama_barang', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                Nama Barang
                                @if (request('sort') == 'nama_barang')
                                    <i class="fa fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'type', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                Type
                                @if (request('sort') == 'type')
                                    <i class="fa fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'kategori', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                Kategori
                                @if (request('sort') == 'kategori')
                                    <i class="fa fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'stok_awal', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                Stok Awal
                                @if (request('sort') == 'stok_awal')
                                    <i class="fa fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'stok_maksimal', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                Stok Maksimal
                                @if (request('sort') == 'stok_maksimal')
                                    <i class="fa fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'stok_minimal', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                Stok Minimal
                                @if (request('sort') == 'stok_minimal')
                                    <i class="fa fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'reorder_point', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                Reorder Point
                                @if (request('sort') == 'reorder_point')
                                    <i class="fa fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'vendor', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                Vendor
                                @if (request('sort') == 'vendor')
                                    <i class="fa fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                                Dibuat
                                @if (request('sort') == 'created_at')
                                    <i class="fa fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $item)
                        <tr>
                            <td>{{ ($barang->currentPage() - 1) * $barang->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->stok_awal }}</td>
                            <td>{{ $item->stok_maksimal }}</td>
                            <td>{{ $item->stok_minimal }}</td>
                            <td>{{ $item->reorder_point }}</td>
                            <td>{{ $item->vendor ? $item->vendor->nama_vendor : 'Vendor Tidak Tersedia' }}</td>
                            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
