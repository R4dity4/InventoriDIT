@extends('welcome')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Stok Masuk</h3>
          <div class="card-tools">
            <a href="{{ route('stokins.index') }}" class="btn btn-secondary btn-sm">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
          </div>
        </div>
        <div class="card-body">
          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <!-- @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif -->

          <form action="{{ route('stokins.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="produk_id">Produk <span class="text-danger">*</span></label>
              <select name="produk_id" id="produk_id" class="form-control @error('produk_id') is-invalid @enderror" required>
                <option value="" disabled selected>Pilih Produk</option>
                @foreach ($produks as $produk)
                  <option value="{{ $produk->id }}" {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
                    {{ $produk->nama_produk }} (Stok: {{ $produk->stok }})
                  </option>
                @endforeach
              </select>
              @error('produk_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="jumlah">Jumlah <span class="text-danger">*</span></label>
              <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" min="1" required>
              @error('jumlah')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="tanggal_masuk">Tanggal Masuk</label>
              <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk', date('Y-m-d')) }}">
              @error('tanggal_masuk')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="elektronik" {{ old('kategori') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                    <option value="pakaian" {{ old('kategori') == 'pakaian' ? 'selected' : '' }}>Pakaian</option>
                    <option value="makanan" {{ old('kategori') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                    <option value="minuman" {{ old('kategori') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                    <option value="peralatan_rumah" {{ old('kategori') == 'peralatan_rumah' ? 'selected' : '' }}>Peralatan Rumah</option>
                    <option value="kecantikan" {{ old('kategori') == 'kecantikan' ? 'selected' : '' }}>Kecantikan</option>
                    <option value="olahraga" {{ old('kategori') == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                    <option value="buku" {{ old('kategori') == 'buku' ? 'selected' : '' }}>Buku</option>
                    <option value="mainan" {{ old('kategori') == 'mainan' ? 'selected' : '' }}>Mainan</option>
                </select>
                @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan') }}</textarea>
              @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
              </button>
              <a href="{{ route('stokins.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
