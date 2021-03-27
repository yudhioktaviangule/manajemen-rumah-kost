<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserReq;
use App\Models\Kamar;
use App\Models\KamarSewa;

class UserController extends Controller
{
    private $request;
   public function __construct(Request $Re) {
       $this->request = $Re;
       $this->middleware('auth');
       $this->middleware('auth.admin');
   }
    public function index()
    {
        $request= $this->request;
        $userdata= User::get();
        return view("halaman.user.tampil",compact('userdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserReq $request)
    {
        $post = $request->only('email','name','password','level');
        $post['password'] = Hash::make($post['password']);
        $post['penyewa_id'] = '0';
        $post['aktif'] = 'aktif';
        
        $usr = new User();
        $usr->fill($post);
        $usr->save();
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $data = User::find($id);
        if($data==NULL):
            return redirect()->back();
        endif;

        return view("halaman.user.show",compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data = User::find($id);
        if($data==NULL):
            return redirect()->back();
        endif;

        return view("halaman.user.edit",compact('data'));
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
        $post = $request->only('email','name','password','level');
        $usr = User::find($id);
        $usr->email = $post['email'];
        $usr->name = $post['name'];
        $usr->password = Hash::make($post['password']);
        $usr->level = $post['level'];
        $usr->save();
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Pemakai=User::find($id);
        if ($Pemakai!=NULL) {
            $Pemakai->delete();
            return redirect(route('user.index'));
        }
    }
    public function aktifasi($id)
    {
        $Pemakai=User::find($id);
        
        if ($Pemakai!=NULL) {
            $ks = KamarSewa::where('penyewa_id',$Pemakai->penyewa_id)->first();
            $kamar = Kamar::find($ks->kamar_id);
            $kamar->status="disewa";
            $kamar->save();
            $Pemakai->update(['aktif'=>'aktif']);
            $user = $Pemakai;
            return redirect()->back();
        }
    }
}
