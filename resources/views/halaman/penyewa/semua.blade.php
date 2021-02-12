@extends('template.index')

@section('judul','Penyewa')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Kamar</h3>
    
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No.Hp</th>
                    <th>Fasilitas</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            @foreach($penyewas as $kunci => $value)
              <tr>
                <td>{{ $value->name}}</td>
                <td>{{ $value->hp}}</td>
                <td>{{ $value->jenis_kelamin}}</td>
                <td><button type="button" class="btn btn-danger">Hapus</button></td>
                <td></td>
              </tr> 
            @endforeach
            </tbody>
            <tbody></tbody>
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
