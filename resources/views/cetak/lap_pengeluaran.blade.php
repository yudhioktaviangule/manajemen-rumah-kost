<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN PENGELUARAN {{date('dmYHis')}}</title>
    <script src="{{asset('aset/bower_components/jquery/dist/jquery.js')}}"></script>
    <script src="{{asset('aset/bower_components/moment/moment.js')}}"></script>
    <style>
        body{
            font-family: 'Courier New', Courier, monospace;
            font-size: 10pt;
        }
        th,td{
            padding:10px;
        }
        .text-center{
            text-align: center;
        }
        .text-left{
            text-align: left;
        }
        .botborder{
            
            border-bottom:1px solid #333;
            
        }
        .topborder{
            border-top:1px solid #333;

        }
        .container-fluid{
            width:{{env('APP_SIZE_PRINT_DOC')}}%;
        }
        .text-right{
            text-align: right;
        }
    </style>
</head>
<body>
    <h3>LAPORAN PENGELUARAN<br><small>Kost Hj. IRMAWATI</small></h3>
    <h4>Periode {{\Carbon\Carbon::parse($between[0])->format('d F Y')}} - {{\Carbon\Carbon::parse($between[1])->format('d F Y')}}</h4>
    <table class="container-fluid" cellspacing=0 cellpadding=0 >
        <thead >
            <tr>
                <th rowspan="2" class='topborder botborder'>Tanggal</th>
                <th rowspan="2" class='topborder botborder'>No. Transaksi</th>
                <th rowspan="2" class='topborder botborder text-left'>Jenis Pengeluaran</th>
                <th rowspan="2" class='topborder botborder text-left'>Admin</th>
                <th class="topborder botborder">Lunas</th>
                <th class="topborder botborder">Keterangan</th>
                <th rowspan="2" class="topborder botborder text-right">Nominal</th>
            </tr>
            
        </thead>
        <tbody id="content-isi">
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right topborder botborder" colspan="6">GRAND TOTAL</th>
                <th class="text-right topborder botborder" id='grand-total'></th>
            </tr>
            <tr>
                <td colspan="6"></td>
                <td class="text-center" id=''>
                    <p>Makassar,{{date('d/m/Y')}}</p>
                    <p>PEMILIK</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p><strong>Hj. IRMAWATI</strong></p>
                    
                </td>
            </tr>
        </tfoot>

    </table>
    <script>
        $(document).ready(()=>{
            window.content={};
            $.ajax({
                type:'POST',
                data:{
                    t_awal:`{{$between[0]}}`,
                    t_akhir:`{{$between[1]}}`,
                    _token:`{{csrf_token()}}`
                },
                url:`{{ route('api_lap_keluar.store') }}`,
            }).done(json=>{
                let total = 0;
                const {data} = json;
                let html = ``;
                data.map(value=>{
                    const {admin:{name:admin},nominal,pengeluaran,nomor,keterangan,status,created_at}= value;
                    const tanggal = moment(created_at).format('DD-MM-YYYY');
                    total+=parseInt(nominal)
                    html+=`
                        <tr>
                            <td class='text-center'>${tanggal}</td>
                            <td class='text-center'>${nomor}</td>
                            <td class='text-left'>${pengeluaran}</td>
                            <td class='text-left'>${admin}</td>
                            <td class='text-center'>${status.toUpperCase()}</td>
                            <td class='text-center'>${keterangan}</td>
                            <td class='text-right'>${parseInt(nominal).toLocaleString()}</td>
                        </tr>
                    `
                })
                $("#content-isi").html(html);
                $("#grand-total").html(total.toLocaleString());
                window.print()
            })
        });
    </script>
</body>
</html>