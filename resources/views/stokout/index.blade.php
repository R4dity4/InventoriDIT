@extends('welcome')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Stok Keluar</title>
</head>
<body>
  <div class="container">
    <h2 class="my-3 text-center">Data Stok Keluar</h2><br>

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

    <a href="{{ route('stokouts.create') }}" class="btn btn-outline-primary btn-sm" style="width: 150px">Tambah Stok Keluar</a><br><br>

    <div>
      <table class="table table-bordered table-striped table-hover">
        <thead class="table-danger">
          <tr>
            <th>ID</th>
            <th>Produk</th>
            <th>Jumlah Keluar</th>
            <th>Tanggal Keluar</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($stokouts as $stokout)
          <tr>
            <td>{{ $stokout->id }}</td>
            <td>{{ $stokout->produk->nama ?? 'N/A' }}</td>
            <td>{{ $stokout->jumlah }}</td>
            <td>{{ \Carbon\Carbon::parse($stokout->tgl_keluar)->format('d/m/Y') }}</td>
            <td>{{ $stokout->keterangan }}</td>
            <td>
              <div class="d-flex gap-1">
                <a href="{{ route('stokouts.show', $stokout->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('stokouts.edit', $stokout->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('stokouts.destroy', $stokout->id) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data stok keluar {{ $stokout->produk->nama ?? 'ini' }}?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center">Tidak ada data stok keluar</td>
          </tr>
          @endforelse
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="d-flex justify-content-center">
        {{ $stokouts->links() }}
      </div>
    </div>
  </div>
</body>
</html>
@endsection
