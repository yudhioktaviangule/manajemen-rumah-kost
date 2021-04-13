
@extends('template.index')
@section('judul','Virtual Account Penghuni')
@section('content')
@php 
    $ks = $data->getSewa();
    $pembayaran = $ks->getPembayaran();
    $dibayar = $ks->sisaPembayaran()->saldo;
    foreach($pembayaran as $key =>$value):
        if(strtolower($value->virtual_account)=='verifikasi'){
            $dibayar+=$value->pembayaran;
        }
    endforeach;
@endphp
<div class="row justify-content-center">
    <div class="col-md-8 col-12">
        <div class="card">
            @csrf
        <div class="card-header with-border">
            <h3 class="card-title">Data Penyewa</h3>
            <div class="card-tools pull-right">
            <a href="{{ route('penyewa.index') }}" class="btn btn-primary btn-sm">
                Kembali
            </a>
            </div>
            
        </div>
        
        <div class="card-body">
            <div class="form-group row">
                <label for="" class='col-md-3 col-12'>NIK</label>
                <div class="col-12 col-md-9">
                    <input type="text" readonly value="{{$data->nik}}" class="form-control">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="" class='col-md-3 col-12'>Nama</label>
                <div class="col-12 col-md-9">
                    <input type="text" readonly value="{{$data->name}}" class="form-control">
                </div>
            </div>
            
            @include("halaman.penyewa.tab")
            
        </div>
        <div class="card-footer">
                <a href="{{ route('pindah_kamar.create') }}?id={{$data->getSewa()->id}}" class="btn btn-sm btn-primary"><i class="fas fa-bed"></i> Pindah Kamar</a>
                <a href="{{ route('lanjut.show',['lanjut'=>$data->getSewa()->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-plus"></i> Tambah Lama Sewa</a>
                <a href="{{ route('penghuni.bayar',['penyewa_id'=>$data->id]) }}" class="btn btn-sm btn-success"><i class="fab fa-get-pocket"></i> Pembayaran</a>
                <a href="{{ route('penyewa.checkout',['kamar_sewa_id'=>$data->getSewa()->id]) }}" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Checkout</a>
        </div>
        </div >

    </div>

</div>

@endsection