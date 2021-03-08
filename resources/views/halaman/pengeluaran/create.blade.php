@extends('template.index')

@section('judul','Pengeluaran')
@section('content')

<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('pengeluaran.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Pengeluaran</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('pengeluaran.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">

            <div class="form-group">
                <label for="">Jenis Pengeluaran</label>
                <input type="text" class="form-control" name="pengeluaran" required>
            </div>
            <div class='form-group'>
                <label for='nominal'>Nominal</label>
                <input type='number' min="1000" value='1000' step='1000' class='form-control' id='nominal' name='nominal'>
            </div>
            <div class='form-group'>
                <label for='status'>Ket. Lunas</label>
                <select class='form-control' name='status' required id='status'>
                    <option value=''>Pilih Keterangan Lunas</option>
                    <option value='lunas'>Lunas</option>
                    <option value='belum'>Belum</option>
                    
                </select>
            </div>
            <div class='form-group'>
                <label for='status'>Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="5" rows="5" class="form-control">-</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success">
                    <i class="fa fa-send"></i> Simpan
                </button>
            </div> 
            
      </div>
      <!-- /.box-body -->
   
      <!-- box-footer -->
    </form>

</div>

@endsection