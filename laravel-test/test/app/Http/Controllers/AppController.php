<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entity\Advert;

class AppController extends Controller
{
    public function addMessage()
    {
        return view('post');
    }
}
