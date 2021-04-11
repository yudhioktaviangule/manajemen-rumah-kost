@extends('template.index')

@section('judul','Laporan Pemasukan')
@section('content')
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Laporan Pemasukan</h3>
  </div>
  <div class="card-body">
        <form id='frm-cetak' target="_blank" action="{{route('laporan_pemasukan.store')}}" method="post">
            <div id="auth"></div>
            <div class='form-group'>
                <label for='tanggal_awal'>Tanggal Awal</label>
                <input onchange="cektanggal()" type='date' class='form-control' id='tanggal_awal' name='tanggal_awal'>
            </div>
            <div class='form-group'>
                <label for='tanggal_akhir'>Tanggal Akhir</label>
                <input onchange="cektanggal()" type='date' class='form-control' id='tanggal_akhir' name='tanggal_akhir'>
            </div>
            <div class="form-group">
                <a href='#' onclick='cetak()' class="btn btn-primary btn-sm">
                    <i class="fa fa-print"></i> Cetak
                </a>
            </div>
        </form>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    The footer of the card
  </div>
  <!-- card-footer -->
</div>  
@endsection
@section('jscript')
    <script src="{{asset('aset/bower_components/moment/moment.js')}}"></script>
    <script>
        $(document).ready(()=>{
            window.isValid = false;
            window.cektanggal=()=>{
                let t_awal = $("#tanggal_awal").val();
                let t_akhir = $("#tanggal_akhir").val();
                t_awal = moment(t_awal);
                t_akhir = moment(t_akhir);
                if(t_akhir.isSameOrAfter(t_awal)){
                    isValid=true;
                }
            }
            window.cetak = ()=>{
                if(!isValid){
                    alert("Tanggal Awal harus Lebih Kecil dari Tanggal Akhir")
                    return false;
                }
                $("#frm-cetak").submit();
            }
        })
    </script>
@endsection

