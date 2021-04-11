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
<div class="row justify-content-center">
    <div class="col-md-6 col-12">
        <form class="card" action="{{route('m_aset.update',['m_aset'=>$asets->id])}}" method="POST">
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
                <input type='hidden' name='_method' value='put'>
                <div class="form-group">
                    <label for="">Aset</label>
                    <input type="text" class='form-control' name='aset' value="{{$asets->aset}}">
                </div> 

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
                <button class="btn btn-success">
                    Simpan
                </button>
        </div>
        <!-- card-footer -->
        </form>

    </div>
</div>

@endsection
