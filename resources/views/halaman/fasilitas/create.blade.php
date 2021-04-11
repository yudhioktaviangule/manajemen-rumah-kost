@extends('template.index')

@section('judul','Tambah Aset Kamar')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <form class="card" action="{{route('fasilitas.store')}}" method="POST">
            @csrf
        <div class="card-header with-border">
            <h3 class="card-title">Data Aset Kamar</h3>
            <div class="card-tools pull-right">
            <a href="{{ url('create_fasilitas') }}/{{$cek->id}}" class="btn btn-primary btn-sm">
                Kembali
            </a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
                <input type="hidden" name='kamar_id' value="{{$cek->id}}">
                <div class="form-group">
                    <label for="">Aset Kamar</label>
                    <select name="aset_id" id='fasilitas' class="form-control">

                    </select>
                </div> 
                <div class="form-group">
                    <label for="">Kondisi</label>
                    <select name="status" id='kondisi' class="form-control">
                        <option value="layak">Layak</option>
                        <option value="rusak">Rusak</option>
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
