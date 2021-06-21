<?php

namespace App\Http\Controllers\Api;

use App\BusinessLogic\BLPengeluaran;
use Illuminate\Http\Request;

class PengeluaranApi extends BaseApi
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }



}
