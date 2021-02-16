@extends('template.index')

@section('judul','Input Data Aset')
@section('content')
<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('t_aset.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Data Aset</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('t_aset.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
            <div class="form-group">
                <label for="">Nama Aset</label>
                <select name="aset_id" id="kamar" class="form-control">
                </select>
            </div>
            <div class="form-group">
                <label for="">Total Biaya</label>
                <input type="number" min="1000" class="form-control" name="total_biaya" placeholder="" value="1000">
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
        $("#kamar").select2({
            ajax:{
                url:"{{$route_api}}",
                dataType:'json',
                type:'GET'
            }
        })
   });
</script>
@endsection