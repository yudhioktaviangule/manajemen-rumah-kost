<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrController extends Controller
{
    public function forbidden()
    {
        return view("unauthorized");
    }
}
