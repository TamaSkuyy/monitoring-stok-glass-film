@extends('layouts.app_lte',['title' => 'Order Barang'])

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="/order" method="POST">
                @csrf
                <div class="form-group mt-1 mb-3 row">
                    <div class="col-md-6 col-sm-12">
                        <label for="ID_order">ID Order</label>
                        <input type="text" class="form-control @error('ID_order') is-invalid @enderror" id="ID_order" name="ID_order" value="{{ old('ID_order', 'ORD-'. sprintf('%05d', $orderId)) }}" readonly>
                        <span class="text-danger">{{ $errors->first('ID_order') }}</span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="Tanggal_order">Tanggal order</label>
                        <input type="text" class="form-control @error('Tanggal_order') is-invalid @enderror" id="Tanggal_order" name="Tanggal_order" value="{{ old('Tanggal_order', date('d F Y')) }}" readonly>
                        <span class="text-danger">{{ $errors->first('Tanggal_order') }}</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah Order</th>
                                <th>Vendor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="barang-container">
                            <tr>
                                <td>
                                    <div class="form-group">
                                       
                                        <select style="text-align-last: justify;" class="form-control select2 @error('barang_id.*') is-invalid @enderror" name="barang_id[]" id="barang_id">
                                            @foreach($barangs as $barang)
                                                <option value="{{ $barang->id }}" data-vendorid="{{ $barang->vendor_id }}">{{ $barang->nama_barang }}</option>
                                            @endforeach
                                        </select>
                                        @error('barang_id.*')
                                            <span class="text-danger">{{ $errors->first('barang_id.*') }}</span>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control @error('Jumlah_Order.*') is-invalid @enderror" name="Jumlah_Order[]" value="{{ old('Jumlah_Order.0') }}">
                                    <span class="text-danger">{{ $errors->first('Jumlah_Order.*') }}</span>
                                </td>
                                <td>
                                    <input type="text" class="form-control" readonly id="vendorLookup" name="vendorLookup[]">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger remove-barang">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <button type="button" class="btn btn-primary add-barang">Tambah</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <script>
                    $('#barang_id').change(function() {
                        let vendorId = $(this).find(':selected').data('vendorid');
                        $('#vendorLookup').val(vendorId);
                    });
                </script>

                <div class="form-group mt-1 mb-3">
                    <label for="Status_Order">Status</label>
                    <input type="text" class="form-control @error('Status_Order') is-invalid @enderror" id="Status_Order" name="Status_Order" value="{{ old('Status_Order') }}">
                    <span class="text-danger">{{ $errors->first('Status_Order') }}</span>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/order" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

    <script>

        // Event delegation to handle remove button click
        document.getElementById('barang-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-barang')) {
                e.target.closest('tr').remove();
            }
        });
        
        // Add new row when button is clicked
        document.querySelector('.add-barang').addEventListener('click', function() {
            let newRow = document.querySelector('#example1 tbody tr').cloneNode(true);
            newRow.querySelector('input').value = '';
            newRow.querySelectorAll('select').forEach(function(el) {
                el.selectedIndex = 0;
            });
            newRow.querySelectorAll('td').forEach(function(el) {
                el.classList.remove('sorting_1');
                el.classList.remove('sorting_2');
                el.classList.remove('sorting_3');
                el.classList.remove('sorting_asc');
                el.classList.remove('sorting_desc');
            });
            newRow.querySelectorAll('th').forEach(function(el) {
                el.classList.remove('sorting');
                el.classList.remove('sorting_asc');
                el.classList.remove('sorting_desc');
            });
            document.querySelector('#barang-container').appendChild(newRow);
        });
    </script>
@endsection
