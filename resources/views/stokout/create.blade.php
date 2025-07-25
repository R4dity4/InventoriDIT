@extends('welcome')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Stok Keluar</title>
</head>
<body>
  <div class="container">
    <h2 class="my-3 text-center">Tambah Stok Keluar</h2><br>
    
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    
    <a href="{{ route('stokout.index') }}" class="btn btn-outline-primary btn-sm" style="width: 100px">Kembali</a><br><br>
    
    <form method="post" action="{{ route('stokout.store') }}">
      @csrf
      
      <label for="produk_id">Produk</label><br>
      <select class="form-control" name="produk_id" required>
        <option value="">Pilih Produk</option>
        @foreach($produks as $produk)
          <option value="{{ $produk->id }}" {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
            {{ $produk->nama }} (Stok: {{ $produk->stok }})
          </option>
        @endforeach
      </select><br>
      @error('produk_id')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      
      <label for="jumlah">Jumlah Keluar</label><br>
      <input type="number" class="form-control" name="jumlah" value="{{ old('jumlah') }}" min="1" required><br>
      @error('jumlah')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      
      <label for="tgl_keluar">Tanggal Keluar</label><br>
      <input type="date" class="form-control" name="tgl_keluar" value="{{ old('tgl_keluar', date('Y-m-d')) }}" required><br>
      @error('tgl_keluar')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      
      <label for="keterangan">Keterangan</label><br>
      <textarea class="form-control" name="keterangan" rows="3" maxlength="100" required>{{ old('keterangan') }}</textarea><br>
      @error('keterangan')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      
      <button type="submit" class="btn btn-success mt-3">Simpan</button>
      <a href="{{ route('stokout.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
  </div>

  <script>
    // Auto-update available stock when product changes
    document.querySelector('select[name="produk_id"]').addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      if (selectedOption.value) {
        const stockText = selectedOption.text;
        const stock = stockText.match(/Stok: (\d+)/);
        if (stock) {
          const maxStock = parseInt(stock[1]);
          document.querySelector('input[name="jumlah"]').setAttribute('max', maxStock);
        }
      }
    });
  </script>

</body>
</html>
@endsection
