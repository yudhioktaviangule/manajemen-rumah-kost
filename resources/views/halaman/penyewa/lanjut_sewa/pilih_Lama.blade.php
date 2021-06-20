@extends('template.index')

@section('judul','Penghuni')
@section('content')
<form method="post" class="row justify-content-center">
    @csrf
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Register Lanjut Sewa
                </h3>
            </div>
            <div class="card-body">
                <p>
                    <div class="row">
                        <div class="col-4">
                            Nama Penyewa
                        </div>
                        <div class="col-8">
                            {{$penyewa->name}}
                        </div>
                    </div>
                </p>
                <p>
                    <div class="row">
                        <div class="col-4">
                            Nomor Kamar
                        </div>
                        <div class="col-8">
                            {{$kamar->nomor}}
                        </div>
                    </div>
                </p>
                <p>
                    <div class='form-group'>
                        <label for='lama_sewa'>Lama Penyewaan</label>
                        <input required placeholder='Input Lama Penyewaan' onchange="onchangeSetPembayaran($(this))" type='number' class='form-control' id='lama_sewa' name='lama_sewa'>
                    </div>
                    <div class='form-group'>
                        <label for='lama_sewa'>Jumlah Pembayaran</label>
                        <input type="text" id="tobar" class="form-control" readonly>
                    </div>
                </p>
            </div>
            <div class="card-footer">
                <input type="hidden" name="penyewa" value="{{$penyewa->id}}">
                <input type="hidden" name="kamar" value="{{$kamar->id}}">
                <button class="btn btn-sm btn-primary">SIMPAN</button>
            </div>
        </div>

    </div>
</form>

@endsection

@section("jscript")
    <script>
        $(document).ready(()=>{
            window.hargaKamar={{$kamar->harga}};
            window.onchangeSetPembayaran = (obj)=>{
                let val  = parseInt(obj.val())
                let harga = val*window.hargaKamar;
                $("#tobar").val(harga.toLocaleString());
            };

        });

    </script>
@endsection