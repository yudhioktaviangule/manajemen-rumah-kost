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
<div class="row justify-content-center">
    <div class="col-md-6">
        <form class="card" action="{{route('user.store')}}" method="POST">
            @csrf
        <div class="card-header with-border">
            <h3 class="card-title">Data user</h3>
            <div class="card-tools pull-right">
            <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">
                Kembali
            </a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
                
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
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- card-footer -->
        </form>

    </div>
</div>

@endsection
