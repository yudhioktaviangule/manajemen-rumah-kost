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
use App\Models\User;

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
    public function penyewa()
    {
        $request = $this->request;
        $db = User::where('level','penyewa');
        $sql = '';
        if($request->_f!=='nofiltered'):
            if($request->_f==='nokamar'):
                $db = $db->where('aktif','aktif');
                $db=$db->whereNotIn('penyewa_id',function($a){
                    $a->select('penyewa_id')->from('kamar_sewas');
                });
                $sql = $db;
                $sql = $sql->toSql();
            elseif($request->_f==='aktif'):
                $db = $db->where('aktif',$request->_f);
                $db=$db->whereIn('penyewa_id',function($a){
                    $a->select('penyewa_id')->from('kamar_sewas');
                });
            else:
                $db = $db->where('aktif',$request->_f);
            endif;
        endif;
        
        $db = $db->get();
        $dt = DataTables::of($db)
                ->addIndexColumn()
                ->addColumn('aksi',function($row){
                    $cal = json_decode($row);
                    $value = User::find($cal->id);
                    return View::make("halaman.penyewa.buttons",compact("value"));
                })
                ->addColumn('nik',function($row){
                    $cal = json_decode($row);
                    $value = User::find($cal->id);
                    return $value->getPenyewa()->nik;
                })
                ->addColumn('kota_asal',function($row){
                    $cal = json_decode($row);
                    $value = User::find($cal->id);
                    return $value->getPenyewa()->kota_asal;
                })
                ->addColumn('jenis_kelamin',function($row){
                    $cal = json_decode($row);
                    $value = User::find($cal->id);
                    return $value->getPenyewa()->jenis_kelamin;
                })
                ->addColumn('pekerjaan',function($row){
                    $cal = json_decode($row);
                    $value = User::find($cal->id);
                    return $value->getPenyewa()->pekerjaan;
                })
                ->addColumn('hp',function($row){
                    $cal = json_decode($row);
                    $value = User::find($cal->id);
                    return $value->getPenyewa()->hp;
                })
                ->addColumn('nomor',function($row){
                    $cal = json_decode($row);
                    $value = User::find($cal->id);
                    $kamar = $value->getPenyewa()->getKamar();
                    if($kamar==NULL){ return '-';}
                    else {return $kamar->nomor;}
                })
               
                ->rawColumns(['aksi']);
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

    public function pengeluaran()
    {
        $request = $this->request;
        $db = Pengeluaran::get();
        $dt = DataTables::of($db)
                ->addIndexColumn()
                ->addColumn('aksi',function($row){
                    $value = json_decode($row);
                    
                    return View::make("halaman.pengeluaran.buttons",compact("value"));
                })
                ->addColumn('tanggal',function($row){
                    $cal = json_decode($row);
                    $kal = Carbon::parse($cal->created_at)->format('d-m-Y');
                    return $kal;
                })
                ->addColumn('lunas',function($row){
                    $cal = json_decode($row);
                    return strtoupper($cal->status);
                })
                
                ->rawColumns(['aksi']);
        return $dt->make(true);
    }

}
