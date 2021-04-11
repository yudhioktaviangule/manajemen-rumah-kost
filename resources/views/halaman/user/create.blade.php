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
<div class="row justify-content-center">
    <div class="col-md-6 col-12">
        <form class="card" action="{{route('user.store')}}" method="POST">
            @csrf
        <div class="card-header with-border">
            <h3 class="card-title">Data User</h3>
            <div class="card-tools pull-right">
            <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">
                Kembali
            </a>
            </div>
        </div>
        <div class="card-body">
                
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
                <div class='form-group'>
                    <label for='level'>Hak Akses</label>
                    <select class='form-control' name='level' id='level'>
                        <option value=''>Pilih Hak Akses</option>
                        <option value='admin'>ADMIN</option>
                        <option value='karyawan'>KARYAWAN</option>
                    </select>
                </div>
            
        </div>
        <div class="card-footer">
                <button class="btn btn-success">
                    Simpan
                </button>
        </div>
        </form>

    </div>
</div>


@endsection
