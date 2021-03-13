@extends('template.index')

@section('judul','Tambah user')
@section('content')
<p>
    @if($errors->any())
        
        <div class="alert alert-danger">
            @foreach($errors->all() as $key => $value)
                
                {{$value}}<br>
            @endforeach        
        </div>
    @endif
</p>
<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('user.update',['user'=>$data->id])}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Data user</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
            <input type='hidden' name='_method' value='put'>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class='form-control' name='name' value="{{$data->name}}">
            </div> 
            
            <div class="form-group">
                <label for="">E-Mail</label>
                <input type="email" class='form-control' name='email' value="{{$data->email}}">
            </div> 
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class='form-control' name='password' value="">
            </div> 
            <div class="form-group">
                <label for="">Level</label>
                <select name="level" id="" class="form-control">
                    <option value=''>Pilih Hak Akses</option>
                    <option value='admin'>ADMIN</option>
                    <option value='karyawan'>KARYAWAN</option>
                </select>
            </div> 
            
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
            <button class="btn btn-success">
                Simpan
            </button>
      </div>
      <!-- box-footer -->
    </form>

</div>

@endsection
