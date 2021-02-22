@extends('template.index')

@section('judul','Tambah User')
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
    <form class="box" action="{{route('user.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Data User</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
      </div>
      <div class="box-body">
            
            <div class="form-group">
                <label for="">Nama User</label>
                <input type="text" class='form-control' name='name'>
            </div> 
            <div class="form-group">
                <label for="">E-Mail User</label>
                <input type="email" class='form-control' name='email'>
            </div> 
            <div class="form-group">
                <label for="">Password User</label>
                <input type="password" class='form-control' name='password'>
            </div> 
            <div class="form-group">
                <label for="">Hak Akses</label>
                <select name="level" id="" class="form-control">
                    <option value="admin">ADMIN</option>
                    <option value="user">USER</option>
                </select>
            </div> 
          
      </div>
      <div class="box-footer">
            <button class="btn btn-success">
                Simpan
            </button>
      </div>
    </form>

</div>

@endsection
