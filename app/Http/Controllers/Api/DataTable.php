<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Aset;
use App\Models\Fasilitas;
use App\Models\Pengeluaran;
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
                    return '';
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
}
