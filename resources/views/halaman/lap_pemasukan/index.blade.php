@extends('template.index')

@section('judul','Laporan Pemasukan')
@section('content')
<div class="row justify-content-center">
    <div class="col col-lg-4">
        <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Laporan Pemasukan</h3>
        </div>
        <div class="card-body">
                <form id='frm-cetak' target="_blank" action="{{route('laporan_pemasukan.store')}}" method="post">
                    <div id="auth"></div>
                    <div class='form-group'>
                        <label for='transaksi'>Jenis Transaksi</label>
                        <select required class='form-control' name='transaksi' id='transaksi'>
                            <option value=''>Pilih Jenis Transaksi</option>
                            <option value='tunai'>TUNAI</option>
                            <option value='verifikasi'>TRANSFER</option>
                        </select>
                    </div>
                    <div class='form-group'>
                        <label for='tanggal_awal'>Tanggal Awal</label>
                        <input onchange="cektanggal()" type='date' class='form-control' id='tanggal_awal' name='tanggal_awal'>
                    </div>
                    <div class='form-group'>
                        <label for='tanggal_akhir'>Tanggal Akhir</label>
                        <input onchange="cektanggal()" type='date' class='form-control' id='tanggal_akhir' name='tanggal_akhir'>
                    </div>
                    
                </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
                <a href='#' onclick='cetak()' class="btn btn-primary btn-sm">
                    <i class="fa fa-print"></i> Cetak
                </a>
        </div>
        <!-- card-footer -->
        </div>  
    </div>
</div>
@endsection
@section('jscript')
    
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

