@extends('template.index')

@section('judul','Aset Kamar')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Pilih Kamar</h3>

  </div>
  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered" id='fasilitas'>
            <thead>
                <tr>
                    <th>Nomor Kamar</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    The footer of the box
  </div>
  <!-- box-footer -->
</div>  
@endsection
@section("css")
    <link rel="stylesheet" href="{{asset('aset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section("jscript")
<script src="{{asset('aset/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('aset/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(()=>{
            const cols = {columns:[
                {data:"nomor",name:"nomor"},
                {data:"aksi",name:"aksi"},  
            ]}
            $("#fasilitas").DataTable({
                ...cols,
                serverSide:true,
                processing:true,
                ajax:{
                    url:"{{route('api.datatable.fasilitas')}}",
                }
            });
            
        });
    </script>
@endsection

