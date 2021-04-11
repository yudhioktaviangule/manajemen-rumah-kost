@extends('template.index')

@section('judul','Tambah Aset')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
      <form class="card" action="{{route('m_aset.store')}}" method="POST">
          @csrf
        <div class="card-header with-border">
          <h3 class="card-title">Aset Kost</h3>
          <div class="card-tools pull-right">
            <a href="{{ route('m_aset.index') }}" class="btn btn-primary btn-sm">
                Kembali
            </a>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">

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
        <!-- /.card-body -->
    
        <!-- card-footer -->
      </form>

  </div>
</div>

@endsection