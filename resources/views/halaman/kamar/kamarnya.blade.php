@extends('template.index')

@section('judul','Data Kamar')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Kamar</h3>
    <div class="box-tools pull-right">
      <a href="{{ route('penyewa.create') }}" class="btn btn-primary btn-sm">
          Pilih Kamar
      </a>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor </th>
                    <th>Status</th>
                    <th>Harga</th>
                    <th>&nbsp;</th>
                </tr>
               
            </thead>
            <tbody>
            @foreach($kamar as $kunci => $value)
              <tr>
                <td>{{ $value->nomor}}</td>
                <td>{{ $value->status}}</td>
                <td>{{ $value->harga}}</td>
                <td></td>
              </tr> 
            @endforeach
            </tbody>
        </table>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    The footer of the box
  </div>
  <!-- box-footer -->
</div>
<!-- /.box -->
@endsection
