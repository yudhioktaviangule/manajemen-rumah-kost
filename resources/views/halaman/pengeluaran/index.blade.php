@extends('template.index')

@php
  $now = \Carbon\Carbon::now();
  $tahun = \Carbon\Carbon::now()->format("Y");
  $bulan = \Carbon\Carbon::now()->format("M Y");
  $tglAwal = $now->firstOfMonth()->format("Y-m-d");
  $tglAkhir = $now->endOfMonth()->format("Y-m-d");
  $pengeluaranBulanan = $pengeluaranBL->getPengeluaran([$tglAwal,$tglAkhir]);
  $yearAwal = $now->copy()->startOfYear()->format("Y-m-d");
  $yearAkhir = $now->copy()->endOfYear()->format("Y-m-d");
  $pengeluaranTahunan = $pengeluaranBL->getPengeluaran([$yearAwal,$yearAkhir]);
  $allPengeluaran = $pengeluaranBL->getAllPengeluaran();
@endphp
@section('judul','Pengeluaran')
@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-4">
        <div class="card bg-purple">
          <div class="card-body">
              <i class="fas fa-chart-line fa-2x"></i>
              <h3 id='pengeluaran-bulan-ini'>{{number_format($pengeluaranBulanan)}}</h3>
              <p>Pengeluaran Bulan {{$bulan}}</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card bg-primary">
            <div class="card-body">
                <i class="fas fa-chart-line fa-2x"></i>
                <h3 id='pengeluaran-bulan-ini'>{{number_format($pengeluaranTahunan)}}</h3>
                <p>Pengeluaran Tahun {{$tahun}}</p>
            </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card bg-green">
              <div class="card-body">
                  <i class="fas fa-chart-line fa-2x"></i>
                  <h3 id='pengeluaran-bulan-ini'>{{number_format($allPengeluaran)}}</h3>
                  <p>Total Pengeluaran</p>
              </div>
        </div>      
      </div>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Daftar Pengeluaran</h3>
    <div class="card-tools pull-right">
      <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-plus"></i> Pengeluaran
      </a>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="col-md-12 col-xs-12 col-lg-12">
        &nbsp;
    </div>
    <div class="col-md-12 col-xs-12 col-lg-12">
      <div class="table-responsive">
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>No. Transaksi</th>
                      <th>Tanggal</th>
                      <th>Jenis Pengeluaran </th>
                      <th>Ket. Lunas</th>
                      <th class='text-right'>Nominal</th>
                      <th class='text-right'>
                        <i class="fa fa-cog"></i>
                      </th>
                  </tr>
                 
              </thead>
              <tbody>
              
  
              </tbody>
          </table>
  
          <form action="" id="form-hapus" method="post">
              <div id="auth"></div>
              <input type='hidden' name='_method' value='delete'>
          </form>
  
      </div>
    </div>
  </div>
  
  <!-- /.card-body -->
  <div class="card-footer">
    The footer of the card
  </div>
  <!-- card-footer -->
</div>
<!-- /.card -->
@endsection
@section("css")
<link rel="stylesheet" href="{{asset('lte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section("jscript")
<script src="{{asset('lte3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('lte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('lte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte3/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('lte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>  
  <script>
    $(document).ready(()=>{
      window.hapus = (id)=>{
          const f = $("#form-hapus");
          const url = id;
          const con = confirm("Ingin Menghapus Data?")
          if(con){
            f.attr('action',url);
            f.submit();
          }
      }
      window.createDtable = ()=>{
        if(window.dtTable!=undefined){
          window.dtTable.destroy();
        }
        window.dtTable = $(".table").DataTable({
          serverSide:true,
          processing:true,
          columns:[
            {data:'nomor',name:'nomor'},
            {data:'tanggal',name:'tanggal'},
            {data:'pengeluaran',name:'pengeluaran'},
            {data:'lunas',name:'lunas'},
            {data:'nominal',name:'nominal'},
            {data:'aksi',name:'aksi'},
          ],
          ajax:{
            url:`{{route('api.datatable.pengeluaran')}}`,
            type:'post',
            data:{
              '_token':`{{csrf_token()}}`,
              '_f' : $("#aktivasi").val()==''?'nofiltered' : $("#aktivasi").val(),
            }
          }
        });
      }
      createDtable();
    })
  </script>

@endsection