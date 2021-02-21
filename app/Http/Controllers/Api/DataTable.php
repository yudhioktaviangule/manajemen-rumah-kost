<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Aset;
use App\Models\Fasilitas;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\KamarSewa;

use DataTables;
use Carbon\Carbon;
class DataTable extends Controller{
    private $request;
    public function __construct(Request $request){
        $this->request = $request; 
    }
    public function kamar_fasilitas()
    {
        $db = Kamar::get();
        $dt = DataTables::of($db)
                ->addIndexColumn()
                ->addColumn('aksi',function($row){
                    $dec = json_decode($row);
                    return View::make("halaman.fasilitas.kamar.buttons",compact("dec"));
                })->rawColumns(['aksi']);
        return $dt->make(true);
    }
    public function pemeliharaan()
    {
        $db = Pengeluaran::where('jenis_pengeluaran','pemeliharaan')->get();
        $dt = DataTables::of($db)
                ->addIndexColumn();
        $dt->addColumn('tanggal',function($r){
                $decode = json_decode($r);
                $created_at = $decode->created_at;
                return Carbon::parse($created_at)->format('d-m-Y');
            })
            ->addColumn('kamar',function($r){
                $decode = json_decode($r);
                $kamar  = Kamar::find($decode->kamar_id);
                if($kamar==NULL):
                    return '';
                else:
                    return $kamar->nomor;
                endif;
            })
            ->addColumn('fasilitas',function($r){
                $decode = json_decode($r);
                $kamar  = Fasilitas::find($decode->fasilitas_id);
                if($kamar==NULL):
                    return '';
                else:
                    return $kamar->getAset()->aset." Kamar ".$kamar->getKamar()->nomor;
                endif;
            })
            ->addColumn('aset',function($r){
                $decode = json_decode($r);
                $kamar  = Aset::find($decode->aset_id);
                if($kamar==NULL):
                    return '';
                else:
                    return $kamar->aset;
                endif;
            });
        $dt->rawColumns(['tanggal','kamar','fasilitas','aset']);
        return $dt->make(true);
    }
    public function tambahAset()
    {
        $db = Pengeluaran::where('jenis_pengeluaran','penambahan aset')->get();
        $dt = DataTables::of($db)
                ->addIndexColumn();
        $dt->addColumn('tanggal',function($r){
                $decode = json_decode($r);
                $created_at = $decode->created_at;
                return Carbon::parse($created_at)->format('d-m-Y');
            })
            ->addColumn('kamar',function($r){
                $decode = json_decode($r);
                $kamar  = Kamar::find($decode->kamar_id);
                if($kamar==NULL):
                    return '';
                else:
                    return $kamar->nomor;
                endif;
            })
            ->addColumn('fasilitas',function($r){
                $decode = json_decode($r);
                $kamar  = Fasilitas::find($decode->fasilitas_id);
                if($kamar==NULL):
                    return '-';
                else:
                    return $kamar->getAset()->aset." Kamar ".$kamar->getKamar()->nomor;
                endif;
            })
            ->addColumn('aset',function($r){
                $decode = json_decode($r);
                $kamar  = Aset::find($decode->aset_id);
                if($kamar==NULL):
                    return 's';
                else:
                    return $kamar->aset;
                endif;
            });
        $dt->rawColumns(['tanggal','kamar','fasilitas','aset']);
        return $dt->make(true);
    }
    public function perawatan()
    {
        $db = Pengeluaran::where('jenis_pengeluaran','perbaikan fasilitas')->get();
        $dt = DataTables::of($db)
                ->addIndexColumn();
        $dt->addColumn('tanggal',function($r){
                $decode = json_decode($r);
                $created_at = $decode->created_at;
                return Carbon::parse($created_at)->format('d-m-Y');
            })
            ->addColumn('kamar',function($r){
                $decode = json_decode($r);
                $kamar  = Kamar::find($decode->kamar_id);
                if($kamar==NULL):
                    return '';
                else:
                    return $kamar->nomor;
                endif;
            })
            ->addColumn('fasilitas',function($r){
                $decode = json_decode($r);
                $kamar  = Fasilitas::find($decode->fasilitas_id);
                if($kamar==NULL):
                    return '-';
                    //return $r;
                else:
                    return "<strong>".$kamar->getAset()->aset."</strong><br> Kamar :<strong> ".$kamar->getKamar()->nomor."</strong>";
                endif;
            })
            ->addColumn('aset',function($r){
                $decode = json_decode($r);
                $kamar  = Aset::find($decode->aset_id);
                if($kamar==NULL):
                    return '';
                else:
                    return $kamar->aset;
                endif;
            });
        $dt->rawColumns(['tanggal','kamar','fasilitas','aset']);
        return $dt->make(true);
    }

