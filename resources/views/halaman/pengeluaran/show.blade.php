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
          <a href="{{ route('pengeluaran.index') }}" class="btn btn-primary btn-sm">
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
                  <strong>{{ strtoupper($data->pengeluaran) }}</strong>
                </p>
            </p>
           
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
                      {{ number_format($data->nominal) }}
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
                      {{ $data->keterangan}}
                    </strong>
                </p>

            </p>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        
      </div>
    </div>

</div>

@endsection
