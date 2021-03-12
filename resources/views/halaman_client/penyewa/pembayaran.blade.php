@extends('template.index')

@section('judul','Penghuni')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Penghuni</h3>
    <div class="box-tools pull-right">
      <a href="{{ route('penyewa.create') }}" class="btn btn-primary btn-sm">
          Register Penghuni
      </a>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
        
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
          const url = `{{ route('penyewa.index') }}/${id}`;
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
            {data:'nik',name:'nik'},
            {data:'name',name:'name'},
            {data:'hp',name:'hp'},
            {data:'jenis_kelamin',name:'jenis_kelamin'},
            {data:'kota_asal',name:'kota_asal'},
            {data:'pekerjaan',name:'pekerjaan'},
            {data:'nomor',name:'nomor'},
            {data:'aksi',name:'aksi'},
          ],
          ajax:{
            url:`{{route('api.datatable.penyewa')}}`,
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