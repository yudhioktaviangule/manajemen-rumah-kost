<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class BaseApi extends Controller{
    protected $request;
    protected function __construct(Request $request) {
        $this->request = $request;
        
    }
    protected function index(){
        $request = $this->request;
    }
    protected function create(){
        $request = $this->request;
    }
    protected function store(){
        $request = $this->request;
    }
    protected function show($id){
        $request = $this->request;
    }
    protected function edit($id){
        $request = $this->request;
    }
    protected function update($id){
        $request = $this->request;
    }
    protected function destroy($id){
        $request = $this->request;
    }
}