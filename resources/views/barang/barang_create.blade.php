@extends('layouts.app_lte',['title' => 'Tambah Data barang'])

@section('content')
    <div class="card">
        <h5 class="card-header">Tambah Data Barang</h5>
        <div class="card-body">
            <form action="/barang" method="POST">
                @csrf
                <div class="form-group mt-1 mb-3">
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}">
                    <span class="text-danger">{{ $errors->first('kode_barang') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
                        <span class="text-danger">{{ $errors->first('nama_barang') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="type">Type</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="pcs" value="pcs" {{ old('type') === 'pcs' ? 'checked' : '' }}>
                            <label class="form-check-label" for="pcs">Pcs</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="box" value="box" {{ old('type') === 'box' ? 'checked' : '' }}>
                            <label class="form-check-label" for="box">Box</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="roll" value="roll" {{ old('type') === 'roll' ? 'checked' : '' }}>
                            <label class="form-check-label" for="roll">Roll</label>
                        </div>
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="kategori">Kategori</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kategori" id="retail" value="retail" {{ old('kategori') === 'retail' ? 'checked' : '' }}>
                            <label class="form-check-label" for="retail">Retail</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kategori" id="suzuki" value="suzuki" {{ old('kategori') === 'suzuki' ? 'checked' : '' }}>
                            <label class="form-check-label" for="suzuki">Suzuki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kategori" id="tango" value="tango" {{ old('kategori') === 'tango' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tango">Tango</label>
                        </div>
                        <span class="text-danger">{{ $errors->first('kategori') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="vendor">Vendor</label>
                    <select class="form-control @error('vendor') is-invalid @enderror" id="vendor" name="vendor">
                        <option value="" disabled selected>Pilih Vendor</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}" 
                                    {{ (old('vendor') ?? $barang->vendor->id ?? '') == $vendor->id ? 'selected' : '' }}>
                                {{ $vendor->nama_vendor }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('vendor') }}</span>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/barang" button type ="Submit" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
    @endsection
    