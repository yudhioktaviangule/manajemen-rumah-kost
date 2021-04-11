@extends('template.index')

@section('judul','Data Kamar')
@section('content')
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Kelola data kamar</h3>
    <div class="card-tools pull-right">
      <a href="{{ route('kamar.create') }}" class="btn btn-primary btn-sm">
          Tambah Kamar
      </a>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
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
                    @else
                        <a title='Hapus data kamar' href="#" class="btn btn-xs btn-default">
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
  
  <div class="card-footer">
    <form action="{{ route('kamar.index') }}" id='hapus-kamar' method="POST">
        @csrf
        <input type="hidden" name='_method' value='delete'>
    </form>
  </div>
  
</div>
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
