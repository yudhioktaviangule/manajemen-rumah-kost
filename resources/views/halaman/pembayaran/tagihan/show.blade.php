@php
    $carbon   = \Carbon\Carbon::class;
    $sekarang = $carbon::now();
    $jatuh    = $carbon::parse($data->jatuh_tempo);
    $isNear   = $jatuh->gt($sekarang) && $jatuh->diffInDays($sekarang) < 10 ? true : false;
    $jm       = $jatuh->diffInMonths($jatuh)+1;
    $jb       = $jm*$data->getKamar()->harga;
    $lambat   = $sekarang->gt($jatuh);
@endphp
@extends('template.index')

@section('judul','Pembayaran')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Data Tagihan</h3>
    
    
  </div>
  <div class="box-body">
        <p>
            <strong>Penyewa</strong><br>
            {{ $data->getPenyewa()->name }}
        </p>
        <p>
            <strong>Nomor Kamar</strong><br>
            {{ $data->getKamar()->nomor }}
        </p>
        <p>
            <strong>Biaya Sewa Per Bulan</strong><br>
            {{ $jb }}
        </p>
        <p>
            <strong>Tanggal Jatuh Tempo</strong><br>
            {{ $jatuh->format('d-m-Y') }}
        </p>        
  </div>
  <div class="box-footer">
    @if($isNear||$lambat)
    <a href="{{route('pembayaran.create')}}?sk_id={{ $data->id }}" class="btn btn-info btn-sm">
        <i class="fa fa-edit"></i> Buat Pembayaran
    </a>
    @endif
    <a href="{{ route('pembayaran.index') }}" class="btn btn-warning btn-sm">
        Kembali
    </a>
  </div>
</div>
@endsection
@section("css")
    <link rel="stylesheet" href="{{asset('aset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section("jscript")
    <script src="{{asset('aset/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('aset/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
            $(document).ready(()=>{
                const cols = {columns:[
                    {data:"penyewa",name:"penyewa"},
                    {data:"kamar",name:"kamar"}, 
                    {data:"tagihan",name:"tagihan"},
                    {
                        data:"aksi",
                        render: ( data, type, row, meta )=>{
                            const {keterangan,id} = row
                            return `<a href="{{ route('tagihan.index') }}/${id}" class="btn btn-sm btn-block btn-info">
                                    <i class="fa fa-eye"></i> Cek Jumlah Tagihan
                                </a>`;
                        }
                    },  
                ]}
                $("#dt").DataTable({
                    ...cols,
                    "processing": true,
                    serverSide:true,
                    ajax:{
                        url:"{{route('api.datatable.penyewa.kamar')}}",
                    }
                });
                
            });  
    </script>

@endsection