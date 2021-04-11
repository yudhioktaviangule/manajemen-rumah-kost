@php
    $penyewa    = $ks->getPenyewa();
    $kamar      = $ks->getKamar();
    $byr      = $ks->getPembayaran();
@endphp
@extends('template.index')
@section('judul','Pembayaran')
@section('content')
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Virtual Account</h3>
    <div class="card-tools pull-right">
        <a href="{{ route('penyewa.show',['penyewa'=>$penyewa->id]) }}" class="btn btn-sm btn-primary">Kembali</a>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="table-responsive">
        
        <table>
            <tr>
                <th style='width:200px'>Nama</th>
                <td>: {{$penyewa->name}}</td>
            </tr>
            <tr>
                <th>Kamar</th>
                <td>: {{$kamar->nomor}}</td>
            </tr>
            <tr>
                <th>Tagihan / Bulan</th>
                <td>: Rp. {{number_format($kamar->harga)}} / Bulan</td>
            </tr>
            <tr>
                <th>Lama Sewa</th>
                <td>: {{number_format($ks->lama_sewa)}} Bulan</td>
            </tr>
            <tr>
                <th>Total Tagihan</th>
                <td>: Rp. {{number_format($ks->total_sewa)}} </td>
            </tr>
        </table>
    </div>
  </div>
</div>
 
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Riwayat Pembayaran</h3>
    <div class="card-tools pull-right">
        <a href="{{ route('penghuni.bayar.create',['kamar_sewa_id'=>$ks->id]) }}" class="btn btn-sm btn-primary" id='pbtr'><i class="fa fa-plus"></i>  Pembayaran</a>
        <a target="_blank" href="{{ route('pembayaran.cetak',['kamar_sewa_id'=>$ks->id]) }}" class="btn btn-sm btn-success"><i class="fa fa-print"></i>  Cetak Histori Pembayaran</a>
    </div>
  </div>
  <div class="card-body">
      <table class="table table-bordered">
          <thead>
              <th>Tanggal</th>
              <th>No. Pembayaran</th>
              <th>Nama Tagihan</th>
              <th>Metode Pambayaran</th>
              <th>Status Verifikasi</th>
              <th class='text-right'>Saldo Awal</th>
              <th class='text-right'>Jumlah Bayar</th>
              <th class='text-right'>Saldo Akhir</th>
          </thead>
          <tbody>
              @php 
                  $vm = $ks->total_sewa;
                  $crb = \Carbon\Carbon::class;
                  
              @endphp
              @foreach($byr as $key => $value)
                  @php 
                      $sAwal  = $vm;
                      if($value->virtual_account==='selesai'):
                        $sAwal  = $vm;
                        $vm-=$value->pembayaran;
                      endif;
                  @endphp
                  <tr>
                    <td>{{ $crb::parse($value->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $value->nomor }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ strtoupper($value->metode) }}</td>
                    <td>
                        @if($value->virtual_account==='verifikasi')
                            <a href="{{ route('pembayaran.verifikasi',['pembayaran_id'=>$value->id]) }}" class="btn btn-xs btn-primary">
                                <i class="fa fa-check"></i> Verifikasi Transfer
                            </a>
                        @else
                            {{strtoupper($value->virtual_account)}}
                        @endif
                    </td>
                    <td class='text-right'>{{ number_format($sAwal) }}</td>
                    <td class='text-right'>{{ number_format($value->pembayaran) }}</td>
                    <td class='text-right'>{{ number_format($vm) }}</td>
                  </tr>
              @endforeach
          </tbody>
          <tbody>
            <tr>
                <th colspan='7' class='text-right'>
                    SALDO TAGIHAN
                </th>
                <td class='text-right'>
                    {{ number_format($vm) }}
                </td>
            </tr>
          </tbody>
      </table>   
  </div>
 </div>

@endsection

@section("jscript")
<script>
    $(document).ready(()=>{
        const jbayar = parseInt(`{{$vm}}`);
        const pbtr = $("#pbtr")
        if(jbayar==0){

            pbtr.hide();
        }
    });
</script>
@endsection