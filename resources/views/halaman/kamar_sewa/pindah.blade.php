@extends('template.index')

@section('judul','Pindah Kamar')
@section('content')
<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('pindah_kamar.update',['pindah_kamar'=>$cek->id])}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">{{$penyewa->name}}</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('kamar_sewa.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        
      </div>
      
      <div class="box-body">
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
      <!-- /.box-body -->
      <div class="box-footer">
        The footer of the box
      </div>
      <!-- box-footer -->
    </form>

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