@extends('template.index')

@section('judul',Aset Kost'')
@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Aset</h3>
    
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Aset </th>
                    <th>&nbsp;</th>
                </tr>
               
            </thead>
            <tbody>
            @foreach($asets as $kunci => $value)
              <tr>
                <td>{{ $value->aset}}</td>
                <td><button type="button" class="btn btn-danger">hapus</button></td>
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
