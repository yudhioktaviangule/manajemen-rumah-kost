<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;
class LapKeluarApi extends Controller{
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
        $p = [$request->t_awal,$request->t_akhir];
        $pengeluaran = Pengeluaran::whereBetween('created_at',$p)->get();
        $data = [];
        foreach ($pengeluaran as $key => $value) {
            $data[$key] = $value->toArray();
            $data[$key]['admin'] = $value->getUser();
        }
        $json = ['data'=>$data];
        return response()->json($json);
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