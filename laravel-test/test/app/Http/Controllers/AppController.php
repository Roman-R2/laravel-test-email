<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class AppController extends Controller
{

    function addMessage()
    {
        return view('post');
    }
}
