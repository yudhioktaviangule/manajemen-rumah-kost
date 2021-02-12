@extends('template.index')

@section('judul','Input Data Penyewa')
@section('content')
<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('penyewa.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Data Penyewa</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('penyewa.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="name" placeholder="">
            </div>
            <div class="form-group">
                <label for="">No.Hp</label>
                <input type="text" class="form-control" name="hp" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="" class="form-control">
                <option value="laki-laki">Laki-Laki</option>
                <option value="perempuan">Perempuan</option>
                </select>
            </div> 
            <div class="form-group">
                <button class="btn btn-success">
                    Simpan
                </button>
            </div> 
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        The footer of the box
      </div>
      <!-- box-footer -->
    </form>

</div>

@endsection