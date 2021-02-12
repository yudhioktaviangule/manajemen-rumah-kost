@extends('template.index')

@section('judul','Fasilitas Kamar')
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
                    <th>Nomor Kamar</th>
                    <th>Fasilitas</th>
                    <th>Options</th>
                </tr>
            </thead>
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
@endsection

