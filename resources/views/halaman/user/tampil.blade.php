@extends('template.index')

@section('judul','User')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar User</h3>
    <div class="box-tools pull-right">
      <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
          Register User
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
                    <th>Email</th>
                    <th>Hak Akses</th>
                    <th class='text-right'>
                        <i class="fa fa-cog"></i>
                    </th>
                </tr>
               
            </thead>
            <tbody>
            @foreach($userdata as $kunci => $value)
              <tr>
                <td>{{ $value->name}}</td>
                <td>{{ $value->email}}</td>
                <td>{{ strtoupper($value->level)}}</td>
                <td class='text-right'>
                    <a href='{{ route("user.show",["user"=>$value->id]) }}'  class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Lihat</a>
                    @if($value->level==='penyewa')
                      <a href='#'  class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit</a>
                    @else
                      <a href='{{ route("user.edit",["user"=>$value->id]) }}'  class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                    @endif
                    @if($value->level==='admin')
                      <a href='#' class="btn btn-sm btn-default"><i class="fa fa-times"></i> Hapus</a>
                    @else
                      <a href='#' onclick='hapus({{ $value->id }})' class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Hapus</a>
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
@section("jscript")
  <script>
    $(document).ready(()=>{
      window.hapus = (id)=>{
          const f = $("#form-hapus");
          const url = `{{ route('user.index') }}/${id}`;
          const con = confirm("Ingin Menghapus Data?")
          if(con){
            f.attr('action',url);
            f.submit();
          }
      }
    })
  </script>

@endsection