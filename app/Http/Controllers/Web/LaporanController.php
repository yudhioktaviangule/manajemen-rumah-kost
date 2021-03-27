<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class LaporanController extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('auth');
        $this->middleware('auth.admin');
    }
    public function index(){
        $request = $this->request;
        return view('halaman.laporan.index');
    }
    public function create(){
        $request = $this->request;
    }
    public function store(){
        $request = $this->request;
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
