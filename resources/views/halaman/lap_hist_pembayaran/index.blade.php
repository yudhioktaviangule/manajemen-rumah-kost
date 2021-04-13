@extends('template.index')

@section('judul','Rekap Pembayaran Kamar Pertahun')
@section('content')
<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Laporan Pemasukan</h3>
    <div class="card-tools">
        <div class="form-group" id='cetak-group'>
            <a href='#' id='tcetak' onclick='cetak()' class="btn btn-primary btn-sm">
                <i class="fa fa-print"></i> Cetak
            </a>
        </div>
    </div>
  </div>
  <div class="card-body">
    
        <div class='form-group'>
            <label for='periode'>Periode</label>
            <select required onchange="renderToTable($(this))" class='form-control' name='periode' id='periode'>
                <option value=''>Pilih Periode</option>
            </select>
        </div>
        <div id="tablenya" class='table-responsive'></div>
        
        

    
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    The footer of the card
  </div>
  <!-- card-footer -->
</div>  
@endsection
@section('jscript')
    
    <script>
        moment.locale("id");
        $(document).ready(()=>{
            $("#tcetak").hide(100);
            let defaultView = `
               
                <h3 >Rekap Pembayaran Kamar _TAHUN_</h3>
                <table cellspacing=0 cellpadding=0 class="table table-bordered" _stable_ >
                    <thead>
                        <tr>
                            <th rowspan=2 _bd_topbot_>No.</th>
                            <th rowspan=2 _bd_topbot_>Kamar</th>
                            <th colspan=12 _BD_TOP_ >_TAHUN_</th>
                            <th rowspan=2 _bd_topbot_ >Total</th>
                        </tr>
                        <tr>
                            _BULAN1_
                        </tr>
                    </thead>
                    <tbody>
                        _BODY_
                    </tbody>
                </table>
                
            
            `;
            const bulanes = [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ]
            let period = $("#periode")
            const TAHUN = parseInt(moment().format("YYYY"))
            window.renderToTable = (object)=>{
                let headHtml = ``;
                bulanes.map(v=>{
                    headHtml+=`
                        <th _BD_BOTTOM_>${v}</th>
                    `;
                })
                let context = defaultView.replace(/_BULAN1_/g,headHtml);
                renderBody(context,object.val());
            }
            const renderBody = async(context='',tahun)=>{
                context = context.replace(/_TAHUN_/g,tahun);
                const {data:{periode,total_res:totalKeseluruhan,results:hasil}} = await axios(`api/pembayaran/pertahun/${tahun}`)
                let htmlContext = ``;

                if(Array.isArray(hasil)){
                    hasil.map((valueX,index)=>{
                        const {detail,subtotal} = valueX;
                        const nomor = index+1;
                        htmlContext+=`<tr>
                            <th style='padding:5px'>${nomor}</th>
                            <th style='padding:5px'>${valueX.kamar.nomor}</th>
                            `
                        detail.map(v=>{
                            htmlContext+=`<td style='padding:5px'>${v.toLocaleString()}</td>`
                        })
                        htmlContext+=`<td style='padding:5px'>${subtotal.toLocaleString()}</td>`
                        htmlContext+=`</tr>`
                    })
                }
                htmlContext+=`
                    <tr>
                        <th colspan="14" _bd_topbot_>TOTAL</th>
                        <td _bd_topbot_>${ totalKeseluruhan.toLocaleString()}</td>
                    </tr>
                `;
                $("#tcetak").show(100);
                context = context.replace(/_BODY_/g,htmlContext);
                $("#tablenya").html(context);
            }
            const renderSelect = ()=>{
                let html=`<option value=''>PILIH TAHUN</option>`;
                for(let i = TAHUN;i<TAHUN+5;i++){
                    html+=`<option value=${i}>Tahun ${i}</option>`;
                }
                $("#periode").html(html);
            }
            
            window.cetak=()=>{
                const h = window.screen.height,w=window.screen.width;
                const newWindow = window.open("","",`width=${w};height=${h}`);
                let isi =$('#tablenya').html().replace(/_stable_|_bd_top_|_bd_bottom_|_bd_topbot_/gi,match=>{
                    const rst  = {
                        _stable_:`style="width:80%;margin-left:auto;margin-right:auto"`,
                        _bd_top_:`style="padding:5px;border-top:1px solid #000;"`,
                        _bd_bottom_:`style="padding:5px;border-bottom:1px solid #000;"`,
                        _bd_topbot_:`style="padding:5px;border-bottom:1px solid #000;border-top:1px solid #000;"`,
                    }
                    return rst [match];
                });
                
                let content= `
                
                ${isi}
                `;
                $("#tcetak").hide(100);
                newWindow.document.write(content);
                newWindow.focus();
                setTimeout(() => {
                    newWindow.print();
                }, 1000);

            }

            renderSelect();
        })
    </script>
@endsection

