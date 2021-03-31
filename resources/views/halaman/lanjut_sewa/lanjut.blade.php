
@php
    $penyewa = $ks->getPenyewa();
    $kamar   = $ks->getKamar();
@endphp

@extends('template.index')
@section('judul','Lanjut Kontrakan')
@section('content')
<div class="col-md-6 col-md-offset-3">
    <form class="box" action="{{route('lanjut.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Lanjut Kontrakan</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('penyewa.show',['penyewa'=>$penyewa->id]) }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        
      </div>
      
      <div class="box-body">
            <div class="form-group">
                <label for="">Nama</label>
                <p>{{$penyewa->name}}</p>
            </div>
            <div class="form-group">
                <label for="">No. Kamar</label>
                <p>{{$kamar->nomor}}</p>
            </div>
            <div class='form-group'>
                <label for='lama_sewa'>Lama Sewa</label>
                <input value='0' required placeholder='Input Lama Sewa' type='number' class='form-control' id='lama_sewa' name='lama_sewa'>
            </div>
            <input type="hidden" name='kamar_sewa_id' value="{{ $ks->id }}">
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