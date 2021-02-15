@extends('template.index')

@section('judul','Tambah Fasilitas')
@section('content')
<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('fasilitas.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Data Fasilitas</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('fasilitas.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
            <input type="hidden" name='kamar_id' value="{{$cek->id}}">
            <div class="form-group">
                <label for="">Fasilitas</label>
                <select name="aset_id" id='fasilitas' class="form-control">

                </select>
            </div> 
            <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="keterangan" id="" cols="30" rows="10" class="form-control"></textarea>
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
        $("#fasilitas").select2({
            ajax:{
                url:"{{route('api.select2.aset',['id_kamar'=>$cek->id])}}",
                dataType:'json',
                type:'GET'
            }
        })
   });
</script>


@endsection
