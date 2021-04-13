@extends('layouts.app')
@php
    $kamars = \App\Models\Kamar::where("status","ready")->get();
    
@endphp
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Regitrasi Penghuni') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>
                            Terjadi kesalahan
                        </strong> 
                        
                        @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                            
                            
                        
                    @endif
                    <form method="POST" action="{{ route('myregister.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group row">
                                    <label for="nik" class="col-md-4 col-form-label text-md-right">{{ __('NIK') }}</label>

                                    <div class="col-md-6">
                                        <input id="nik" maxlength="16" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus>

                                        @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                            
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama ') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hp" class="col-md-4 col-form-label text-md-right">{{ __('No Hp') }}</label>

                                    <div class="col-md-6">
                                        <input id="hp" maxlength="12" type="text" class="form-control @error('hp') is-invalid @enderror" name="hp" value="{{ old('hp') }}" required autocomplete="hp" autofocus>

                                        @error('hp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kota_asal" class="col-md-4 col-form-label text-md-right">{{ __('Kota Asal') }}</label>

                                    <div class="col-md-6">
                                        <input id="Kota_asal" type="text" class="form-control @error('kota_asal') is-invalid @enderror" name="kota_asal" value="{{ old('kota_asal') }}" required autocomplete="kota_asal" autofocus>

                                        @error('kota_asal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                

                            </div>
                            <div class="col-md-6 col-12">

                                <div class="form-group row">
                                    <label for="pekerjaan" class="col-md-4 col-form-label text-md-right">{{ __('Pekerjaan') }}</label>
                                    <div class="col-md-6">
                                        <select id="pekerjaan" name="pekerjaan" class='form-control'>
                                            <option value="pelajar">Pelajar/Mahasiswa</option>
                                            <option value="pns">PNS</option>
                                            <option value="swasta">Pekerja Swasta</option>
                                        </select>
                                    </div>
                                </div>
                        

                                <div class="form-group row">
                                    <label for="jk" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>

                                        <div class="col-md-6">
                                            <select id="jk" name="jk" class='form-control'>
                                                <option value="laki-laki">Laki-Laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kamar_id" class="col-md-4 col-form-label text-md-right">Nomor Kamar</label>
                                    <div class="col-md-6">
                                        <select id="kamar_id" name="kamar_id" class='form-control'>
                                            @foreach($kamars as $kamar => $value)
                                                <option value="{{ $value->id }}">{{$value->nomor}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lama_sewa" class="col-md-4 col-form-label text-md-right">Lama Sewa(Bulan)</label>
                                    <div class="col-md-6">
                                        <input required min=1 value=1 id="lama_sewa" type="number" class="form-control @error('lama_sewa') is-invalid @enderror" name="lama_sewa" required autocomplete="off">
                                    </div>
                                </div>
                                <p class='text-center'>
                                    <strong>Contact Keluarga</strong>
                                </p>
                                <div class="form-group row">
                                    <label for="lama_sewa" class="col-md-4 col-form-label text-md-right">Nama</label>
                                    <div class="col-md-6">
                                        <input required type='text' class="form-control" name="nama_contact" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lama_sewa" class="col-md-4 col-form-label text-md-right">Hubungan Keluarga</label>
                                    <div class="col-md-6">
                                        <select name="hubungan_keluarga" id="" class="form-control">
                                            <option value="Suami / Istri">Suami / Istri</option>
                                            <option value="Anak">Anak</option>
                                            <option value="Orang Tua(Ayah)">Ayah</option>
                                            <option value="Orang Tua(Ibu)">Ibu</option>
                                            <option value="Saudara">Saudara</option>
                                            <option value="Kerabat Lain">Kerabat Lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lama_sewa" class="col-md-4 col-form-label text-md-right">No. Telepon/Handphone</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="telepon_contact" maxlength="15" placeholder='+62'></input>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4"></div>
                                    <div class="text-right col-6">
                                        <button type="submit" class="btn btn-primary ">
                                            {{ __('Registrasi') }}
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col">
                                <div class="container-fluid">
                                    <div class="container-fluid">
                                        
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
