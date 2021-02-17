@php 
    $carbon = \Carbon\Carbon::class;
@endphp
@extends('template.index')

@section('judul','Item Pengeluaran')
@section('content')
<div class="col-md-6 col-md-offset-3">
    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Pengeluaran</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('pemeliharaan.index') }}" class="btn btn-primary btn-sm">
              Kembali
          </a>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
            
            <p>
                Jenis Pengeluaran
                <p>
                  <strong>{{ strtoupper($data->jenis_pengeluaran) }}</strong>
                </p>
            </p>
            @switch($data->jenis_pengeluaran)
                  @case("pemeliharaan")
                    <p>
                        Nomor Kamar
                        <p>
                          <strong>{{ $data->getKamar()==NULL ? '' : $data->getKamar()->nomor  }}</strong>
                        </p>
                    </p>
                    @break
                  @case("penambahan aset")
                    <p>
                        Nama Aset
                        <p>
                          <strong>{{ $data->getAset()==NULL?"" : $data->getAset()->aset }}</strong>
                        </p>
                    </p>
                    @break
                  @default
                    <p>
                        Perbaikan Fasilitas
                        <p>
                          <strong>{{ $data->getFasilitas()==NULL ? '' :
                                      ($data->getFasilitas()->getAset()==NULL ? '' : $data->getFasilitas()->getAset()->aset." Nomor Kamar : ".
                                        ($data->getFasilitas()->getKamar() == NULL ? "-" : $data->getFasilitas()->getKamar()->nomor ) ) }}</strong>
                        </p>
                    </p>
                    @break

            @endswitch
            <p>
                Tanggal
                <p>
                    <strong>
                      {{ $carbon::parse($data->created_at)->format('d-m-Y') }}
                    </strong>
                </p>

            </p>
            <p>
                Biaya
                <p>
                    <strong>
                      {{ number_format($data->total_biaya) }}
                    </strong>
                </p>

            </p>
            <p>
                Admin
                <p>
                    <strong>
                      {{ $data->getUser()->name }}
                    </strong>
                </p>

            </p>
            <p>
                Keterangan
                <p>
                    <strong>
                      "{{ $data->keterangan}}"
                    </strong>
                </p>

            </p>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        The footer of the box
      </div>
    </div>

</div>

@endsection
