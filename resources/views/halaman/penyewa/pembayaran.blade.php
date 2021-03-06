@php
    
    $penyewa    = $ks->getPenyewa();
    $kamar      = $ks->getKamar();
@endphp
@extends('template.index')
@section('judul','Pembayaran')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Riwayat Pembayaran</h3>
    <div class="box-tools pull-right">
     
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
        
        <table>
            <tr>
                <th style='width:200px'>Nama</th>
                <td>: {{$penyewa->name}}</td>
            </tr>
            <tr>
                <th>Kamar</th>
                <td>: {{$kamar->nomor}}</td>
            </tr>
            <tr>
                <th>Tagihan / Bulan</th>
                <td>: Rp. {{number_format($kamar->harga)}} / Bulan</td>
            </tr>
            <tr>
                <th>Lama Sewa</th>
                <td>: {{number_format($ks->lama_sewa)}} Bulan</td>
            </tr>
            <tr>
                <th>Total Tagihan</th>
                <td>: Rp. {{number_format($ks->total_sewa)}} </td>
            </tr>
        </table>
        <table class="table table-bordered">
            <thead>
                <th>Tanggal</th>
                <th>No. Pembayaran</th>
                <th>Nama Tagihan</th>
                <th>Total Tagihan</th>
                <th>Jumlah Bayar</th>
                <th>Sisa Tagihan</th>
                <th>Status</th>
                <th class='text-right'>
                    <i class="fa fa-cog"></i>
                </th>
            </thead>
        </table>    
        <form action="" id="form-hapus" method="post">
            <div id="auth"></div>
            <input type='hidden' name='_method' value='delete'>
        </form>

    </div>
  </div>
  
  <!-- /.box-body -->
  <div class="box-footer">
    <a href="#" class="btn  btn-primary"><i class="fa fa-get-pocket"></i> Buat Pembayaran</a>
  </div>
  <!-- box-footer -->
</div>
<!-- /.box -->
@endsection
@section("css")
    <link rel="stylesheet" href="{{asset('aset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section("jscript")
<script src="{{asset('aset/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('aset/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <script>
    $(document).ready(()=>{
      window.hapus = (id)=>{
          const f = $("#form-hapus");
          const url = `{{ route('penyewa.index') }}/${id}`;
          const con = confirm("Ingin Menghapus Data?")
          if(con){
            f.attr('action',url);
            f.submit();
          }
      }
      $(".table").dataTable();
    })
  </script>

@endsection