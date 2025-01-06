@extends('layouts.app_lte',['title' => 'Tambah Data Vendor'])

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/vendor" method="POST">
                @csrf
                <div class="form-group mt-1 mb-3">
                    <label for="kode_vendor">Kode Vendor</label>
                    <input type="text" class="form-control @error('kode_vendor') is-invalid @enderror" id="kode_vendor" name="kode_vendor" value="{{ old('kode_vendor') }}">
                    <span class="text-danger">{{ $errors->first('kode_vendor') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="nama_vendor">Nama Vendor</label>
                        <input type="text" class="form-control @error('nama_vendor') is-invalid @enderror" id="nama_vendor" name="nama_vendor" value="{{ old('nama_vendor') }}">
                        <span class="text-danger">{{ $errors->first('nama_vendor') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="alamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
                        <span class="text-danger">{{ $errors->first('alamat') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="kontak">Kontak</label>
                        <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak" name="kontak" value="{{ old('kontak') }}">
                        <span class="text-danger">{{ $errors->first('kontak') }}</span>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/vendor" button type ="Submit" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
    @endsection
    