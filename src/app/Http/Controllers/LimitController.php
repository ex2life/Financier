<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LimitController extends Controller
{
    //---------------------------------------------------------------------
    // Страница меню
    //---------------------------------------------------------------------
    public function limit_list()
    {
        return view('limit.list');
    }
}
