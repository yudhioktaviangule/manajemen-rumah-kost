@extends('template.index')

@section('judul','Penghuni')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-4 col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Pembayaran Lunas
                </h3>
            </div>
            <div class="card-body">
                <p>
                    Halo... Penyewa dengan nama <strong>{{$penyewa->name}}</strong> Telah Melunasi Pembayaran.<br>
                    Apakah {{$penyewa->name}} ingin melanjutkan penyewaan di kamar {{$kamar->nomor}}?<br>
                    <br>
                    <a href="{{route('checkout_lanjutan.index')}}?kamar={{$kamar->id}}&penyewa={{$penyewa->id}}" class="btn btn-primary btn-sm">Ya</a>
                    <a href="#" class="btn btn-danger btn-sm">Tidak</a>

                </p>

            </div>
            <div class="card-footer">
                
            </div>
        </div>

    </div>
</div>

@endsection