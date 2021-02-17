<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\Fasilitas;
use App\Models\Kamar;
class SelectTwo extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    private function createJson($data,$text)
    {
        $json=[];
        foreach ($data as $key => $value) {
            $json[] = [
                'id' =>$value->id,
                'text' =>$value->{$text},
            ];
        }
        $json=['results'=>$json];
        return $json;
    }
    private function createJsonAset($data)
    {
        $json=[];
        foreach ($data as $key => $value) {
            $id = $value->id;
            $datas = Aset::find($id);
            $json[] = [
                'id' =>$value->id,
                'text' =>$datas->aset,
            ];
        }
        $json=['results'=>$json];
        return $json;
    }
    public function getAset($id='')
    {
        $request = $this->request;
        $data = Aset::where('aset','like',"%$request->q%")
                        ->whereNotIn('id',function($q)use($id){
                            $q->select('aset_id')->from('fasilitas')->where("kamar_id",$id);
                        } )->limit(5)->get();

        $json = $this->createJson($data,'aset');
        
        return response()->json($json);
        
    }
    public function getAllAset()
    {
        $request = $this->request;
        $data = Aset::where('aset','like',"%$request->q%")->limit(5)->get();
        $json = $this->createJson($data,'aset');
        return response()->json($json);
        
    }

    public function getKamar($kamar_id='')
    {
        $request = $this->request;
        $data = Kamar::where('nomor','like',"%$request->q%")->where('status','ready');
        if($kamar_id!=''){
            $data = $data->whereNotIn('id',[$kamar_id]);
        }
        $data = $data->limit(5)->get();
        $json = $this->createJson($data,'nomor');
        return response()->json($json);
        
    }
    public function getKamarFas()
    {
        $request = $this->request;
        $data = Kamar::where('nomor','like',"%$request->q%")->whereIn('id',
            function($q){
                $q->select('kamar_id')->from("fasilitas");
            }
        );
      
        $data = $data->limit(5)->get();
        $json = $this->createJson($data,'nomor');
        return response()->json($json);
        
    }
    public function getFasilitas($kamar_id='')
    {
        $request = $this->request;
        $data = Fasilitas::where('kamar_id',$kamar_id)
            ->whereIn('aset_id',function($q)use($request){
                        $q->select("id")->from("asets")->where("aset",'like',"%$request->q%");
                });
        
        $data = $data->limit(5)->get();
        
        $json = $this->createJsonAset($data);
        return response()->json($json);
        
    }
}