    public function penyewaKamar()
    {
        $request = $this->request;
        $data = KamarSewa::whereIn('kamar_id',function($q){
                    $q->select('id')->from("kamars")->where('status','disewa');
                })->get();
        $dataTable = DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('penyewa',function($row){
                                $rowD = json_decode($row,TRUE);
                                $penyewa = new KamarSewa();
                                $penyewa->forceFill($rowD);
                                return $penyewa->getPenyewa()->name;
                            })
                            ->addColumn('kamar',function($row){
                                $rowD = json_decode($row,TRUE);
                                $kamar = new KamarSewa();
                                $kamar->forceFill($rowD);
                                return $kamar->getKamar()->nomor;
                            })
                            ->addColumn('tagihan',function($row){
                                $rowD = json_decode($row,TRUE);
                                $kamar = new KamarSewa();
                                $kamar->forceFill($rowD);
                                $now = Carbon::now();
                                $tanggal_expair = Carbon::parse($kamar->jatuh_tempo);
                                $isNearly =  $tanggal_expair->diffInDays($now)<10 ? true : false;
                                $isLate   = $isNearly ? ($tanggal_expair->diffInDays($now)<0 ?true:false) : false;
                                $totalBayar = ($tanggal_expair->diffInMonths($now) + 1) * $kamar->getKamar()->harga;
                                return number_format($totalBayar);
                            })
                            ->addColumn('status',function($row){
                                $rowD = json_decode($row,TRUE);
                                $kamar = new KamarSewa();
                                $kamar->forceFill($rowD);
                                $now = Carbon::now();
                                $tanggal_expair = Carbon::parse($kamar->jatuh_tempo);
                                $isNearly =  $tanggal_expair->gt($now) && $tanggal_expair->diffInDays($now)<10 ? true : false;
                                $isLate   = $now->gt($tanggal_expair)?true:false;
                                if($isLate):
                                    return "Melewati Batas Waktu Pembayaran";
                                elseif($isNearly):
                                    return "Mendekati Masa Pembayaran";
                                else:
                                    return '-';
                                endif;

                            });
        return $dataTable->make();
    }
    
    public function kamar_sewa()
    {
        $db = Penyewa::get();
        $dt = DataTables::of($db)
                ->addIndexColumn()
                ->addColumn('aksi',function($row){
                    
                    $dec = json_decode($row,true);
                    $jdec = json_decode($row);
                    $dv  = new Penyewa();
                    $dv->forceFill($dec);
                    $sewa = $dv->getSewa();
                    $data = $dv->getKamar();
                    
                    return View::make("halaman.kamar_sewa.buttons",compact("data",'jdec','sewa'));
                })
                ->addColumn('nomor',function($row){
                    $dec = json_decode($row,true);
                    $dv  = new Penyewa();
                    $dv->forceFill($dec);
                    $data = $dv->getKamar();
                    $tampil = $data==NULL?"-":$data->nomor;
                    return $tampil;
                })
                ->rawColumns(['aksi','nomor']);
        return $dt->make(true);
    }
    
    public function list_bayar()
    {
        $db = Pembayaran::get();
        $dt = DataTables::of($db)
                ->addIndexColumn()
               
                ->addColumn('nomor',function($row){
                    $dec = json_decode($row,true);
                    $dv  = new Pembayaran();
                    $dv->forceFill($dec);
                    $data = $dv->getKamarSewa()->getKamar();
                    $tampil = $data==NULL?"-":$data->nomor;
                    return $tampil;
                })
                ->addColumn('penyewa',function($row){
                    $dec = json_decode($row,true);
                    $dv  = new Pembayaran();
                    $dv->forceFill($dec);
                    $data = $dv->getKamarSewa()->getPenyewa();
                    $tampil = $data==NULL?"-":$data->name;
                    return $tampil;
                })
                ->addColumn('jbayar',function($row){
                    $dec = json_decode($row,true);
                    $dv  = new Pembayaran();
                    $dv->forceFill($dec);
                    $data = $dv->json;
                    $jsond = json_decode($data);
                    $tampil = $jsond->jumlah_bayar;
                    return number_format($tampil);
                })
                ->addColumn('tanggal',function($row){
                    $dec = json_decode($row);
                    $tampil = Carbon::parse($dec->created_at)->format('d-m-Y');
                    return $tampil;
                });
        return $dt->make(true);
    }
}
