@extends('template.index')

@section('judul','Penyewa')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Penyewa</h3>
    <div class="box-tools pull-right">
      <a href="{{ route('penyewa.create') }}" class="btn btn-primary btn-sm">
          Register Penyewa
      </a>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama </th>
                    <th>No.Hp</th>
                    <th>Jenis Kelamin</th>
                    <th>Kota Asal</th>
                    <th>Pekerjaan</th>
                    <th class='text-right'>
                      <i class="fa fa-cog"></i>
                    </th>
                </tr>
               
            </thead>
            <tbody>
            @foreach($penyewas as $kunci => $value)
              <tr>
                <td>{{ $value->name}}</td>
                <td>{{ $value->getPenyewa()->hp}}</td>
                <td>{{ $value->getPenyewa()->jenis_kelamin}}</td>
                <td>{{ $value->getPenyewa()->kota_asal}}</td>
                <td>{{ $value->getPenyewa()->pekerjaan}}</td>
                <td class='text-right'>
                    @if($value->aktif==='nonaktif')
                        <a href="{{ route('user.aktivasi',['user'=>$value->id]) }}" class="btn btn-xs btn-success">
                            <i class="fa fa-check"></i>Aktivasi
                        </a>
                    @elseif($value->getKamar()==NULL)
                        <a href="{{route('reservasi.create')}}?id={{$value->penyewa_id}}" class="btn btn-primary btn-xs">
                            <i class="fa fa-book"></i> Reservasi Kamar
                        </a>
                    @else
                        <a href="#" class="btn btn-primary btn-xs">
                            <i class="fa fa-book"></i> Pindah Kamar
                        </a>
                        <a href="#" class="btn btn-danger btn-xs">
                            <i class="fa fa-minus"></i> Hapus
                        </a>
                    @endif
                </td>
                
              </tr> 
            @endforeach

            </tbody>
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