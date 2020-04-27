<?php

namespace App\Http\Controllers\Limit;

use App\Http\Controllers\Controller;
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
