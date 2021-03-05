@extends('template.index')

@section('judul','Reservasi Kamar')
@section('content')
<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('reservasi.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Reservasi</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('penyewa.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="hidden" name="penyewa_id" value="{{ $data->id }}">
                <p>
                    {{ $data->name }}
                </p>
            </div>
            <div class="form-group">
                <label for="">Nomor Kamar</label>
                <select name="kamar_id" id="kamar" class="form-control">

                </select>
            </div>
            <div class="form-group">
                <label for="">Harga</label>
                <p id='harga-sat'>
                  Rp. 0
                </p>
            </div>
            <div class="form-group">
                <label for="">Lama</label>
                <input onkeyup="hitung($(this))" type="number" class="form-control" name="lama_sewa" id='lama' min=0 value="0">
            </div>
            <div class="form-group">
                <label for="">Total Pembayaran</label>
                <input type="hidden" name="total_sewa" id='total_sewa'>
                <p id='total-sat'>
                  Rp. 0
                </p>
            </div>
            <div class="form-group">
                <label for="">Tanggal Jatuh Tempo</label>
                <input type="date" name='jatuh_tempo' class='form-control'>
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

        let _harga = 0;
        window.formatAngka = (val)=>{
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }
        $("#kamar").select2({
            ajax:{
                url:"{{route('api.select2.kamar',['id_kamar'=>''])}}",
                dataType:'json',
                type:'GET'
            }
        })

        $("#kamar").on("select2:select",(e)=>{
            const  { data:{data:harga} } =e.params;
            _harga = harga;
            $("#harga-sat").html("Rp. "+formatAngka(harga));
            hitung($("#lama"));
        });
        window.hitung=(obj)=>{
            let hasil = _harga*parseInt(obj.val());
            $("#total-sat").html("Rp. "+formatAngka(hasil));
            $("#total_sewa").val(hasil);
        }
   });
</script>
@endsection