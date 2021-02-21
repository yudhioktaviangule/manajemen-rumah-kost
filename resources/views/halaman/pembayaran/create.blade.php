
@php
    $carbon     = \Carbon\Carbon::class;
    $sekarang   = $carbon::now();
    $jathTempo  = $carbon::parse($data->jatuh_tempo);
    $diff       = $jathTempo->diffInMonths($sekarang)+1;
    $totbayar   = $data->getKamar()->harga * $diff;
    
@endphp

@extends('template.index')
@section('judul','Pembayaran')
@section('content')
<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('pembayaran.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Data Pembayaran</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('pembayaran.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        
      </div>
      
      <div class="box-body">
            <div class="form-group">
                <label for="">Nama</label>
                <p>{{$data->getPenyewa()->name}}</p>
            </div>
            <div class="form-group">
                <label for="">No. Kamar</label>
                <p>{{$data->getKamar()->nomor}}</p>
            </div>
            <div class="form-group">
                <label for="">Jumlah Tagihan</label>
                <p>Rp. {{ number_format($totbayar) }}</p>
            </div>
            <div class='form-group'>
                <label for=jumlah_bayar>Jumlah Bayar</label>
                <input type='number' min='{{$totbayar}}' value="{{ $totbayar }}" class='form-control form-control-sm' name='jumlah_bayar' id='jumlah_bayar'>
            </div>

            <input type="hidden" name='kamar_sewa_id' value="{{ $data->id }}">
            <input type="hidden" name='total_pembayaran' value="{{ $totbayar }}">
            
            
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button class="btn btn-primary">
            Simpan
        </button>
      </div>
      <!-- box-footer -->
    </form>

</div>

@endsection