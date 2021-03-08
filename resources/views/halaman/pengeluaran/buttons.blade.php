<div class="text-right">
    <a href="{{route('pengeluaran.show',['pengeluaran'=>$value->id])}}" class="btn btn-sm btn-primary">
        <i class="fa fa-eye"></i> Lihat Data
    </a>
    <a href="#" onclick="hapus(`{{route('pengeluaran.destroy',['pengeluaran'=>$value->id])}}`)" class="btn btn-sm btn-danger">
        <i class="fa fa-eye"></i> Hapus Data
    </a>

</div>