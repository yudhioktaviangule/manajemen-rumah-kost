@extends('template.index')

@section('judul','Pembayaran')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">List Pembayaran</h3>
    <div class="box-tools">
        <a href="{{route('pembayaran.index')}}" class="btn btn-sm btn-primary">Kembali</a>
    </div>
    
  </div>
  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered" id='dt'>
            <thead>
                <tr>
                    <th>Penyewa</th>
                    <th>Kamar</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    
                </tr>
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
                const cols = {columns:[
                    {data:"penyewa",name:"penyewa"},
                    {data:"nomor",name:"nomor"}, 
                    {data:"tanggal",name:"tanggal"},
                    {data:"jbayar",name:"jbayar"},
                     
                ]}
                $("#dt").DataTable({
                    ...cols,
                    "processing": true,
                    serverSide:true,
                    ajax:{
                        url:"{{route('api.datatable.listbayar')}}",
                    }
                });
                
            });  
    </script>

@endsection