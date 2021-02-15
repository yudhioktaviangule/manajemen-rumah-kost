<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Kamar;
use App\Models\Penyewa;
use DataTables;
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
