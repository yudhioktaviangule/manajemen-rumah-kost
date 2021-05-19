@php 
    $data = Auth::user()->getPenyewa();
    $ks = $data->getSewa();
    $tagihan = $ks->total_sewa;
    $jumlah_byr = \App\Models\Pembayaran::where('kamar_sewa_id',$ks->id)->sum('pembayaran');
    $saldo = $tagihan-$jumlah_byr;
@endphp
@extends('template.index')
@section('judul','Virtual Account Penghuni')
@section('content')
<div class="col-md-6 col-xs-12 col-md-offset-3">
    <div class="card">
        @csrf
      <div class="card-header with-border">
        <h3 class="card-title"><i class="fa fa-user"></i> {{Auth::user()->name}}</h3>   
      </div>
      
      <div class="card-body">
            <div class="form-group">
                <label for="">NIK</label>
                <p>{{$data->nik}}</p>
            </div>
            <div class="form-group">
                <label for="">No. Kamar</label>
                <p>{{$data->getKamar()->nomor}}</p>
            </div>
            <div class="form-group">
                <label for="">Tanggal Check-in</label>
                <p><i class="fa fa-calendar-check-o"></i> {{\Carbon\Carbon::parse($data->getSewa()->created_at)->format('d-m-Y')}} </p>
            </div>
            <div class="form-group">
                <label for="">Lama Sewa</label>
                <p>{{$data->getSewa()->lama_sewa}} Bulan</p>
            </div>
            <div class="form-group">
                <label for="">Tanggal Check-out</label>
                <p><i class="fa fa-calendar-check-o"></i> {{\Carbon\Carbon::parse($data->getSewa()->created_at)->addMonths($data->getSewa()->lama_sewa)->format('d-m-Y')}} </p>
            </div>
            <div class="form-group">
                <label for="">Jumlah Tagihan</label>
                <p>Rp. {{ number_format($data->getSewa()->total_sewa) }} </p>
            </div>
            
            <div class="form-group">
                <label for="">Saldo Tagihan</label>
                <p>Rp. {{ number_format($saldo) }}</p>
            </div>
            
            
            
      </div>
      <div class="card-footer">
            <a href="{{ route('clntpembayaran.bayar',['penyewa_id'=>$data->id]) }}" class="btn btn-block btn-success"><i class="fa fa-get-pocket"></i> Pembayaran</a>
      </div>
    </div >

</div>

@endsection