@extends('template.index')

@section('judul','Tambah Aset')
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
    <form class="box" action="{{route('m_aset.update',['m_aset'=>$asets->id])}}" method="POST">
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
            <input type='hidden' name='_method' value='put'>
            <div class="form-group">
                <label for="">Aset</label>
                <input type="text" class='form-control' name='aset' value="{{$asets->aset}}">
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
