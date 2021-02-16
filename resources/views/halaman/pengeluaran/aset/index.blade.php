@extends('template.index')

@section('judul','Penambahan Aset')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Item Pengeluaran</h3>
    <div class="box-tools pull-right">
      <a href="{{ route('t_aset.create') }}" class="btn btn-primary btn-sm">
          Tambah Item Pengeluaran
      </a>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered" id='dt'>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Aset</th>
                    <th>Total Biaya</th>
                    <th>Keterangan</th>
                    <th>#</th>
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
                    {data:"tanggal",name:"tanggal"},
                    {data:"aset",name:"aset"}, 
                    {
                        data:"total_biaya",
                        render: ( data, type, row, meta )=>{
                            const {total_biaya} = row
                            return `
                                    <div class="text-right">
                                        ${total_biaya.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")},-
                                    </div>
                                    `;
                        }},  
                    {
                        data:"keterangan",
                        render: ( data, type, row, meta )=>{
                            const {keterangan} = row
                            return `
                                    <div class="text-left">
                                        ${(keterangan.length>30 ? (keterangan.substr(0,30)+'...') : keterangan)} 
                                    </div>
                                    `;
                        }
                    },  
                    {
                        data:"aksi",
                        render: ( data, type, row, meta )=>{
                            const {keterangan,id} = row
                            return `<a href="{{ route('pemeliharaan.index') }}/${id}" class="btn btn-sm btn-block btn-info">
                                    <i class="fa fa-eye"></i> Lihat
                                </a>`;
                        }
                    },  
                ]}
                $("#dt").DataTable({
                    ...cols,
                    "processing": true,
                    serverSide:true,
                    ajax:{
                        url:"{{route('api.datatable.tambah.aset')}}",
                    }
                });
                
            });  
    </script>

@endsection