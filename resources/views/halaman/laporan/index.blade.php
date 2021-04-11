@extends('template.index')

@section('judul','Laporan')
@section('content')
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Pilih Jenis Laporan</h3>

  </div>
  <div class="card-body">
      <div class="container-fluid">
          
              <div class="text-center">
                  <a href="{{ route('laporan_pemasukan.index') }}" class="btn btn-primary">Laporan Pemasukan</a>
                  <br>
                  <br>
                  <a href="{{ route('laporan_pengeluaran.index') }}" class="btn btn-success">Laporan Pengeluaran</a>
              </div>
          
      </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    The footer of the card
  </div>
  <!-- card-footer -->
</div>  
@endsection

