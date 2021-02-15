<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aset;
class SelectTwo extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function getAset($id='')
    {
        $request = $this->request;
        $data = Aset::where('aset','like',"%$request->q%")
                        ->whereNotIn('id',function($q)use($id){
                            $q->select('aset_id')->from('fasilitas')->where("kamar_id",$id);
                        } )->limit(5)->get();
        $json = [];
        foreach ($data as $key => $value) {
            $json[] = [
                'id' =>$value->id,
                'text' =>$value->aset,
            ];
        }
        $json=['results'=>$json];
        return response()->json($json);
        
    }
}
