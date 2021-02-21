@extends('template.index')

@section('judul','Pembayaran')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">List Penyewa</h3>
    <div class="box-tools">
        <a href="{{route('df.bayar')}}" class="btn btn-sm btn-primary">Lihat daftar Pembayaran</a>
    </div>
    
  </div>
  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered" id='dt'>
            <thead>
                <tr>
                    <th>Penyewa</th>
                    <th>Kamar</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Status</th>
                    <th>
                        <div class="text-center">
                            <span class="btn btn-default"><i class="fa fa-cog"></i></span>
                        </div>
                    </th>
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
                    {data:"kamar",name:"kamar"}, 
                    {data:"tagihan",name:"tagihan"},
                    {data:"status",name:"status"},
                    {
                        data:"aksi",
                        render: ( data, type, row, meta )=>{
                            const {keterangan,id} = row
                            return `<a href="{{ route('tagihan.index') }}/${id}" class="btn btn-sm btn-block btn-info">
                                    <i class="fa fa-eye"></i> Cek Jumlah Tagihan
                                </a>`;
                        }
                    },  
                ]}
                $("#dt").DataTable({
                    ...cols,
                    "processing": true,
                    serverSide:true,
                    ajax:{
                        url:"{{route('api.datatable.penyewa.kamar')}}",
                    }
                });
                
            });  
    </script>

@endsection