<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyewa;
use App\Models\KamarSewa;
use App\Models\Kamar;
use App\Models\User;
class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   
        $penyewas = User::where('level','penyewa')->get();
        return view('halaman.penyewa.semua',compact('penyewas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.penyewa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penyewas = new Penyewa;
        $post = $request->only("name",'hp','jenis_kelamin');
        $penyewas->fill($post);
        $penyewas->save();

        return redirect(route('penyewa.index'));

    }
    public function show($id)
    {
        $data = Penyewa::find($id);
        if($data == NULL):
            return redirect()->back();
        endif;
        return view('halaman.penyewa.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $penyewas = Penyewa::findOrFail($id);
        $penyewas->name = $request->Nama;
        $penyewas->hp = $request->No_hp;
        $penyewas->jenis_kelamin = $request->Jenis_Kelamin;
        $penyewas->save();

        return redirect()->route('penyewa.index'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Penyewa::find($id);
        if($data!=NULL):
            Penyewa::where('id',$id)->delete();
            return redirect()->back();
        else:
            return redirect()->back();
        endif;
    }

    public function checkout($id)
    {
        $data = KamarSewa::find($id);
        $p='';
        if($data != NULL){
            $p = $data->penyewa_id;
            $kamar  = $data->kamar_id;
            $dkamar = Kamar::find($kamar);
            if($dkamar==NULL):
                return redirect()->back();
            endif;
            $dkamar->status='ready';
            $dkamar->save();
            $dsewa = Penyewa::find($p);
            $sewa = $dsewa->getUser();  
            $sewa->aktif='checkout';
            $sewa->save();
            $data->delete();
            return redirect(route('penyewa.index'));
        }else{
            return redirect(route('penyewa.show',['penyewa'=>$p]));
        }
    }
}
