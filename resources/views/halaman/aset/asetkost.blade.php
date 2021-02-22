@extends('template.index')

@section('judul','Aset Kost')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Aset</h3>
    <div class="box-tools">
        <a href="{{route('m_aset.create')}}" class="btn btn-sm btn-primary">Tambah Aset Kost</a>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Aset </th>
                    <th>&nbsp;</th>
                </tr>
               
            </thead>
            <tbody>
            @foreach($asets as $kunci => $value)
              <tr>
                <td>{{ $value->aset}}</td>
                <td>
                    <a title='Lihat data aset' href="{{ route('m_aset.show',['m_aset'=>$value->id]) }}" class="btn btn-xs btn-success">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a title='Edit data aset' href="{{ route('m_aset.edit',['m_aset'=>$value->id]) }}" class="btn btn-xs btn-info">
                        <i class="fa fa-edit"></i>
                    </a>
                    <button type="button" onclick="hapus({{$value->id}})" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></button>
                    
                </td>
                <td></td>
                <td></td>
              </tr> 
            @endforeach
            

            </tbody>
        </table>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
  <form action="{{ route('m_aset.index') }}" id='hapus-aset' method="POST">
        @csrf
        <input type="hidden" name='_method' value='delete'>
    </form>
  </div>
  <!-- box-footer -->
</div>
<!-- /.box -->
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
                let kam = $("#hapus-aset");
                kam.attr('action',`{{ route('m_aset.index') }}/${id}`)
                const pesan = confirm("Hapus data Aset?")
                if(pesan){
                    kam.submit();
                }
            }
            $(".table").DataTable();
        });
    </script>
@endsection
