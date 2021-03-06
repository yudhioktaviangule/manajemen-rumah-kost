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
<div class="row justify-content-center">
    <div class="col-md-6 col-12">
        <form class="card" action="{{route('kamar.store')}}" method="POST">
            @csrf
        <div class="card-header with-border">
            <h3 class="card-title">Data Kamar</h3>
            <div class="card-tools pull-right">
            <a href="{{ route('kamar.index') }}" class="btn btn-primary btn-sm">
                Kembali
            </a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
                
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
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- card-footer -->
        </form>

    </div>

</div>

@endsection
