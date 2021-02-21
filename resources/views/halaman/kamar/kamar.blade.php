@extends('template.index')

@section('judul','Kamar')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Kamar</h3>
    <div class="box-tools pull-right">
      <a href="{{ route('kamar.create') }}" class="btn btn-primary btn-sm">
          Tambah Kamar
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
                    <th>Nomor </th>
                    <th>Status</th>
                    <th>Harga</th>
                    <th><i class="fa fa-cog"></i></th>
                </tr>
               
            </thead>
            <tbody>
            @foreach($kamars as $kunci => $value)
              <tr>
                <td>{{ $value->nomor}}</td>
                <td>{{ $value->status}}</td>
                <td>{{ $value->harga}}</td>
                <td>
                    <a title='Lihat data kamar' href="{{ route('kamar.show',['kamar'=>$value->id]) }}" class="btn btn-xs btn-success">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a title='Edit data kamar' href="{{ route('kamar.edit',['kamar'=>$value->id]) }}" class="btn btn-xs btn-info">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if($value->status=='ready')
                    <a title='Hapus data kamar' href="#" onclick='hapus({{$value->id}})' class="btn btn-xs btn-danger">
                        <i class="fa fa-minus"></i>
                    </a>
                    @endif
                </td>
              </tr> 
            @endforeach
            </tbody>
        </table>
    </div>
  </div>
  
  <div class="box-footer">
    <form action="{{ route('kamar.index') }}" id='hapus-kamar' method="POST">
        @csrf
        <input type="hidden" name='_method' value='delete'>
    </form>
  </div>
  
</div>
@endsection
@section("css")
    <link rel="stylesheet" href="{{asset('aset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('jscript')
    <script src="{{asset('aset/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('aset/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    
    <script>
        $(document).ready(()=>{
            window.hapus=(id)=>{
                let kam = $("#hapus-kamar");
                kam.attr('action',`{{ route('kamar.index') }}/${id}`)
                const pesan = confirm("Hapus data kamar?")
                if(pesan){
                    kam.submit();
                }
            }
            $(".table").DataTable();
        });
    </script>
@endsection
