@extends('template.index')

@section('judul','Aset Kost')
@section('content')
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Daftar Aset</h3>
    <div class="card-tools">
        <a href="{{route('m_aset.create')}}" class="btn btn-sm btn-primary">Tambah Aset Kost</a>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Aset </th>
                    <th class='text-right'>
                        <i class="fa fa-cog"></i>
                    </th>
                </tr>
               
            </thead>
            <tbody>
            @foreach($asets as $kunci => $value)
              <tr>
                <td>{{ $value->aset}}</td>
                <td class='text-right'>
                    
                    <a title='Edit data aset' href="{{ route('m_aset.edit',['m_aset'=>$value->id]) }}" class="btn btn-xs btn-info">
                        <i class="fa fa-edit"></i> Ubah
                    </a>
                    <button type="button" onclick="hapus(`{{$value->id}}`)" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i> Hapus</button>
                    
                </td>
              </tr> 
            @endforeach
            

            </tbody>
        </table>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
  <form action="{{ route('m_aset.index') }}" id='hapus-aset' method="POST">
        @csrf
        <input type="hidden" name='_method' value='delete'>
    </form>
  </div>
  <!-- card-footer -->
</div>
<!-- /.card -->
@endsection
@section("css")
    <link rel="stylesheet" href="{{asset('lte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    
@endsection

@section('jscript')
    <script src="{{asset('lte3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('lte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('lte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lte3/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('lte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>  
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
