@if($value->aktif==='nonaktif')
    <a href="{{ route('user.aktivasi',['user'=>$value->id]) }}" class="btn btn-sm btn-success">
        <i class="fa fa-check"></i>Aktivasi
    </a>
@elseif($value->getKamar()==NULL)
    <a href="{{route('reservasi.create')}}?id={{$value->penyewa_id}}" class="btn btn-primary btn-sm">
        <i class="fa fa-book"></i> Reservasi Kamar
    </a>
@else
    <a href="{{route('penyewa.show',['penyewa'=>$value->penyewa_id])}}" class="btn btn-primary btn-sm btn-block">
        <i class="fa fa-eye"></i> Lihat data
    </a>
@endif