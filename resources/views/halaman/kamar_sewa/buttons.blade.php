<div class="text-right">
    @if($data==NULL)
        <a href="{{ route('kamar_sewa.create') }}?penyewa={{$jdec->id}}" class="btn btn-primary btn-sm btn-block">
            <i class="fa fa-plus"></i>
            Tambah Kamar
        </a>
    @else
        <a href="{{route('pindah_kamar.create')}}?id={{$sewa->id}}" class="btn btn-success btn-sm btn-block">
            <i class="fa fa-exchange"></i> Pindah Kamar
        </a>
        <a href="{{route('kamar_sewa.show',['kamar_sewa'=>$sewa->id])}}" class="btn btn-danger btn-sm btn-block">
            <i class="fa fa-building-o"></i> Pindah Kost
        </a>
    @endif
</div>