@extends('welcome')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk</title><hr><br>
</head>
<body>
  <div class="container">
  <h2 class="my-3 text-center">Edit Produk</h2><br>
  
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  
  <a href="{{ route('produk.index') }}" class="btn btn-outline-primary btn-sm" style="width: 100px">Kembali</a><br><br>
    
    <form method="post" action="{{ route('produk.update', $produk->id) }}">
      @csrf
      @method('PUT')
      
      <label for="nama">Nama Barang</label><br>
      <input type="text" class="form-control" name="nama" value="{{ old('nama', $produk->nama) }}" required><br>
      @error('nama')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      
      <label for="keterangan">Keterangan</label><br>
      <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan', $produk->keterangan) }}" required><br>
      @error('keterangan')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      
      <label for="stok">Stok</label><br>
      <input type="number" class="form-control" name="stok" value="{{ old('stok', $produk->stok) }}" min="0" required><br>
      @error('stok')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      
      <label for="harga">Harga</label><br>
      <input type="number" class="form-control" name="harga" value="{{ old('harga', $produk->harga) }}" step="0.01" min="0" required><br>
      @error('harga')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      
      <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
  </div>

</body>
</html>
@endsection
