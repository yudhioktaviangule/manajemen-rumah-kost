
@php
    $carbon     = \Carbon\Carbon::class;
    $sekarang   = $carbon::now();
    $jathTempo  = $carbon::parse($data->jatuh_tempo);
    $diff       = $jathTempo->diffInMonths($sekarang)+1;
    $penyewa    = Auth::user();
    $totbayar   = $data->getTotalBayar();
    $sum   = $data->total_sewa;
    $sisa  = $data->sisaPembayaran(); 
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
          <a href="{{ route('clntpembayaran.bayar',['penyewa_id'=>Auth::id()]) }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        
      </div>
      
      <div class="box-body">
            <div class="form-group">
                <label for="">Nama</label>
                <p>{{Auth::user()->name}}</p>
            </div>
            <div class="form-group">
                <label for="">No. Kamar</label>
                <p>{{$data->getKamar()->nomor}}</p>
            </div>
            <div class="form-group">
                <label for="">Total Tagihan</label>
                <p>Rp. {{ number_format($sum) }}</p>
            </div>
            <div class="form-group">
                <label for="">Saldo Tagihan</label>
                <p>Rp. {{ number_format($sisa->saldo) }}</p>
            </div>
            <div class='form-group'>
                <label for=jumlah_bayar>Jumlah Pembayaran</label>
                <input step='50000' type='number' max="{{ $sisa->saldo }}" min='{{$sisa->saldo>100000 ? 100000 : $sisa->saldo }}' value="{{ $sisa->saldo }}" class='form-control form-control-sm' name='jumlah_bayar' id='jumlah_bayar'>
            </div>
            <div class='form-group'>
                <label for='metode_pembayaran'>Metode Pembayaran</label>
                <select class='form-control' name='metode_pembayaran' id='metode_pembayaran'>
                    <option value=''>Pilih Metode Pembayaran</option>
                    <option value='transfer'>Transfer</option>
                </select>
            </div>
            <input type="hidden" name='kamar_sewa_id' value="{{ $data->id }}">
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