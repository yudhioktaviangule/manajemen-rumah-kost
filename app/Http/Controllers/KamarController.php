<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\KamarRequest;
use App\Models\Kamar;
class KamarController extends Controller
{

    public function index()
    {
        $kamars = Kamar::get();
        return view('halaman.kamar.kamar',compact('kamars'));

    }
    public function create()
    {
        return view('halaman.kamar.create');
    }

    public function store(KamarRequest $request)
    {
        $post = $request->only('nomor','harga');
        $post['status'] = 'ready';
        $kamar = new Kamar();
        $kamar->fill($post);
        $kamar->save();
        return redirect(route('kamar.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kamar::find($id);
        return view('halaman.kamar.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kamar::find($id);
        return view('halaman.kamar.edit',compact('data'));
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
        $kamar = Kamar::find($id);
        $kamar->harga = $request->harga;
        $kamar->save();
        return redirect(route('kamar.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kamar::find($id);
        if($data!=NULL):
            $data->delete();
        endif;
        return redirect(route('kamar.index'));
    }
}
