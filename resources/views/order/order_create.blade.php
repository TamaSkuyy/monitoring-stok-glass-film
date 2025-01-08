@extends('layouts.app_lte', ['title' => 'Order Barang'])

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="form-group mt-1 mb-3 row">
                    <div class="col-md-6 col-sm-12">
                        <label for="kode_order">ID Order</label>
                        <input type="text" class="form-control @error('kode_order') is-invalid @enderror" id="kode_order"
                            name="kode_order" value="{{ old('kode_order', 'ORD-' . sprintf('%05d', $orderId)) }}" readonly>
                        <span class="text-danger">{{ $errors->first('id') }}</span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="tanggal_order">Tanggal order</label>
                        <!-- The tanggal_order field is set to readonly to prevent users from changing the date -->
                        <input type="text" class="form-control @error('tanggal_order_text') is-invalid @enderror"
                            id="tanggal_order_text" name="tanggal_order_text"
                            value="{{ old('tanggal_order_text', date('d F Y')) }}" readonly>
                        <input type="hidden" name="tanggal_order" value="{{ now()->format('Y-m-d') }}">

                        <span class="text-danger">{{ $errors->first('tanggal_order') }}</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="order_detail" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah Order</th>
                                <th>Vendor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="barang-container">
                            <tr id="barang-template" style="display: none;">
                                <td>
                                    <select class="form-control @error('barang_id.*') is-invalid @enderror"
                                        name="barang_id[]" style="text-align-last: center;">
                                        <option value="" selected>Pilih Barang</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}" data-vendorid="{{ $barang->vendor_id }}"
                                                data-vendorname="{{ $vendors->find($barang->vendor_id)->nama_vendor ?? '' }}">
                                                {{ $barang->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('barang_id.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" min="1"
                                        class="form-control @error('jumlah_order.*') is-invalid @enderror"
                                        name="jumlah_order[]">
                                    @error('jumlah_order.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" name="nama_vendor[]" class="form-control" readonly>
                                    <input type="hidden" class="form-control" readonly name="vendor_id[]">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger remove-barang">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <button type="button" class="btn btn-primary add-barang">Tambah Barang</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="form-group mt-1 mb-3">
                    <label for="status_order">Status</label>
                    <input type="text" class="form-control @error('status_order') is-invalid @enderror" id="status_order"
                        name="status_order" value="{{ old('status_order') }}">
                    <span class="text-danger">{{ $errors->first('status_order') }}</span>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/order" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the container
            const container = document.getElementById('barang-container');

            // Direct event listener for select elements
            container.addEventListener('change', function(e) {
                // Check if the changed element is a select
                if (e.target.tagName === 'SELECT' && e.target.name === 'barang_id[]') {
                    try {
                        const selectedOption = e.target.options[e.target.selectedIndex];
                        const vendorId = selectedOption.getAttribute('data-vendorid');
                        const vendorName = selectedOption.getAttribute('data-vendorname');
                        const parentRow = e.target.closest('tr');

                        if (parentRow && vendorId) {
                            const vendorInput = parentRow.querySelector('input[name="vendor_id[]"]');
                            const vendorNameInput = parentRow.querySelector(
                                'input[name="nama_vendor[]"]'); // Changed to input

                            if (vendorInput && vendorNameInput) {
                                vendorInput.value = vendorId;
                                vendorNameInput.value = vendorName; // Set text value instead
                            } else {
                                console.error('Vendor input fields not found');
                            }
                        }
                    } catch (error) {
                        console.error('Error updating vendor:', error);
                    }
                }
            });

            // Initialize all existing select elements
            const existingSelects = container.querySelectorAll('select[name="barang_id[]"]');
            existingSelects.forEach(select => {
                // Trigger initial vendor ID setup
                const event = new Event('change');
                select.dispatchEvent(event);
            });
        });

        // Event delegation to handle remove button click
        document.getElementById('barang-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-barang')) {
                e.target.closest('tr').remove();
            }
        });
        document.querySelector('.add-barang').addEventListener('click', function() {
            let newRow = document.querySelector('#barang-template').cloneNode(true);
            newRow.style.display = '';
            newRow.removeAttribute('id');
            newRow.querySelectorAll('input').forEach(function(input) {
                input.value = '';
            });
            newRow.querySelectorAll('select').forEach(function(select) {
                select.selectedIndex = 0;
            });
            document.querySelector('#barang-container').appendChild(newRow);
        });
    </script>
@endsection
