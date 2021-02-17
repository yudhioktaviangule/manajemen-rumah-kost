@extends('template.index')

@section('judul','Input Data Item Perawatan')
@section('content')
<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('perawatan.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Item Perawatan</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('perawatan.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
            
            <div class="form-group">
                <label for="">Total Biaya</label>
                <input type="number" min="1000" class="form-control" name="total_biaya" placeholder="" value="1000">
            </div>
            <div class="form-group" id='kmr'>
                <label for="">Nomor Kamar</label>
                <select onchange="kamar_selected($(this))" name="kamar_id" id="kamar" class="form-control">
                </select>
            </div>
            <div class="form-group" id='kmr_stt'>
                <label for="">Nomor Kamar</label>
                <p id='kamarku'></p>
            </div>
            <div class="form-group" id='fas'>
                <label for="">Fasilitas</label>
                <select onchange="kamar_selected($(this))" name="fasilitas_id" id="fasilitas" class="form-control">
                </select>
            </div>
            <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="5" rows="5" class="form-control"></textarea>
            </div>
            <input type="hidden" name='user_id' value="{{ Auth::id() }}"> 
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
       $("#fas").hide();
        $("#kamar").select2({
            ajax:{
                url:"{{$route_api}}",
                dataType:'json',
                type:'GET'
            }
        })
        window.kamar_selected = (obj) => {
            $("#kamarku").html($("#kamar option:selected").text())
            const val = obj.val();
            if(val!=''||val!=null){
                let url   = `{{route('api.select2.fas',['id_kamar' => '_IDKAMAR_'])}}`
                url       = url.replace(/_IDKAMAR_/g,val);
                $("#kmr").hide();
                $("#fas").show();
                $("#fasilitas").select2({
                    ajax:{
                        url:url,
                        dataType:'json',
                        type:'GET'
                    }
                })}
            
        }
   });
</script>
@endsection