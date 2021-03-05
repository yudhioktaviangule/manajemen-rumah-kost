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
                    <th class='text-right'><i class="fa fa-cog"></i></th>
                </tr>
               
            </thead>
            <tbody>
            @foreach($kamars as $kunci => $value)
              <tr>
                <td>{{ $value->nomor}}</td>
                <td>{{ strtoupper($value->status)}}</td>
                <td>{{ number_format($value->harga)}}</td>
                <td class='text-right'> 
                    <a title='Aset Kamar' href="{{ route('fasilitas.kamar.terpilih',['kamar_id'=>$value->id]) }}" class="btn btn-xs bg-purple">
                        <i class="fa fa-plus"></i> Aset Kamar
                    </a>

                    <a title='Lihat data kamar' href="{{ route('kamar.show',['kamar'=>$value->id]) }}" class="btn btn-xs btn-success">
                        <i class="fa fa-eye"></i> Lihat
                    </a>
                    <a title='Edit data kamar' href="{{ route('kamar.edit',['kamar'=>$value->id]) }}" class="btn btn-xs btn-info">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    @if($value->status=='ready')
                        <a title='Hapus data kamar' href="#" onclick='hapus({{$value->id}})' class="btn btn-xs btn-danger">
                            <i class="fa fa-minus"></i> Hapus
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
