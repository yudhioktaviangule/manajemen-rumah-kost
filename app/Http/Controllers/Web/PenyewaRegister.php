<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Penyewa;
class PenyewaRegister extends Controller{
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
        $kelamin = $request->jk;
        $penyewa = [
            'nik' =>$request->nik,
            'name' =>$request->name,
            'hp' =>$request->hp,
            'kota_asal' =>$request->kota_asal,
            "jenis_kelamin" => $kelamin,
            'pekerjaan' =>$request->pekerjaan,
        ];
        $penyewa_db = new Penyewa();
        $penyewa_db->fill($penyewa);
        $penyewa_db->save();
        $lfalse = true;
        while(!$lfalse==NULL):
            $rand = Str::random('50');
            $lfalse = User::where('remember_token',$rand)->first();
        endwhile;
        $users = [
            'penyewa_id' => $penyewa_db->id,
            'name'  =>  $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'penyewa',
            'aktif' => 'nonaktif',
            'remember_token' => $rand,
        ];
        $user = new User();
        $user->fill($users);
        $user->save();
        return redirect(route('login'));

        
        
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