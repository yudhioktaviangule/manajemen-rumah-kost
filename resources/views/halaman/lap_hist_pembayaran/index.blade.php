@extends('template.index')

@section('judul','Rekap Pembayaran Kamar Pertahun')
@section('content')
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Laporan Pemasukan</h3>
  </div>
  <div class="card-body">
        <form id='frm-cetak' target="_blank" action="{{route('laporan_pemasukan.store')}}" method="post">
            <div class='form-group'>
                <label for='periode'>Periode</label>
                <select required class='form-control' name='periode' id='periode'>
                    <option value=''>Pilih Periode</option>
                </select>
            </div>
            <div class="form-group" id='cetak-group'>
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
    
    <script>
        moment.locale("id");
        $(document).ready(()=>{
            let period = $("#periode")
            const renderToTable = (data)=>{}
            window.cetak=()=>{
                
            }
        })
    </script>
@endsection

