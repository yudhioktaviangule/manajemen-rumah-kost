@extends('template.index')
@section('judul','Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box bg-purple">
                <div class="box-body text-center">
                    <i class="fa fa-bed fa-2x"></i>
                    <h3 id='jumlah-kamar'>0</h3>
                    <p>Jumlah Kamar</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box bg-blue">
                <div class="box-body text-center">
                    <i class="fa fa-bed fa-2x"></i>
                    <h3 id='jumlah-kamar-terisi'>0</h3>
                    <p> Kamar Terisi</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box bg-red">
                <div class="box-body text-center">
                    <i class="fa fa-bed fa-2x"></i>
                    <h3 id='jumlah-kamar-kosong'>0</h3>
                    <p> Kamar Kosong</p>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="box bg-green">
                        <div class="box-body">
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
                    <div class="box bg-blue">
                        <div class="box-body">
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
                    <div class="box bg-yellow">
                        <div class="box-body">
                            <div class="container-fluid">
                                <div  style='padding-left:5px;padding-right:5px; display:inline-block;
                    vertical-align: middle;float:none'>
                                    <i class="fa fa-money fa-2x"></i>
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
@endsection
@section('jscript')
    <script>
        $(document).ready(()=>{
            let jmlKamar,kamarKosong,kamarTerisi;
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
                    doTimer($("#jumlah-bersih-keuntungan"),keuntungan,1342,true);
                    doTimer($("#jumlah-pemasukan"),pemasukan,1342,true);
                    doTimer($("#jumlah-pengeluaran"),pengeluaran,1342,true);
                });
            });
        });
    </script>
@endsection