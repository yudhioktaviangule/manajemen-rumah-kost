@extends('template.index')

@section('judul','Laporan')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Pilih Jenis Laporan</h3>

  </div>
  <div class="box-body">
      <div class="container-fluid">
          
              <div class="text-center">
                  <a href="{{ route('laporan_pemasukan.index') }}" class="btn btn-primary">Laporan Pemasukan</a>
                  <br>
                  <br>
                  <a href="{{ route('laporan_pengeluaran.index') }}" class="btn btn-success">Laporan Pengeluaran</a>
              </div>
          
      </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    The footer of the box
  </div>
  <!-- box-footer -->
</div>  
@endsection

