@extends('template.index')

@section('judul','Fasilitas Kamar')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Kamar</h3>
    
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered" id='fasilitas'>
            <thead>
                <tr>
                    <th>Nomor Kamar</th>
                    <th>Fasilitas</th>
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
    <link rel="stylesheet" href="{{asset('aset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('aset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('aset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section("jscript")
    <script src="{{asset('aset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('aset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('aset/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('aset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('aset/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('aset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(()=>{

        });
    </script>
@endsection

