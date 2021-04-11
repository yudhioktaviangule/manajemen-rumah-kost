
@extends('template.index')
@section('judul','Virtual Account Penghuni')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-12 col-md-offset-3">
        <div class="card">
            @csrf
        <div class="card-header with-border">
            <h3 class="card-title"><i class="fa fa-user"></i> {{$data->name}}</h3>
            <div class="card-tools pull-right">
            <a href="{{ route('penyewa.index') }}" class="btn btn-primary btn-sm">
                Kembali
            </a>
            </div>
            
        </div>
        
        <div class="card-body">
                <div class="form-group">
                    <label for="">NIK</label>
                    <input type="text" readonly value="{{$data->nik}}" class="form-control">
                    
                </div>
                <div class="form-group">
                    <label for="">No. Kamar</label>
                    <input type="text" value="{{$data->getKamar()->nomor}}" readonly="readonly" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Check-in</label>
                    <input type="text" readonly class="form-control" value="{{\Carbon\Carbon::parse($data->getSewa()->created_at)->format('d-m-Y')}} ">
                </div>
                <div class="form-group">
                    <label for="">Lama Sewa</label>
                    <input type="text" value="{{$data->getSewa()->lama_sewa}} Bulan" readonly class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Check-out</label>
                    <input type="text" value="{{\Carbon\Carbon::parse($data->getSewa()->created_at)->addMonths($data->getSewa()->lama_sewa)->format('d-m-Y')}}" readonly class="form-control"></input>
                </div>
                <div class="form-group">
                    <label for="">Jumlah Tagihan</label>
                    <input type="text" readonly value="Rp. {{number_format($data->getSewa()->total_sewa)}},-" id="" class="form-control">
                </div>
                
                
                
                
        </div>
        <div class="card-footer">
                <a href="{{ route('pindah_kamar.create') }}?id={{$data->getSewa()->id}}" class="btn btn-sm btn-primary"><i class="fa fa-exchange"></i> Pindah Kamar</a>
                <a href="{{ route('lanjut.show',['lanjut'=>$data->getSewa()->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Tambah Lama Sewa</a>
                <a href="{{ route('penghuni.bayar',['penyewa_id'=>$data->id]) }}" class="btn btn-sm btn-success"><i class="fa fa-get-pocket"></i> Pembayaran</a>
                <a href="{{ route('penyewa.checkout',['kamar_sewa_id'=>$data->getSewa()->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-sign-out"></i> Checkout</a>
        </div>
        </div >

    </div>

</div>

@endsection