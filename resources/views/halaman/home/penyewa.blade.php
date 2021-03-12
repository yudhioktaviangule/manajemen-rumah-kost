@php 
    $data = Auth::user()->getPenyewa();
@endphp
@extends('template.index')
@section('judul','Virtual Account Penghuni')
@section('content')
<div class="col-md-12 col-xs-12 ">
    <div class="box">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-user"></i> {{Auth::user()->name}}</h3>   
      </div>
      
      <div class="box-body">
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
                <label for="">Jumlah Pembayaran</label>
                
            </div>
            
            
            
      </div>
      <div class="box-footer">
            <a href="{{ route('clntpembayaran.bayar',['penyewa_id'=>$data->id]) }}" class="btn btn-success"><i class="fa fa-get-pocket"></i> Pembayaran</a>
      </div>
    </div >

</div>

@endsection