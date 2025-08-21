@extends('welcome')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Stok Masuk</h3>
          <div class="card-tools">
            <a href="{{ route('stokins.create') }}" class="btn btn-primary btn-sm">
              <i class="fas fa-plus"></i> Tambah Stok Masuk
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

          <!-- @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif -->

          <table class="table table-bordered table-striped table-hover">
            <thead class="table-success">
              <tr>
                <th>ID</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <!-- <th>Satuan</th> -->
                <th>Tanggal Masuk</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($stokins as $stokin)
                <tr>
                  <td>{{ $stokin->id }}</td>
                  <td>{{ $stokin->produk->nama}}</td>
                  <td>{{ $stokin->jumlah }}</td>
                  <!-- <td>{{ $stokin->satuan }}</td> -->
                  <td>{{ $stokin->tgl_masuk }}</td>
                  <td>{{ $stokin->keterangan ?? '-' }}</td>
                  <td>
                    <div class="d-flex gap-1">
                      <!-- <a href="{{ route('stokins.show', $stokin->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                      </a> -->
                      <a href="{{ route('stokins.edit', $stokin->id) }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{ route('stokins.destroy', $stokin->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                  <td colspan="7" class="text-center">Tidak ada data stok masuk</td>
                </tr>
              @endforelse
            </tbody>
          </table>

          <div class="mt-3">
            {{ $stokins->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
