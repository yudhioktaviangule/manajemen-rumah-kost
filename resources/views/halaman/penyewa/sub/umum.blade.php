<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">Jenis Kelamin</label>
            <input type="text" value="{{strtoupper($data->jenis_kelamin)}}" readonly="readonly" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Kota Asal</label>
            <input type="text" value="{{$data->kota_asal}}" readonly="readonly" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Pekerjaan</label>
            <input type="text" value="{{$data->pekerjaan}}" readonly="readonly" class="form-control">
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" value="{{$data->getUser()->email}}" readonly="readonly" class="form-control">
        </div>
        <div class="form-group">
            <label for="">No. Handphone</label>
            <input type="text" value="{{$data->hp}}" readonly="readonly" class="form-control">
        </div>
    </div>
</div>

