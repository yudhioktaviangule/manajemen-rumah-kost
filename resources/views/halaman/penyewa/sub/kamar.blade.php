<div class="row">
    <div class="col-12 col-md-6">
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
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">Tanggal Check-out</label>
            <input type="text" value="{{\Carbon\Carbon::parse($data->getSewa()->created_at)->addMonths($data->getSewa()->lama_sewa)->format('d-m-Y')}}" readonly class="form-control"></input>
        </div>
        <div class="form-group">
            <label for="">Saldo Tagihan</label>
            <input type="text" readonly value="Rp. {{number_format($dibayar)}},-" id="" class="form-control">
        </div>  
    </div>
</div>