@extends('template.index')

@section('judul','Tambah Aset')
@section('content')

<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('m_aset.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Aset Kost</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('m_aset.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">

            <div class="form-group">
                <label for="">Aset</label>
                <input type="text" class="form-control" name="aset">
            </div>
            <div class="form-group">
                <button class="btn btn-success">
                    Tambah
                </button>
            </div> 
            
      </div>
      <!-- /.box-body -->
   
      <!-- box-footer -->
    </form>

</div>

@endsection