@extends('template.index')

@section('judul','Pengeluaran')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Pengeluaran</h3>
    <div class="box-tools pull-right">
      <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-plus"></i> Pengeluaran
      </a>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
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
  
  <!-- /.box-body -->
  <div class="box-footer">
    The footer of the box
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