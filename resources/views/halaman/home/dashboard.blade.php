@extends('template.index')

@section('judul',"Dashboard")
@section('content')
<div class="col-md-6">
    <form class="box" action="{{route('kamar.store')}}" method="POST">
        @csrf
      <div class="box-header with-border">
        <h3 class="box-title">Pemasukan/Pengeluaran</h3>
        <div class="box-tools pull-right">
        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
        </div>
       
      </div>

      <div class="box-body">
          <div class="col-md-12">
            <div id="areaChart" style="height:250px"></div>
          </div>
      </div>
      
      <div class="box-footer">
        <div class="row">
          <div class="col-xs-6">
          <div class="chart" id="pemasukan-donut-chart" style="height: 128px; position: relative;"></div>
        </div>
        <div class="col-xs-6">
            <div class="chart" id="pengeluaran-donut-chart" style="height: 128px; position: relative;"></div>

          </div>
        </div>
      </div>
      
    </form>

</div>
<div class='col-md-6'>
  <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
          Pemeliharaan Kamar
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div id="chart-keluar-pemeliharaan" style="height:250px"></div>
    </div>
  </div>
</div>
<div class='col-md-6'>
  <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
          Pengadaan Fasilitas
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div id="chart-keluar-pengadaan" style="height:250px"></div>
    </div>
  </div>
</div>
<div class="col-md-6"></div>
<div class='col-md-6'>
  <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
          Perawatan Fasilitas
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div id="chart-keluar-perawatan" style="height:250px"></div>
    </div>
  </div>
</div>

@endsection
@section('css')
  
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection
@section("jscript")
<script src="{{asset('aset/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('aset/bower_components/morris.js/morris.min.js')}}"></script>
  <script>
  $(async ()=>{
    'use-strict';
      const { data } = await axios.get("{{route('chart_pemasukan')}}")
  
      new Morris.Line({
        element:'areaChart',
        data:data,
        xkey:['kol'],
        ykeys: ['pemasukan', 'pengeluaran'],
      labels: ['Pemasukan', 'Pengeluaran'],
      lineColors: ['#2980b9', '#e74c3c'],
      hideHover: 'auto'
      })
      let sumPengeluaran=0
      let sumMasuk=0
      for(let l of data){
        sumPengeluaran+=l.pengeluaran;
        sumMasuk+=l.pemasukan;
      }
      const total = sumMasuk+sumPengeluaran;
      var donut = new Morris.Donut({
      element: 'pemasukan-donut-chart',
      resize: true,
      colors: [ "#2980b9","#ecf0f1"],
      data: [
        {label: "Pemasukan %", value: Math.round((sumMasuk/total)*100)},
        {label: "Total %", value: 100},
        
      ],
      hideHover: 'auto'
    });
      var donut2 = new Morris.Donut({
      element: 'pengeluaran-donut-chart',
      resize: true,
      colors: [ "#2980b9","#ecf0f1"],
      data: [
        {label: "Pengeluaran %", value: Math.round((sumPengeluaran/total)*100)},
        {label: "Total %", value: 100},
        
      ],
      hideHover: 'auto'
    });

    const { data:pengeluarans} = await axios.get("{{route('chart_pengeluaran')}}");
    const mLine2 = new Morris.Line({
      element:'chart-keluar-pemeliharaan',
      data:pengeluarans,
      xkey:['d'],
      ykeys:['pemeliharaan'],
      lineColors:['#0abde3'],
      labels:['Pemeliharaan'],
      hideHover: 'auto'
    });
    const mLine3 = new Morris.Line({
      element:'chart-keluar-pengadaan',
      data:pengeluarans,
      xkey:['d'],
      ykeys:['assets'],
      lineColors:['#0abde3'],
      labels:['Pengadaan'],
      hideHover: 'auto'
    });
    const mLine4 = new Morris.Line({
      element:'chart-keluar-perawatan',
      data:pengeluarans,
      xkey:['d'],
      ykeys:['perawatan'],
      lineColors:['#0abde3'],
      labels:['Perawatan Fasilitas'],
      hideHover: 'auto'
    });

  });
</script>
@endsection

