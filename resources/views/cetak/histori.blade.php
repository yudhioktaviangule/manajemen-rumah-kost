@php 
    
    $penyewa   = $ksewa->getPenyewa();
    $kamar     = $ksewa->getKamar();
    $bayar     = $ksewa->getPembayaran();
    $carb      = \Carbon\Carbon::class;
    $sum       = $ksewa->getTotalBayar();
    $sisa       = $ksewa->sisaPembayaran();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Histori {{$kamar->nomor}}</title>
    <style>
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .text{
            text-align: left;
        }
        .container-fluid{
            width:{{env('APP_SIZE_PRINT')}}%;
        }
        body{
            font-family: 'Courier New', Courier, monospace;
            font-size: 10pt;
        }
    </style>
</head>
<body>
    <table class='container-fluid'>
        <tr>
            <th class='text-center' style='padding-bottom:35px;' colspan=4>
                RUMAH KOST Hj. IRMAWATI
            </th>
        </tr>
        <tr>
            <td class='text'>Nama Penyewa</td>
            <td class='text'>: {{$penyewa->name}}</td>
            <td class='text-right'>Lama Sewa</td>
            <td class='text'>: {{$ksewa->lama_sewa}}</td>
        </tr>
        <tr>
            <td class='text'>Tanggal Masuk</td>
            <td>: {{$carb::parse($ksewa->created_at)->format('d-m-Y')}}</td>
            <td class='text-right'>Total Tagihan</td>
            <td>: Rp. {{number_format($ksewa->total_sewa)}}</td>
        </tr>
        <tr>
            <td class='text'>Nomor Kamar</td>
            <td>: {{$kamar->nomor}}</td>
            <td class='text-right'>Tarif sewa / Bulan</td>
            <td>: Rp. {{number_format($kamar->harga)}}</td>
        </tr>
    </table>
    <br>
    <table class='container-fluid' border=1 cellspacing=0 cellpadding=0>
        <tr>
            <th>No. Pembayaran</th>
            <th>Keterangan</th>
            <th>Tanggal Bayar</th>
            <th>Stat. Bayar</th>
            <th class='text-right'>Jumlah Pembayaran</th>
        </tr>
        @foreach($bayar as $key => $value)
            <tr>
                <td>{{$value->nomor}}</td>
                <td>{{$value->name}}</td>
                <td class='text-center'>{{$carb::parse($value->created_at)->format('d-m-Y')}}</td>
                <td>{{strtoupper($value->virtual_account)}}</td>
                <td class="text-right">
                    {{number_format($value->pembayaran)}}
                </td>
            </tr>
        @endforeach
    </table>
    <br>
    <div class="container-fluid">
        <hr>
    </div>
    <br>
    <table class="container-fluid">
        <tr>
            <td style='width:200px'>YANG SUDAH TERBAYAR</td>
            <td>: {{number_format($sum)}}</td>
        </tr>
        <tr>
            <td>
                SISA PEMBAYARAN
            </td>
            <td>: {{ number_format($sisa->saldo) }}</td>
        </tr>
        <tr>
            <td>
                TGL. CHECKOUT
            </td>
            <td>: {{ $carb::parse($ksewa->created_at)->addMonths($ksewa->lama_sewa)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>KET. LUNAS </td>
            <td>: {{$sisa->lunas==true?"LUNAS":"BELUM LUNAS"}}</td>
        </tr>
        
    </table>
    <br>
    <div class="container-fluid">
        <hr>
    </div>
    <br>
    <table class="container-fluid">
        <tr>
            <td class='text-center' style='width:30%'>
                PENYEWA
                <br><br><br><br>
                <strong>{{$penyewa->name}}</strong>
            </td>
            <td style='width:30%'></td>
            <td class='text-center' style='width:40%'>
            
                Makassar, {{date('d/m/Y')}} <br>
                PEMILIK <br>
                <br><br>
                <strong>Hj. IRMAWATI</strong>
            </td>
        </tr>
    </table>
    <script>
        window.print();
    </script>
</body>
</html>