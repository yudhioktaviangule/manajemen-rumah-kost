@extends('template.index')

@section('judul','Lihat Data User')
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
            
            <div class="form-group">
                <label for="">Nama</label>
                <p>
                    <strong>
                        {{ $data->name }}
                    </strong>
                </p>
            </div> 
            <div class="form-group">
                <label for="">E-Mail</label>
                <p>
                    <strong>
                        {{ $data->email }}
                    </strong>
                </p>
            </div> 
            <div class="form-group">
                <label for="">Level</label>
                <p>
                    <strong>
                        {{ $data->level }}
                    </strong>
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
