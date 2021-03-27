<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterPenyewaPost;
use App\Models\Kamar;
use App\Models\KamarSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Penyewa;
use Carbon\Carbon;

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
    public function store(RegisterPenyewaPost $request){
        
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
            $penyewa_id = $penyewa_db->id;
            while(!$lfalse==NULL):
                $rand = Str::random('100');
                $lfalse = User::where('remember_token',$rand)->first();
            endwhile;
            $users = [
                'penyewa_id' => $penyewa_id,
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
            
            $tanggal = Carbon::now()->format("Y-m-d");
            $kamar = Kamar::find($request->kamar_id);
            $kamar->status="reserved";
            $kamar->save();
            $tot = $kamar->harga*$request->lama_sewa;
            $ks = [
                'jatuh_tempo' => $tanggal,
                'lama_sewa' => $request->lama_sewa,
                'penyewa_id' => $penyewa_id,
                'kamar_id'=>$request->kamar_id,
                'total_sewa'=>$tot,
            ];
            $kmr = new KamarSewa();
            $kmr->fill($ks);
            $kmr->save();
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