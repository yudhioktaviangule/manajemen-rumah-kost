@extends('template.index')

@section('judul','Pindah Kamar')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-12">
        <form class="card" action="{{route('pindah_kamar.update',['pindah_kamar'=>$cek->id])}}" method="POST">
            @csrf
        <div class="card-header with-border">
            <h3 class="card-title">{{$penyewa->name}}</h3>
            <div class="card-tools pull-right">
            <a href="{{ route('penyewa.show',['penyewa'=>$cek->penyewa_id]) }}" class="btn btn-primary btn-sm">
                Kembali
            </a>
            </div>
            
        </div>
        
        <div class="card-body">
                <input type="hidden" name='_method' value='put'>
                <div class="form-group">
                    <label for="">Nomor Kamar</label>
                    <select name="kamar_id" id="kamar" class="form-control">

                    </select>
                </div>
            
                
                <div class="form-group">
                    <button class="btn btn-success">
                        Simpan
                    </button>
                </div> 
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            The footer of the card
        </div>
        <!-- card-footer -->
        </form>

    </div>
</div>

@endsection

@section("css")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section("jscript")
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
   $(document).ready(()=>{
        $("#kamar").select2({
            ajax:{
                url:"{{route('api.select2.kamar',['id_kamar'=>''])}}",
                dataType:'json',
                type:'GET'
            }
        })
   });
</script>
@endsection