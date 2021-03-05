@extends('template.index')

@section('judul','Tambah Kamar')
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
    <form class="box" action="{{route('kamar.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Data Kamar</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('kamar.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
            
            <div class="form-group">
                <label for="">Nomor Kamar</label>
                <p>
                    <strong>
                        {{ $data->nomor }}
                    </strong>
                </p>
            </div> 
            <div class="form-group">
                <label for="">Harga Sewa</label>
                <p>
                    <strong>{{ number_format($data->harga) }}</strong>
                </p>
            </div> 

      </div>
      <!-- /.box-body -->
      <div class="box-footer">

      </div>
      <!-- box-footer -->
    </form>

</div>

@endsection