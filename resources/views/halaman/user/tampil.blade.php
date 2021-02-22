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
                    <th>&nbsp;</th>
                </tr>
               
            </thead>
            <tbody>
            @foreach($userdata as $kunci => $value)
              <tr>
                <td>{{ $value->name}}</td>
                <td>{{ $value->email}}</td>
                <td>{{ $value->level}}</td>
                <td>
                    <a href='{{ route("user.show",["user"=>$value->id]) }}'  class="btn btn-success">Lihat</a>
                    <a href='{{ route("user.edit",["user"=>$value->id]) }}'  class="btn btn-info">Edit</a>
                    <a href='#' onclick='hapus({{ $value->id }})' class="btn btn-danger">Hapus</a>
                  </td>
                <td></td>
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