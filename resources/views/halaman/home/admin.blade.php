@extends('template.index')
@section('judul','Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card bg-purple" style="cursor:pointer" onclick="openModal($(this))" data-modal="kamar.get">
                <div class="card-body text-center">
                    <i class="fas fa-bed fa-2x"></i>
                    <h3 id='jumlah-kamar'>0</h3>
                    <p>Jumlah Kamar</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card bg-blue" style="cursor:pointer" onclick="openModal($(this))" data-modal="kamar.get">
                <div class="card-body text-center">
                    <i class="fas fa-bed fa-2x"></i>
                    <h3 id='jumlah-kamar-terisi'>0</h3>
                    <p> Kamar Terisi</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card bg-red" style="cursor:pointer" onclick="openModal($(this))" data-modal="kamar.get">
                <div class="card-body text-center">
                    <i class="fas fa-bed fa-2x"></i>
                    <h3 id='jumlah-kamar-kosong'>0</h3>
                    <p> Kamar Kosong</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-green" style="cursor:pointer" onclick="openModal($(this))" data-modal="transaksi.keuntungan">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div  style='padding-left:5px;padding-right:5px; display:inline-block;
                    vertical-align: middle;float:none'>
                                    <i class="fa fa-money fa-2x"></i>
                                </div>
                                <div style='padding-left:5px;padding-right:5px; display:inline-block;
                    vertical-align: middle;float:none'>
                                    <h3>IDR. <span id="jumlah-bersih-keuntungan">0</span></h3>
                                    <p>Jumlah Keuntungan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-blue" style="cursor:pointer" onclick="openModal($(this))" data-modal="transaksi.pemasukan">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div  style='padding-left:5px;padding-right:5px; display:inline-block;
                    vertical-align: middle;float:none'>
                                    <i class="fa fa-money fa-2x"></i>
                                </div>
                                <div style='padding-left:5px;padding-right:5px; display:inline-block;
                    vertical-align: middle;float:none'>
                                    <h3>IDR. <span id="jumlah-pemasukan">0</span></h3>
                                    <p>Pemasukan</p>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <div class="col-md-4">
                    <div class="card bg-yellow" style="cursor:pointer" onclick="openModal($(this))" data-modal="transaksi.pengeluaran">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div  style='padding-left:5px;padding-right:5px; display:inline-block;
                    vertical-align: middle;float:none'>
                                    <i class="far fa-money fa-2x"></i>
                                </div>
                                <div style='padding-left:5px;padding-right:5px; display:inline-block;
                    vertical-align: middle;float:none'>
                                    <h3>IDR. <span id="jumlah-pengeluaran">0</span></h3>
                                    <p>Pengeluaran</p>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Penghuni</h3>
                </div>
                <div class="card-body">
                    <div class="chartjs-wrapper">
                        <canvas id="bar-canvas" class='chartjs'></canvas>
                    </div>
                </div>
            </div>        
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jumlah Penghuni Aktif</h3>
                </div>
                <div class="card-body">
                    <div class="chartjs-wrapper">
                        <canvas id="pie-canvas" class='chartjs'></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jscript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        $(document).ready(()=>{
            const defaultContent = `
                <div class='container-fluid'>
                    _CONTENT_
                </div>
            `
            const doTimer = (obj,to,plus=1,isCurrency=false)=>{
                let xcnt =0;
                let nnt = 0;
                let tmr = setInterval(()=>{
                    let cnt = isCurrency?xcnt.toLocaleString():xcnt;
                    if(nnt==150){
                        cnt=parseInt(to).toLocaleString();
                        $(obj).html(cnt);
                        clearInterval(tmr);
                    }
                    if(cnt==to){
                        $(obj).html(cnt);
                        clearInterval(tmr);
                    }else{
                        $(obj).html(cnt);
                    }
                    xcnt+=plus;
                    nnt++;
                },1);
            };
            $.ajax({
                type:'GET',
                url:`{{route('dashboard.kamar')}}`,

            }).done(response=>{
                const {jumlah,kosong,terisi} = response;
            
                doTimer($("#jumlah-kamar"),jumlah);
                doTimer($("#jumlah-kamar-terisi"),terisi);
                doTimer($("#jumlah-kamar-kosong"),kosong);
                $.ajax({
                    type:'GET',
                    url:`{{route('dashboard.money')}}`,
                }).done(responseKeuntungan=>{
                    const {keuntungan,pemasukan,pengeluaran} = responseKeuntungan;
                    window._keuntungan = keuntungan;
                    window._pemasukan = pemasukan;
                    window._pengeluaran = pengeluaran;
                    doTimer($("#jumlah-bersih-keuntungan"),keuntungan,1342,true);
                    doTimer($("#jumlah-pemasukan"),pemasukan,1342,true);
                    doTimer($("#jumlah-pengeluaran"),pengeluaran,1342,true);
                    $.ajax({
                        url:`{{route('dashboard.huni')}}`,

                    }).done(responseHuni=>{
                        const { data } = responseHuni;
                        let canvas = $("#pie-canvas")[0]
                        const cfg = {
                            type:'pie',
                            data:{
                                labels:[
                                    'Laki Laki',
                                    'Perempuan'
                                ],
                                datasets: [{
                                    data: data,
                                    backgroundColor:[
                                        '#36a2eb',
                                        '#ff6384',
                                    ]
                                }],
                            }
                        };
                        const chartPie = new Chart(canvas.getContext('2d'), cfg);
                        $.ajax({
                            url:`{{route('dashboard.daftar_huni_bulanan')}}`
                        }).done(responseBar=>{
                            const h = responseBar;
                            const barCanvas = $("#bar-canvas");
                            const bln = 'Jan,Feb,Mar,Apr,Mei,Jun,Jul,Agust,Sep,Okt,Nov,Des';
                            const labels = bln.split(',');
                            const lcfg = {
                                type:'bar',
                                
                                data:{
                                    labels:labels,
                                    datasets:[
                                        {
                                            label:'Penghuni',
                                            data: h,
                                            barPercentage: 1,
                                            barThickness: 10,
                                            maxBarThickness: 9,
                                            minBarLength: 2,
                                            backgroundColor:'#36a2eb',
                                        }
                                    ]
                                }
                            }
                            const chartBar = new Chart(barCanvas[0].getContext('2d'),lcfg);
                        })
                    })
                });
            });
            const openModalTransaksi = async(jenis)=>{
                let content='';
                let tipe = '';
                if(jenis==='pemasukan'){
                    tipe='Pemasukan'
                    const xios = axios
                    const days = {
                        awal:moment().clone().startOf("month").format("YYYY-MM-DD"),
                        akhir:moment().clone().endOf("month").format("YYYY-MM-DD")
                    }
                    const { data } = await xios.post(`{{ route('dashboard.money.masuk') }}`,days)
                     content = `
                        <div class='form-group'>
                            <label>Metode Pembayaran Transfer</label>
                            <h3>${data.transfer.toLocaleString()}</h3>

                        </div>
                        <div class='form-group'>
                            <label>Metode Pembayaran Tunai</label>
                            <h3>${data.tunai.toLocaleString()}</h3>

                        </div>
                    `

                }else if(jenis==='keuntungan'){
                    tipe='Keuntungan'
                    content = `
                        <div class='form-group'>
                            <label>Jumlah Pemasukan</label>
                            <h3 class='text-right'>${parseInt(window._pemasukan).toLocaleString()}</h3>
                        </div>
                        <div class='form-group'>
                            <label>Jumlah Pengeluaran</label>
                            <h3 class='text-right'>${parseInt(window._pengeluaran).toLocaleString()}</h3>
                        </div>
                        <hr>
                        <div class='form-group'>
                            <label>Keuntungan</label>
                            <h3 class='text-right'>${window._keuntungan.toLocaleString()}</h3>
                        </div>

                    `
                }else{
                    let param = {
                        t_awal:moment().clone().startOf("month").format("YYYY-MM-DD"),
                        t_akhir:moment().clone().endOf("month").format("YYYY-MM-DD")
                    }
                    const {data:{data:datas}} = await axios.post(`{{ route('api_lap_keluar.store') }}`,param)
                    content=`
                    <div class='container-fluid table-responsive'>
                        <table class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Pengeluaran</th>
                                    <th>Admin</th>
                                    <th>Lunas</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                _BODY_
                            </tbody>
                        </table>
                    </div>
                    `
                    tipe="Daftar Pengeluaran "
                    let html=''
                    let total = 0
                    for(let dat of datas){
                        const {nomor,admin:{name:admin},keterangan,created_at,nominal,pengeluaran:jenis_pengeluaran,status} = dat                       
                        html+=`
                            <tr>
                                <td>${nomor}</td>
                                <td>${moment(created_at).format("DD/MM/YYYY")}</td>
                                <td>${admin}</td>
                                <td>${jenis_pengeluaran}</td>
                                <td>${status}</td>
                                <td>${nominal.toLocaleString()}</td>
                                <td>${keterangan}</td>
                            </tr>
                        `
                        total+=parseInt(nominal)
                    }
                    html+=`
                        <tr>
                            <th colspan=5>TOTAL</th>
                            <th>${total.toLocaleString()}</th>
                            <th></th>
                        </tr>
                    `
                    content = content.replace(/_BODY_/g,html)
                }
                $(".modal").modal('toggle')
                $("#modal-title").html(`${tipe} {{env('APP_NAME','Kostanku')}}`)
                $("#modal-bdy").html(content)
                $(".modal button[type='submit']").hide()
            }

            const openModalKamar = async(tanggal)=>{
                $(".modal button[type='submit']").hide()
                let url = `{{url('/')}}/api/pembayaran/pertahun/${tanggal}/0`
                console.log(url)
                const {data:{results}} = await axios.get(url)
                console.log(results)
                let content = `
                    <div class='table-responsive'>

                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <td>Kamar</td>
                                <td>Jan ${tanggal}</td>
                                <td>Feb ${tanggal}</td>
                                <td>Mar ${tanggal}</td>
                                <td>Apr ${tanggal}</td>
                                <td>Mei ${tanggal}</td>
                                <td>Jun ${tanggal}</td>
                                <td>Jul ${tanggal}</td>
                                <td>Ags ${tanggal}</td>
                                <td>Sep ${tanggal}</td>
                                <td>Okt ${tanggal}</td>
                                <td>Nov ${tanggal}</td>
                                <td>Des ${tanggal}</td>
                                <td class='text-right'>Sub total</td>
                            </tr>
                        </thead>
                        <tbody>
                            _BODY_
                        </tbody>
                    </table>
                    </div>
                `;


                let html = ``;
                let total = 0
                for(let rs of results){
                    const {kamar,detail:details,subtotal} = rs
                    html+=`<tr>
                        <td>${kamar.nomor}</td>
                        `
                    for(let detail of details){
                        html+=`
                            <td>${detail.toLocaleString()}</td>
                        `
                    }
                    html+=`
                        <td>
                            ${subtotal.toLocaleString()}
                        </td>
                    </tr>
                    `
                    total+=parseInt(subtotal)
                }
                
                html+=`
                    <tr>
                        <th colspan=13 class='text-left'>
                            TOTAL
                        </th> 
                        <th class='text-right'>${total.toLocaleString()}</th>                       
                    </tr>
                `
                let data = content.replace(/_BODY_/g,html)
                $(".modal").modal('toggle')
                $("#modal-title").html(`Pembayaran Kamar Tahun ${tanggal}`)
                $("#modal-bdy").html(data)

            }
            window.openModal = (object)=>{
                let tanggal = moment().format("YYYY")
                
                let jenis = object.data("modal").split(".")
                if(jenis[0] ==='transaksi'){
                    openModalTransaksi(jenis[1])
                }else{
                    openModalKamar(tanggal)
                }
            }



        });
    </script>
@endsection
