<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran as Pemasukan;
class LapMasukApi extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
    }
    public function index(){
        $request = $this->request;
        
    }
    public function create(){
        $request = $this->request;
    }
    public function store(){
        $request = $this->request;
        $xdata = Pemasukan::whereBetWeen('created_at',[$request->t_awal,$request->t_akhir])->get();
        $data = [];
        foreach ($xdata as $key => $value) {
            $sisa = $value->getKamarSewa()->sisaPembayaran();
            $data[$key] = $value->toArray();
            $data[$key]['penghuni'] = $value->getKamarSewa()==NULL?null:$value->getKamarSewa()->getPenyewa();
            $data[$key]['kamar'] = $value->getKamarSewa()==NULL?'':$value->getKamarSewa()->getKamar();
            $data[$key]['sisa'] = $sisa;
        }
        return response()->json($data);
    }
    public function show($id){
        $request = $this->request;
    }
    public function edit($id){
        $request = $this->request;
    }
    public function update($id){
        $request = $this->request;
    }
    public function destroy($id){
        $request = $this->request;
    }
}