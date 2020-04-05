<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcController extends Controller
{
    public function calc_list()
    {
        return view('calc.list');
    }
}
