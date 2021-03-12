@extends('template.index')

@section('judul',"Dashboard")
@section('content')
  
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

