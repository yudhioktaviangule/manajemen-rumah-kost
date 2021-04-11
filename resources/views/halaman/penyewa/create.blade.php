@extends('template.index')

@section('judul','Register Penghuni')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-12">
        <form class="card" action="{{route('myregister.store')}}" method="POST">
            @csrf
        <div class="card-header with-border">
            <h3 class="card-title">Data Penghuni</h3>
            <div class="card-tools pull-right">
            <a href="{{ route('penyewa.index') }}" class="btn btn-primary btn-sm">
                Kembali
            </a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">No.Hp</label>
                    <input type="text" maxlength="20" class="form-control" name="hp" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">NIK</label>
                    <input type="text" maxlength="16" class="form-control" name="nik" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Kota Asal</label>
                    <input type="text" class="form-control" name="kota_asal" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">email</label>
                    <input type="email" class="form-control" name="email" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select name="jk" id="" class="form-control">
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="">Pekerjaan</label>
                    <select name="pekerjaan" id="" class="form-control">
                    <option value="pelajar">Pelajar / Mahasiswa</option>
                    <option value="swasta">Pekerja Swasta</option>
                    <option value="pns">Pegawai Negeri</option>
                    </select>
                </div> 
                <div class="form-group">
                    <button class="btn btn-success">
                        Simpan
                    </button>
                </div> 
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            The footer of the card
        </div>
        <!-- box-footer -->
        </form>

    </div>
</div>

@endsection