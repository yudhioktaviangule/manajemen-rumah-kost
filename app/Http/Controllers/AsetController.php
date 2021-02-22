<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Aset;
class AsetController extends Controller
{
    private $request;
    
    public function index()
    {
        $asets = Aset::get();
        return view('halaman.aset.asetkost',compact('asets'));
    }

    public function create()
    {
        return view('halaman.aset.create');
    }

    public function store(Request $request)
    {
        
        $post = $request->only("aset");
        $asets = new aset;
        $asets->fill($post);
        $asets->save();

        return redirect(route('m_aset.index'));


    }

    public function show($id)
    {
        $asets = Aset::find($id);
        return view('halaman.aset.show',compact('asets'));
    }

   
    public function edit($id)
    {
        $asets = Aset::find($id);
        return view('halaman.aset.edit',compact('asets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $asets = Aset::findOrFail($id);
        $asets-> aset = $request->aset;
        $asets->save();

        return redirect(route('m_aset.index')); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Aset::find($id);
        if($data!=NULL):
            Aset::where('id',$id)->delete();
        endif;
        return redirect(route('m_aset.index'));
    }
}
