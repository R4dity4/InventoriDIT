@extends('welcome')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Produk</h3>
          <div class="card-tools">
            <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
              <i class="fas fa-plus"></i> Tambah Produk
            </a>
          </div>
        </div>
        <div class="card-body">
          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <table class="table table-bordered table-striped table-hover">
            <thead class="table-success">
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kegelapan</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($produks as $produk)
              <tr>
                <td>{{ $produk->id }}</td>
                <td>{{ $produk->nama }}</td>
                <td>{{ $produk->keterangan }}</td>
                <td>{{ $produk->stok }}</td>
                <td class="text-success">Rp.{{ $produk->harga }}</td>
                <td>
                  <div class="d-flex gap-1">
                    <!-- <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-info btn-sm">
                      <i class="fas fa-eye"></i>
                    </a> -->
                    <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-outline-warning btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $produk->nama }}?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center">Tidak ada data produk</td>
              </tr>
              @endforelse
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
