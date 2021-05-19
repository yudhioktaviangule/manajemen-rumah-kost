@extends('template.index')

@section('judul','Pengeluaran')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <form class="card" action="{{route('pengeluaran.store')}}" method="POST">
            @csrf
        <div class="card-header with-border">
            <h3 class="card-title">Pengeluaran</h3>
            <div class="card-tools pull-right">
            <a href="{{ route('pengeluaran.index') }}" class="btn btn-primary btn-sm">
                Kembali
            </a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">

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
        <!-- /.card-body -->
    
        <!-- card-footer -->
        </form>

    </div>
</div>

@endsection