@extends('template.index')

@section('judul','Register Penghuni')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-12">
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
                <div class="container-fluid">
                <p>
                    @if($errors->any())
                        
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $key => $value)
                                
                                {{$value}}<br>
                            @endforeach        
                        </div>
                    @endif
                </p>

                    <div class="row">
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="text" maxlength="16" class="form-control" name="nik" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">No.Hp</label>
                                <input type="text" maxlength="20" class="form-control" name="hp" placeholder="">
                            </div>
                           
                            <div class="form-group">
                                <label for="">Kota Asal</label>
                                <input type="text" class="form-control" name="kota_asal" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="jk" id="" class="form-control">
                                <option value="laki-laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
                                </select>
                            </div> 
                
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="">email</label>
                                <input type="email" class="form-control" name="email" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="">
                            </div> 
                            
                            <div class="form-group">
                                <label for="">Pekerjaan</label>
                                <select name="pekerjaan" id="" class="form-control">
                                <option value="pelajar">Pelajar / Mahasiswa</option>
                                <option value="swasta">Pekerja Swasta</option>
                                <option value="pns">Pegawai Negeri</option>
                                </select>
                            </div> 

                            <div class='form-group'>
                                <label for='kamar_id'>Kamar</label>
                                <select required class='form-control' name='kamar_id' id='name'>
                                    <option value=''>Pilih Kamar</option>
                                    @foreach($kamar as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nomor}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class='form-group'>
                                <label for='lama'>Lama Sewa</label>
                                <input required placeholder='Input Lama Sewa' type='number' class='form-control' id='lama' name='lama_sewa'>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class='form-group'>
                                <label for='nama_contact'>Nama Keluarga</label>
                                <input required placeholder='Input Nama Keluarga' type='text' class='form-control' id='nama_contact' name='nama_contact'>
                            </div>
                            <div class='form-group'>
                                <label for='hubungan_keluarga'>Hubungan Keluarga</label>
                                <select required class='form-control' name='hubungan_keluarga' id='hubungan_keluarga'>
                                    <option value=''>Pilih Hubungan Keluarga</option>
                                    <option value="Suami / Istri">Suami / Istri</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Orang Tua(Ayah)">Ayah</option>
                                    <option value="Orang Tua(Ibu)">Ibu</option>
                                    <option value="Saudara">Saudara</option>
                                    <option value="Kerabat Lain">Kerabat Lain</option>                                    
                                </select>
                            </div>
                            <div class='form-group'>
                                <label for='telepon_contact'>Nomor Telepon Keluarga</label>
                                <input required placeholder='Nomor Telepon Keluarga' type='text' class='form-control' id='telepon_contact' name='telepon_contact'>
                            </div>
                        </div>

                    </div>
                </div>
                
               
                <div class="form-group text-right">
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